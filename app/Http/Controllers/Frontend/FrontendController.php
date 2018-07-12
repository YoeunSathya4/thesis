<?php

namespace App\Http\Controllers\Frontend;

use Session;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

use App\Model\Promotion\Promotion;
use App\Model\Category\Category;
use App\Model\Category\SubCategory;
use App\Model\Category\SubSubCategory;

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

        $this->defaultData['promotions']            = Promotion::select('id',$locale.'_title as title','image')->limit(3)->get();
        $navbar_menu = array();
        $navbar_tab_menu = array();
        $categories           = Category::select('id',$locale.'_name as name','image')->get();

        foreach($categories as $row){

            $subCategories = SubCategory::select('id', $locale.'_name as name')->where('category_id', $row->id)->get();
            $navbar_menu[] = array('id'=>$row->id,'name'=>$row->name, 'subCategories'=>$subCategories);
            foreach($subCategories as $subCategory){
                $subSubCategories = SubSubCategory::select('id', $locale.'_name as name')->where('sub_category_id', $subCategory->id)->get();
                $navbar_tab_menu[] = array('id'=>$subCategory->id,'name'=>$subCategory->name, 'subSubCategories'=>$subSubCategories);
            }
        }

        $this->defaultData['navbar_menu'] = $navbar_menu;
        $this->defaultData['navbar_tab_menu'] = $navbar_tab_menu;
        return $this->defaultData;
    }
    
    public function submitNewsletter(Request $request , $locale = "en")
    {
        $now        = date('Y-m-d H:i:s');
        $defaultData = $this->defaultData($locale);

        $data = array(
                    'email' =>  $request->input('email'),
                    'created_at' => $now
                );
         Session::flash('invalidData', $data );
         Validator::make(
                        $request->all(), 
                        [
                            'email' => 'email',
                        ])->validate();
        
        //Mail::to('koeun@gmail.com')->send(new NewUserWelcome($data));
        //$client_email = $request->input('email');
        //Mail::to($client_email)->send(new ReplyBackToClients($data)); 
        $id=Newsletter::insertGetId($data);
        Session::flash('msg', __('contact_us.contact-successful-sent') );
        //return redirect(route('home', ['locale'=>$locale]));
    }
}
