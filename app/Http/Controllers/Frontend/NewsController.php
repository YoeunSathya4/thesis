<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Model\News\News;
//use App\Model\Website\Icon as Icon;
use App\Model\Image\Image as Image;
use App\Model\Website\Adv as Adv;
class NewsController extends FrontendController
{
    
    public function index($locale) {
    	$data = News::select('id',$locale.'_title as title',$locale.'_description as description','image','created_at')->where('is_published',1)->orderBy('id', 'DESC')->paginate(6);
        return view('frontend.news',['locale'=>$locale, 'data'=>$data]);
    }
   
}
