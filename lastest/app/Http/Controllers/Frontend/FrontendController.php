<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use Session;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

use App\Model\Product\Favorite;
use App\Model\Product\Product;
use App\Model\Promotion\Promotion;
use App\Model\Category\Category;
use App\Model\Category\SubCategory;
use App\Model\Category\SubSubCategory;
use App\Model\Slide\Slide;
use App\Model\Content;

class FrontendController extends Controller
{
  	
	public $defaultData = array();
    public function __construct(){
        
    }

    public function defaultData($locale = "en"){
        App::setLocale($locale);

        //Current Language
        $parameters = Route::getCurrentRoute()->parameters();
        $enRouteParamenters = $parameters;
        $enRouteParamenters['locale'] = 'en';
        $this->defaultData['enRouteParamenters'] = $enRouteParamenters;
        $khRouteParamenters = $parameters;
        $khRouteParamenters['locale'] = 'kh';
        $this->defaultData['khRouteParamenters'] = $khRouteParamenters;
        $this->defaultData['routeName'] = Route::currentRouteName();

        $this->defaultData['promotions']            = Promotion::select('id',$locale.'_title as title','image')->limit(3)->where('is_deleted',0)->get();


        //=========================================== Slogan
        $this->defaultData['address'] = Content::select('id', $locale.'_content as content')->where('slug','address')->first();
        $this->defaultData['phone'] = Content::select('id', $locale.'_content as content')->where('slug','phone')->first();
        $this->defaultData['email'] = Content::select('id', $locale.'_content as content')->where('slug','email')->first();
        $this->defaultData['slogan'] = Content::select('id', $locale.'_content as content')->where('slug','slogan')->first();


        $this->defaultData['slides'] = Slide::select('*')->where(['is_published'=> 1,'is_deleted'=>0])->get();
        $navbar_menu = array();
        $navbar_tab_menu = array();
        $categories           = Category::select('id',$locale.'_name as name','image')->where('is_deleted',0)->get();

        foreach($categories as $row){

            $subCategories = SubCategory::select('id', $locale.'_name as name')->where('category_id', $row->id)->get();
            $navbar_menu[] = array('id'=>$row->id,'name'=>$row->name, 'subCategories'=>$subCategories);
            foreach($subCategories as $subCategory){
                $subSubCategories = SubSubCategory::select('id', $locale.'_name as name')->where(['sub_category_id'=> $subCategory->id,'is_deleted'=>0])->get();
                $navbar_tab_menu[] = array('id'=>$subCategory->id,'name'=>$subCategory->name, 'subSubCategories'=>$subSubCategories);
            }
        }

        $this->defaultData['navbar_menu'] = $navbar_menu;
        $this->defaultData['navbar_tab_menu'] = $navbar_tab_menu;
        return $this->defaultData;
    }
    


    // public function addToFavorite(Request $request , $locale = "")
    // {
    //     $now        = date('Y-m-d H:i:s');
    //     $defaultData = $this->defaultData($locale);
    //     $customer = Auth::guard('customer')->user();
    //     if($customer != ''){
    //         //$favorite = Favorite::select('*')->where(array('product_id'=>$id, 'customer_id'=>$customer->id))->first();
    //         //dd($favorite);
    //         //if($favorite  == null){

    //             $data = array(
    //                     'product_id' =>  $request->input('id'),
    //                     'customer_id' =>  $customer->id,
    //                     'is_favorited' =>  1,
    //                     'created_at' => $now
    //                 );
    //              Session::flash('invalidData', $data );
    //              Validator::make(
    //                             $request->all(), 
    //                             [
    //                                 'email' => 'email',
    //                             ])->validate();
                
    //             $id=Favorite::insertGetId($data);


    //             return response()->json('success', 200);

    //         // }else{
    //         //   Session::flash('error', "This product has already added to favorite.");
    //         //     return redirect()->back();  
    //         // }
            

    //     }else{
    //         return response()->json('error', 400);
    //     }

        
    // }

    // public function removeFromFavorite(Request $request , $locale = "")
    // {
    //     $now        = date('Y-m-d H:i:s');
    //     $defaultData = $this->defaultData($locale);
    //     $customer = Auth::guard('customer')->user();
    //     if($customer != ''){
    //         $favorite = Favorite::select('*')->where(array('product_id'=>$request->input('id'), 'customer_id'=>$customer->id))->first()->delete();
    //         // Session::flash('msg', "Product has been unfavorite.");
    //         // return redirect()->back();
            
    //         return response()->json('success', 200);

    //     }else{
    //         // Session::flash('error', "Please signin or signup before add to favorite.");
    //         // return redirect()->back();
    //         return response()->json('error', 400);
    //     }

        
    // }

    public function addToFavorite(Request $request , $locale = "", $id=0)
    {
        $now        = date('Y-m-d H:i:s');
        $defaultData = $this->defaultData($locale);
        $customer = Auth::guard('customer')->user();
        if($customer != ''){
            //$favorite = Favorite::select('*')->where(array('product_id'=>$id, 'customer_id'=>$customer->id))->first();
            //dd($favorite);
            //if($favorite  == null){

                $data = array(
                        'product_id' =>  $id,
                        'customer_id' =>  $customer->id,
                        'is_favorited' =>  1,
                        'created_at' => $now
                    );
                 Session::flash('invalidData', $data );
                 Validator::make(
                                $request->all(), 
                                [
                                    'email' => 'email',
                                ])->validate();
                
                $id=Favorite::insertGetId($data);


                Session::flash('msg', "Product has been added to favorite.");
                return redirect()->back();

            // }else{
            //   Session::flash('error', "This product has already added to favorite.");
            //     return redirect()->back();  
            // }
            

        }else{
            Session::flash('error', "Please signin or signup before add to favorite.");
            return redirect()->back();
        }

        
    }

    public function removeFromFavorite(Request $request , $locale = "", $id=0)
    {
        $now        = date('Y-m-d H:i:s');
        $defaultData = $this->defaultData($locale);
        $customer = Auth::guard('customer')->user();
        if($customer != ''){
            $favorite = Favorite::select('*')->where(array('product_id'=>$id, 'customer_id'=>$customer->id))->first()->delete();
            Session::flash('msg', "Product has been unfavorite.");
            return redirect()->back();
            
            

        }else{
            Session::flash('error', "Please signin or signup before add to favorite.");
            return redirect()->back();
        }

        
    }



}
