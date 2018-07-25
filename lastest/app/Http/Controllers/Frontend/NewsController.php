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
    	$data = News::select('id',$locale.'_title as title',$locale.'_description as description','image','created_at', 'slug')->where(['is_published'=>1,'is_deleted'=>0])->orderBy('id', 'DESC')->paginate(3);
    	$defaultData = $this->defaultData($locale);
        return view('frontend.news',['defaultData'=>$defaultData, 'locale'=>$locale, 'data'=>$data]);
    }

    public function detail($locale = '', $slug = ''){
    	$data = News::select('id', $locale.'_title as title', $locale.'_description as description',$locale.'_content as content', 'image', 'created_at','image_detail')->where('slug', $slug)->first();
    	$defaultData = $this->defaultData($locale);
    	return view('frontend.news-detail',['defaultData'=>$defaultData, 'locale'=>$locale, 'data'=>$data]);
    }
   
}
