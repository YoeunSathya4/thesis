<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Model\Property\P_Units as Unit;
//use App\Model\Website\Icon as Icon;
use App\Model\Image\Image as Image;
use App\Model\Product\Product as Product;
use App\Model\Slide\Slide;
use App\Model\Category\Category;
class HomeController extends FrontendController
{
    
    public function index($locale) {
    	$slides = Slide::select('*')->where('is_published', 1)->get();
    	$categories = Category::select('id',$locale.'_name as name','image')->limit(4)->get();
    	$products = Product::select('id',$locale.'_name as name','image','unit_price')->limit(8)->get();
    	$defaultData = $this->defaultData($locale);
        return view('frontend.home',['defaultData'=>$defaultData, 'locale'=>$locale, 'slides'=>$slides,'categories'=>$categories, 'products'=>$products]);
    }
   
}
