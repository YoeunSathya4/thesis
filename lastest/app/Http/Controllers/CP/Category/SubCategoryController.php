<?php

namespace App\Http\Controllers\CP\Category;

use Auth;
use Session;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CamCyber\FileUploadController as FileUpload;
use App\Http\Controllers\Controller;

use App\Model\Category\Category as Model;
use App\Model\Category\SubCategory as SubCategory;
use App\Model\Category\SubSubCategory as SubSubCategory;
use App\Model\User\Tracking;
use Image;

class SubCategoryController extends Controller
{
    
	protected $route; 
    public function __construct(){
        $this->route = "cp.category.sub-category";
    }
    public function index($id = 0){
        $data = Model::find($id)->subCategories();
        
        $key=isset($_GET['key'])?$_GET['key']:0;
        $limit=intval(isset($_GET['limit'])?$_GET['limit']:10);

        $appends=array('limit'=>$limit);
       
        if($key!=""){
            $data = $data->where(function($query) use ($key){
                $query->where('en_name', 'Like', '%'.$key.'%');
            });
            $appends['key'] = $key;
        }
        if(Auth::user()->position_id == 1){
            $data= $data->orderBy('created_at', 'DESC')->paginate($limit);
        }else{
            $data= $data->orderBy('created_at', 'DESC')->where('is_deleted',0)->paginate($limit);
        }
        return view($this->route.'.index', ['route'=>$this->route, 'id'=>$id, 'data'=>$data,'appends'=>$appends]);
    }

    public function create($id = 0){
        return view($this->route.'.create', ['route'=>$this->route, 'id'=>$id]);
    }

    public function store(Request $request) {
        $category_id = $request->input('category_id');
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');
        $data       = array(
                    'category_id' =>  $category_id,
                    
                    'en_name' =>   $request->input('en_name'), 
                    'kh_name' =>   $request->input('kh_name'), 
                    'creator_id' =>  $user_id,
                    'is_deleted' =>  0,
                    'created_at' =>  $now, 
                );
        //print_r($data); die;
        Session::flash('invalidData', $data );
        Validator::make(
                        $request->all(), 
                        [
                            'en_name' => 'required',
                            'kh_name' => 'required',
                            
                        ],
                        [])->validate();
        

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension(); 
            Image::make($image->getRealPath())->resize(400, 313)->save(public_path('uploads/subcategory/image/'.$imagename));
            $data['image']=$imagename;
        }else{
            $data['image']='';
        }
        $id=SubCategory::insertGetId($data);
        $tracking_data = SubCategory::find($id);
        $tracking = new Tracking();
        $tracking->user_id = $user_id;
        $tracking->created_at = $now;
        $tracking->description = 'Create new subcategory name:'.$tracking_data->en_name;
        $tracking->save();
        Session::flash('msg', 'A Sub Category has been uploaded!');
        return redirect(route($this->route.'.edit', ['id'=>$category_id, 'subcategory_id'=>$id]));
    }

    function edit($id, $subcategory_id){
        $data = Model::find($id)->subCategories()->find($subcategory_id);
        if( $data){
            return view($this->route.'.edit', ['route'=>$this->route, 'id'=>$id,'subcategory_id'=>$subcategory_id, 'data'=>$data]);
        }else{
            echo "ivalide data";
        }
    }

    public function update(Request $request) {
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');
        $category_id = $request->input('category_id');
        $subcategory_id = $request->input('subcategory_id');
        $data       = array(
                    'category_id' =>  $category_id,
                    'en_name' =>   $request->input('en_name'), 
                    'kh_name' =>   $request->input('kh_name'), 
                    'updater_id' =>  $user_id,
                    'is_deleted' =>  0,
                    'updated_at' =>  $now
                );
        //print_r($data); die;
        Session::flash('invalidData', $data );
        Validator::make(
                        $request->all(), 
                        [
                            'en_name' => 'required',
                            'kh_name' => 'required',
                            
                        ],
                        [
                        ])->validate();

        
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension(); 
            Image::make($image->getRealPath())->resize(400, 313)->save(public_path('uploads/subcategory/image/'.$imagename));
            $data['image']=$imagename;
        }else{
            $data['image']='';
        }

        Model::find($category_id)->subCategories()->where('id', $subcategory_id)->update($data);
        $tracking_data = SubCategory::find($subcategory_id);
        $tracking = new Tracking();
        $tracking->user_id = $user_id;
        $tracking->created_at = $now;
        $tracking->description = 'Update subcategory name:'.$tracking_data->en_name;
        $tracking->save();
        Session::flash('msg', 'Sub Category has been Created!');
        return redirect(route($this->route.'.edit', ['id'=>$category_id, 'subcategory_id'=>$subcategory_id]));
    }
    
    public function trash($subcategory_id){
         $user_id    = Auth::id();
        $now      = date('Y-m-d H:i:s');
        SubCategory::where('id', $subcategory_id)->update(['is_deleted'=>1,'deleter_id' => Auth::id(), 'deleted_at'=>$now]);
        //Model::find($id)->delete();
        $tracking_data = SubCategory::find($subcategory_id);
        $tracking = new Tracking();
        $tracking->user_id = $user_id;
        $tracking->created_at = $now;
        $tracking->description = 'Delete subcategory id:'.$tracking_data->en_name;
        $tracking->save();
        Session::flash('msg', 'Data has been delete!' );
        return response()->json([
            'status' => 'success',
            'msg' => 'Restaurant has been deleted'
        ]);
    }
    public function delete($subcategory_id){
        $user_id    = Auth::id();
        $now      = date('Y-m-d H:i:s');
        //SubCategory::where('id', $id)->update(['is_deleted'=>1,'deleter_id' => Auth::id(), 'deleted_at'=>$now]);
        SubCategory::find($subcategory_id)->delete();
        Session::flash('msg', 'Data has been delete!' );
        return response()->json([
            'status' => 'success',
            'msg' => 'Sub Category has been deleted'
        ]);
    }

    function updateDeletedStatus(Request $request){
        $user_id    = Auth::id();
        $now      = date('Y-m-d H:i:s');
      $id   = $request->input('id');
      $data = array('is_deleted' => $request->input('active'));
      SubCategory::where('id', $id)->update($data);
      $tracking_data = SubCategory::find($id);
      if($request->input('active') == 1){
        $tracking = new Tracking();
        $tracking->user_id = $user_id;
        $tracking->created_at = $now;
        $tracking->description = 'Update subcategory publish name:'.$tracking_data->en_name;
        $tracking->save();
    }else{
        $tracking = new Tracking();
        $tracking->user_id = $user_id;
        $tracking->created_at = $now;
        $tracking->description = 'Update subcategory unpublish name:'.$tracking_data->en_name;
        $tracking->save();
    }
      return response()->json([
          'status' => 'success',
          'msg' => 'Status has been updated.'
      ]);
    }

    public function mainCategories($category_id=0, $subcategory_id=0){
        //$this->validObj($menu_id);
       
        if(Auth::user()->position_id == 1){
             $data = SubCategory::find($subcategory_id)->subSubCategories()->get();
        }else{
             $data = SubCategory::find($subcategory_id)->subSubCategories()->where('is_deleted',1)->get();
        }
        return view($this->route.'.mainCategory', ['route'=>$this->route,'id'=>$category_id, 'subcategory_id'=>$subcategory_id, 'data'=>$data]);

    }
    public function createMainCategory($category_id=0,$subcategory_id=0){
        //$this->validObj($restaurant_id);
        return view($this->route.'.createMainCategory',['route'=>$this->route, 'id'=>$category_id,'subcategory_id'=>$subcategory_id]);

    }
    public function storeMainCategory(Request $request) {
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');
        $data = array(
                    
                    'sub_category_id' =>   $request->input('subcategory_id'), 
                    'en_name' =>  $request->input('en_name'),
                    'kh_name' =>  $request->input('kh_name'),
                    'is_deleted' =>  0,
                    'creator_id' =>  $user_id,
                    'created_at' =>  $now, 
                );
        Session::flash('invalidData', $data );
        Validator::make(
                        $request->all(), 
                        [
                            'en_name' => [
                                            'required'
                                        ],
                            'kh_name' => [
                                            'required'
                                        ],
                        ],
                        [
                        ])->validate();

        $category_id = $request->input('category_id');

        $subcategory_id = $request->input('subcategory_id');

        $id=SubSubCategory::insertGetId($data);
        $tracking_data = SubSubCategory::find($id);
        $tracking = new Tracking();
        $tracking->user_id = $user_id;
        $tracking->created_at = $now;
        $tracking->description = 'Create new main category name:'.$tracking_data->en_name;
        $tracking->save();
        Session::flash('msg', 'Data has been Created!');
        return redirect(route('cp.category.sub-category.edit-mainCategory', ['category_id'=>$category_id,'subcategory_id'=>$subcategory_id,'maincategory_id'=>$id]));
       
    }

    public function editMainCategory($category_id = 0,$subcategory_id = 0, $maincategory_id=0){
        //$this->validObj($id);
        $data = SubCategory::find($subcategory_id)->subSubCategories()->find($maincategory_id);
        return view($this->route.'.editMainCategory', ['route'=>$this->route, 'id'=>$category_id,'subcategory_id'=>$subcategory_id ,'maincategory_id'=>$maincategory_id, 'data'=>$data]);
    }

    public function updateMainCategory(Request $request){
        $maincategory_id = $request->input('maincategory_id');
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');
        Validator::make(
                        $request->all(), 
                        [
                           
                            'en_name' => [
                                            'required'
                                        ],
                            'kh_name' => [
                                            'required'
                                        ],
                        ])->validate();

        
        $data = array(
                    
                    'sub_category_id' =>   $request->input('subcategory_id'), 
                    'en_name' =>  $request->input('en_name'),
                    'kh_name' =>  $request->input('kh_name'),
                    'is_deleted' =>  0,
                    'updater_id' =>  $user_id,
                    'updated_at' =>  $now
                );
        
        SubSubCategory::where('id', $maincategory_id)->update($data);
        $tracking_data = SubSubCategory::find($maincategory_id);
        $tracking = new Tracking();
        $tracking->user_id = $user_id;
        $tracking->created_at = $now;
        $tracking->description = 'Update main category name:'.$tracking_data->en_name;
        $tracking->save();
        Session::flash('msg', 'Data has been updated!' );
        return redirect()->back();
    }

    public function trashMainCategory($id){
        //Model::where('id', $id)->update(['deleter_id' => Auth::id()]);
        //SubSubCategory::find($id)->delete();
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');
        SubSubCategory::where('id', $id)->update(['is_deleted'=>1,'deleter_id' => Auth::id(), 'deleted_at'=>$now]);
        $tracking_data = SubSubCategory::find($id);
        $tracking = new Tracking();
        $tracking->user_id = $user_id;
        $tracking->created_at = $now;
        $tracking->description = 'Delete main category name:'.$tracking_data->en_name;
        $tracking->save();
        Session::flash('msg', 'Data has been delete!' );
        return response()->json([
            'status' => 'success',
            'msg' => 'Main Category has been deleted'
        ]);
    }

    public function deleteMainCategory($id){
        //Model::where('id', $id)->update(['deleter_id' => Auth::id()]);
        SubSubCategory::find($id)->delete();
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');
        // SubSubCategory::where('id', $id)->update(['is_deleted'=>1,'deleter_id' => Auth::id(), 'deleted_at'=>$now]);
        Session::flash('msg', 'Data has been delete!' );
        return response()->json([
            'status' => 'success',
            'msg' => 'Main Category has been deleted'
        ]);
    }

    function updateMainDeletedStatus(Request $request){
      $id   = $request->input('id');
      $data = array('is_deleted' => $request->input('active'));
      SubSubCategory::where('id', $id)->update($data);
      return response()->json([
          'status' => 'success',
          'msg' => 'Status has been updated.'
      ]);
    }

}
