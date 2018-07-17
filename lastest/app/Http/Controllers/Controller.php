<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Model\Property\Property as Model;
use App\Model\User\User as User;
use App\Model\Setup\Action as Action;
use App\Model\Setup\Type as Type;
use App\Model\Setup\Owner as Owner;
use App\Model\Setup\Province as Province;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function checkPermision($route){
    	
       if( ! checkPermision($route)){
            echo "In valide access!"; die;
       }
    }


}
