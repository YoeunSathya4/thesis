<?php

namespace App\Http\Controllers\CP\Visitor;

use Auth;
use Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CamCyber\FileUploadController as FileUpload;
use App\Http\Controllers\CamCyber\FunctionController;

use App\Model\Visitor as Model;
use App\Model\User\Tracking;
use Image;

class VisitorController extends Controller
{
    protected $route; 
    public function __construct(){
        $this->route = "cp.visitor";
    }
    function validObj($id=0){
        $data = Model::find($id);
        if(empty($data)){
           echo "Invalide Object"; die;
        }
    }

    public function index(){
        $now      = date('Y:m:d 23:59:59');
        $yesterday = date('Y:m:d 00:00:00');
        //dd($yesterday);
        $today_data = count(Model::select('*')->whereBetween('created_at', [$yesterday, $now])->get());
        $data = count(Model::select('*')->get());
        $visitors = Model::select('*');
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
       
        $visitors= $visitors->orderBy('created_at', 'DESC')->paginate($limit);
        return view($this->route.'.index', ['route'=>$this->route, 'data'=>$data, 'today_data'=>$today_data,'visitors'=>$visitors, 'appends'=>$appends]);
    }

}
