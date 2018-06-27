<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Model\Property\P_Units as Unit;
//use App\Model\Website\Icon as Icon;
use App\Model\Image\Image as Image;
use App\Model\Website\Adv as Adv;
class ProductController extends FrontendController
{
    
    public function index($locale) {
    	$defaultData = $this->defaultData($locale);
    	
        return view('frontend.product',['defaultData'=>$defaultData, 'locale'=>$locale]);
    }
   
}
