<?php

namespace App\Http\Controllers\CP\Profile;

use Auth;
use Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CamCyber\FileUploadController as FileUpload;
use App\Http\Controllers\CamCyber\FunctionController;
use Image;

use App\Model\User\User as Model;
use App\Model\User\Tracking;
use App\Model\User\Position;


class ProfileController extends Controller
{
    protected $route;
    public function __construct(){
        $this->route = "cp.profile.profile";
    }
    public function edit(){  
        $user = Auth::user();
        //echo $user->picture; die;
        return view($this->route.'.editForm', ['route'=>$this->route, 'data'=>$user]);
        
    }
    public function update(Request $request) {
        $user_id  = Auth::id();
        $now      = date('Y-m-d H:i:s');
       $id = $request->input('id');
        Validator::make(
                        $request->all(), 
                        [
                            'name' => 'required',
                           
                            'phone' => [
                                            'required',
                                            Rule::unique('users')->ignore($id)
                                        ],
                            'email' => [
                                            'required',
                                            'email',
                                            Rule::unique('users')->ignore($id)
                                        ],
                            'avatar' => [
                                            'sometimes',
                                            'required',
                                            'mimes:jpeg,png',
                            ],
                        ],
                        [
                            'email.unique' => 'New new email address :'.$request->input('email').' can not be used. It has already been taken.',
                        ])->validate();

        
        $data = array(
                    'name' =>   $request->input('name'),
                    'phone' =>  $request->input('phone'), 
                    'email' =>  $request->input('email'),
                );
        
        if($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $imagename = time().'.'.$avatar->getClientOriginalExtension(); 
            Image::make($avatar->getRealPath())->resize(200, 165)->save(public_path('uploads/user/image/'.$imagename));
            $data['avatar']=$imagename;
        }
        Model::where('id', $id)->update($data);
        $tracking = new Tracking();
        $tracking->user_id = $user_id;
        $tracking->created_at = $now;
        $tracking->description = 'Update his profile.';
        $tracking->save();
        Session::flash('msg', 'Data has been updated!' );
        return redirect()->back();
    }

    public function editPassword(){  
        $user = Auth::user();
        return view($this->route.'.editPasswordForm', ['route'=>$this->route, 'data'=>$user]);
        
    }
    public function changePassword (Request $request){
        $id =  Auth::user()->id;
        $user_id  = Auth::id();
        $now      = date('Y-m-d H:i:s');
        $old_password = $request->input('old_password');
        $current_password = Model::find($id)->password;
        // echo $old_password. '<br />';
        // echo $current_password. '<br />';die; 

        if (password_verify($old_password, $current_password)){ 

            Validator::make(
                        $request->all(), 
                        [
                            'new_password'         => 'required|min:6|max:18',
                            'confirm_password' => 'required|same:new_password',
                        ], 
                        [
                            'new_password.same' => 'Please confirm your password.',
                        ])->validate();
            Model::where('id', $id)->update(['password' => bcrypt($request->input('new_password'))]);
            $tracking = new Tracking();
            $tracking->user_id = $user_id;
            $tracking->created_at = $now;
            $tracking->description = 'Change password.';
            $tracking->save();
            Session::flash('msg', 'Password has been Reset!' );
            return redirect()->back();
        }else{
            echo 'Not Valide';
        }
       
        
    }
     public function logs(){
        $id =  Auth::user()->id;
        $dataLog = Model::find($id)->logs();

        $limit=intval(isset($_GET['limit'])?$_GET['limit']:10); 
        $from=isset($_GET['from'])?$_GET['from']:"";
        $till=isset($_GET['till'])?$_GET['till']:"";

        if($limit <= 0 || $limit > 100){
            $limit = 10;
        }

        $appends=array('limit'=>$limit);
       
        if(FunctionController::isValidDate($from)){
            if(FunctionController::isValidDate($till)){
                $appends['from'] = $from;
                $appends['till'] = $till;

                $from .=" 00:00:00";
                $till .=" 23:59:59";

                $dataLog = $dataLog->whereBetween('created_at', [$from, $till]);
            }
        }
       
        $logs= $dataLog->orderBy('created_at', 'DESC')->paginate($limit);
        return view($this->route.'.logs', ['route'=>$this->route, 'id'=>$id, 'data'=>$logs, 'appends'=>$appends]);
    }
    
}