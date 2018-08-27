<?php

namespace App\Http\Controllers\Frontend;

use Session;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Model\Message\Message;
class ContactUsController extends FrontendController
{
    
    public function index($locale) {
        $defaultData = $this->defaultData($locale);
        return view('frontend.contact-us',['defaultData'=>$defaultData,'locale'=>$locale]);
    }

    public function submitContact(Request $request , $locale = "en")
    {
        $defaultData = $this->defaultData($locale);
        $data = array(
                    'name' =>   $request->input('name'),
                    'phone' =>  $request->input('phone'),
                    
                    'message' =>  $request->input('message') 
                );
        //dd($data);
        Session::flash('invalidData', $data );
         Validator::make(
                        $request->all(), 
                        [
                            'name' => 'required|min:1|max:30',
                            'phone' => 'required|numeric',
                            'message' => 'required|max:255',
                            // 'g-recaptcha-response' => 'required',
                        ], 

                        [
                            
                        ])->validate();
        
        // Mail::to('yoeunsathya4@gmail.com')->send(new NewUserWelcome($data));
        // $client_email = $request->input('email');
        // Mail::to($client_email)->send(new ReplyBackToClients($data)); 
        $id=Message::insertGetId($data);
        Session::flash('msg', __('general.contact-successful-sent') );
        return redirect(route('contact-us', ['locale'=>$locale]));
    }
}
