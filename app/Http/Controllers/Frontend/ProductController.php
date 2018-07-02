<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Model\Product\Product;

class ProductController extends FrontendController
{
    
    public function index($locale) {
    	$data = Product::select('id',$locale.'_name as name','image','unit_price');
        $key       =   isset($_GET['key'])?$_GET['key']:"";
        $category   =   intval(isset($_GET['category'])?$_GET['category']:0); 
        $subcategory    =   intval(isset($_GET['subcategory'])?$_GET['subcategory']:0);
        $maincategory    =   intval(isset($_GET['maincategory'])?$_GET['maincategory']:0);
        
        if( $key != "" ){
            $data = $data->where('en_name', 'like', '%'.$key.'%')->orWhere('kh_name', 'like', '%'.$key.'%');
            $appends['key'] = $key;
        }

        //=====================>>> Category
        if( $category > 0 ){
            $data = $data->where('category_id', $category);
            $appends['category'] = $category;
            if( $subcategory > 0){
                $data = $data->where('sub_category_id', $subcategory);
                $appends['subcategory'] = $subcategory;
                if( $maincategory > 0){
                    $data = $data->where('sub_sub_category_id', $maincategory);
                    $appends['maincategory'] = $maincategory;
                }
            }
        }

        $data= $data->orderBy('id', 'DESC')->paginate(12);

    	$defaultData = $this->defaultData($locale);
        return view('frontend.product',['defaultData'=>$defaultData, 'locale'=>$locale, 'data'=>$data]);
    }
   
}
