<?php

namespace App\Http\Controllers\CP\Slide;

use Auth;
use Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CamCyber\FileUploadController as FileUpload;
use App\Http\Controllers\CamCyber\FunctionController;

use App\Model\Slide\Slide as Model;
use App\Model\User\Tracking;
use Image;

class SlideController extends Controller
{
    protected $route; 
    public function __construct(){
        $this->route = "cp.slide";
    }
    function validObj($id=0){
        $data = Model::find($id);
        if(empty($data)){
           echo "Invalide Object"; die;
        }
    }

    public function index(){
        $data = Model::select('*');
        $limit      =   intval(isset($_GET['limit'])?$_GET['limit']:10); 
        $key       =   isset($_GET['key'])?$_GET['key']:"";
        $from=isset($_GET['from'])?$_GET['from']:"";
        $till=isset($_GET['till'])?$_GET['till']:"";
        $appends=array('limit'=>$limit);
        if( $key != "" ){
            $data = $data->where('name', 'like', '%'.$key.'%');
            $appends['key'] = $key;
        }
        
        if(FunctionController::isValidDate($from)){
            if(FunctionController::isValidDate($till)){
                $appends['from'] = $from;
                $appends['till'] = $till;

                $from .=" 00:00:00";
                $till .=" 23:59:59";

                $data = $data->whereBetween('created_at', [$from, $till]);
            }
        }
        if(Auth::user()->position_id == 1){
            $data= $data->orderBy('created_at', 'DESC')->paginate($limit);
        }else{
            $data= $data->orderBy('created_at', 'DESC')->where('is_deleted',0)->paginate($limit);
        }
        
        
        return view($this->route.'.index', ['route'=>$this->route, 'data'=>$data, 'appends'=>$appends]);
    }
   
    public function create(){
        return view($this->route.'.create', ['route'=>$this->route]);
    }
    public function store(Request $request) {
        $user_id  = Auth::id();
        $now      = date('Y-m-d H:i:s');
        $data = array(
                    'name' =>   $request->input('name'),
                    'creator_id' =>   $user_id,
                    'updater_id' =>   $user_id,
                    'is_deleted' =>   0,
                    'created_at' => $now, 
                    'updated_at' => $now
                );
        Session::flash('invalidData', $data );
        Validator::make(
                        $request->all(), 
                        [
                            
                            'name' => 'required'
                        ])->validate();
        if($request->input('active')=="")
        {
            $data['is_published']=0;
        }else{
            $data['is_published']=1;
        }
        

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension(); 
            Image::make($image->getRealPath())->resize(1903, 700)->save(public_path('uploads/slide/image/'.$imagename));
            $data['image']=$imagename;
        }else{
            $data['image']='';
        }
		$id=Model::insertGetId($data);
        $tracking_data = Model::find($id);
        $tracking = new Tracking();
        $tracking->user_id = $user_id;
        $tracking->created_at = $now;
        $tracking->description = 'Create new slide name:'.$tracking_data->name;
        $tracking->save();
        Session::flash('msg', 'Data has been Created!');
		return redirect(route($this->route.'.edit', $id));
    }

    public function edit($id = 0){
        $this->validObj($id);
        $data = Model::find($id);
        return view($this->route.'.edit', ['route'=>$this->route, 'id'=>$id, 'data'=>$data]);
    }

    public function update(Request $request){
        $id = $request->input('id');
        $user_id  = Auth::id();
        $now      = date('Y-m-d H:i:s');
        Validator::make(
        				$request->all(), 
			        	[
                            
                            'name' => 'required'
                            
                        ],
                        [
                            
                        ])->validate();

		
		$data = array(
                    'name' =>   $request->input('name'),
                    'updater_id' =>   $request->input('user_id'),
                    'is_deleted' =>   0,
                );
        if($request->input('active')=="")
        {
            $data['is_published']=0;
        }else{
            $data['is_published']=1;
        }
       
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension(); 
            Image::make($image->getRealPath())->resize(1903, 700)->save(public_path('uploads/slide/image/'.$imagename));
            $data['image']=$imagename;
        }else{
            $data['image']='';
        }
       
        Model::where('id', $id)->update($data);
        $tracking_data = Model::find($id);
        $tracking = new Tracking();
        $tracking->user_id = $user_id;
        $tracking->created_at = $now;
        $tracking->description = 'Update slide name:'.$tracking_data->name;
        $tracking->save();
        
        Session::flash('msg', 'Data has been updated!' );
        return redirect()->back();
	}

    public function trash($id){
        $user_id  = Auth::id();
        $now      = date('Y-m-d H:i:s');
        Model::where('id', $id)->update(['is_deleted'=>1,'deleter_id' => Auth::id(), 'deleted_at'=>$now]);
        //Model::find($id)->delete();
        $tracking_data = Model::find($id);
        $tracking = new Tracking();
        $tracking->user_id = $user_id;
        $tracking->created_at = $now;
        $tracking->description = 'Delete slide name:'.$tracking_data->name;
        $tracking->save();
        Session::flash('msg', 'Data has been delete!' );
        return response()->json([
            'status' => 'success',
            'msg' => 'Slide has been deleted'
        ]);
    }

    public function delete($id){
        $now      = date('Y-m-d H:i:s');
        //Model::where('id', $id)->update(['is_deleted'=>1,'deleter_id' => Auth::id(), 'deleted_at'=>$now]);
        Model::find($id)->delete();
        Session::flash('msg', 'Data has been delete!' );
        return response()->json([
            'status' => 'success',
            'msg' => 'Slide has been deleted'
        ]);
    }

    function updateStatus(Request $request){
        $user_id  = Auth::id();
        $now      = date('Y-m-d H:i:s');
        $id   = $request->input('id');
        $data = array('is_published' => $request->input('active'));
        Model::where('id', $id)->update($data);
        $tracking_data = Model::find($id);
      if($request->input('active') == 1){
        $tracking = new Tracking();
        $tracking->user_id = $user_id;
        $tracking->created_at = $now;
        $tracking->description = 'Update slide publish name:'.$tracking_data->name;
        $tracking->save();
    }else{
        $tracking = new Tracking();
        $tracking->user_id = $user_id;
        $tracking->created_at = $now;
        $tracking->description = 'Update slide unpublish name:'.$tracking_data->name;
        $tracking->save();
    }
        

      return response()->json([
          'status' => 'success',
          'msg' => 'Status has been updated.'
      ]);
    }
   function updateDeletedStatus(Request $request){
    $now      = date('Y-m-d H:i:s');
      $id   = $request->input('id');
      $data = array('is_deleted' => $request->input('active'));
      Model::where('id', $id)->update($data);
      return response()->json([
          'status' => 'success',
          'msg' => 'Status has been updated.'
      ]);
    }
}
