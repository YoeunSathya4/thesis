<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Model\Property\P_Units as Unit;
//use App\Model\Website\Icon as Icon;
use App\Model\Image\Image as Image;
use App\Model\Promotion\Promotion as Promotion;
class PromotionController extends FrontendController
{
    
    public function index($locale) {
    	$defaultData = $this->defaultData($locale);
    	$promotions = Promotion::select('id', $locale.'_title as title', $locale.'_description as description', 'image', 'created_at')->where(['is_published'=>1,'is_deleted'=>0])->paginate(3);
        return view('frontend.promotion',['defaultData'=>$defaultData ,'locale'=>$locale,'promotions'=>$promotions]);
    }
   
}
