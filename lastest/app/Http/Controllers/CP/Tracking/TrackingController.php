<?php

namespace App\Http\Controllers\CP\Tracking;

use Auth;
use Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CamCyber\FileUploadController as FileUpload;
use App\Http\Controllers\CamCyber\FunctionController;
use App\Http\Controllers\CamCyber\GenerateSlugController as GenerateSlug;

use App\Model\User\Tracking as Model;
use App\Model\User\User;
use Image;


class TrackingController extends Controller
{
    protected $route; 
    public function __construct(){
        $this->route = "cp.tracking";
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
        $user   =   intval(isset($_GET['user'])?$_GET['user']:0);
        $from=isset($_GET['from'])?$_GET['from']:"";
        $till=isset($_GET['till'])?$_GET['till']:"";
        $appends=array('limit'=>$limit);
        if( $key != "" ){
            $data = $data->where('en_title', 'like', '%'.$key.'%')->orWhere('kh_title', 'like', '%'.$key.'%');
            $appends['key'] = $key;
        }

        if( $user > 0 ){
            $data = $data->where('user_id', $user);
            $appends['user'] = $user;
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
            $users = User::where(['visible'=> 1])->get();
        }else if(Auth::user()->position_id == 2){
            $data= $data->orderBy('created_at', 'DESC')->paginate($limit);
            $users = User::where(['visible'=> 1,'position_id'=>2])->get();
        }else{
            $data= $data->orderBy('created_at', 'DESC')->paginate($limit);
            $users = User::where(['visible'=> 1,'position_id'=>2])->get();
        }
       
        return view($this->route.'.index', ['route'=>$this->route, 'data'=>$data,'appends'=>$appends,'users'=>$users]);
    }
   
   

}
