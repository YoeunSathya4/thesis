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
