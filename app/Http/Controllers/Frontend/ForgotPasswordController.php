<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;
use Illuminate\Mail\Message;
use Session;
use Illuminate\Support\Facades\Auth;

use App\Model\Customer\Customer as Customer;
use App\Model\Customer\Code as Code;
use Nexmo\Laravel\Facade\Nexmo;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;

class ForgotPasswordController extends FrontendController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
  
    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }
    
    // protected function broker(){
    //     return Password::broker('user');
    // }
    function showLinkRequestForm($locale){
        $defaultData = $this->defaultData($locale);;
        return view('frontend.forgot-password', ['defaultData'=>$defaultData, 'locale'=>$locale]);
    }

    public function sendResetCode(Request $request,$locale){
            $input = $request->all();
            $phone = $request->input('phone');
            $customer = Customer::select('*')->where('phone',$phone)->first();
            
            if($customer != ''){
               $code = new Code;
                $code->code           = rand();
                $code->customer_id    = $customer->id;
                $code->save();
                $numberPhone = '855'.substr( $customer->phone, 1 );
                //echo $numberPhone;die;
                Nexmo::message()->send([
                    'to'   => $numberPhone,
                    'from' => $numberPhone,
                    'text' => 'Your verify code is:'.$code->code
                ]); 
                $defaultData = $this->defaultData($locale);
                return view('frontend.verify-forgot-password-code', ['defaultData'=>$defaultData, 'locale'=>$locale]); 
            }else{
                Session::flash('error', 'Phone Not Valid!');
                return redirect('en/verify-code');
            }
            
    }

    public function verifyCodeForm($locale ){

        $defaultData = $this->defaultData($locale);
        return view('frontend.verify-forget-password-code', ['defaultData'=>$defaultData ,'locale'=>$locale]);
    }

    public function submitCodeForgotPassword(Request $request) {
        
        $this->validate($request, [
            'code' => 'required|min:6',
        ]);
        
        $code = $request->input('code'); 
        

        $data = Code::where(['code'=>$code])->orderBy('id', 'DESC')->first(); 
      
        if($data){
            
                $customer = Customer::findOrFail($data->customer_id);
                if($customer){
                    Auth::guard('customer')->loginUsingId($customer->id, true);
                    //return redirect('en/profile');
                    return redirect('en/new-password');
                    
                }else{
                    
                     Session::flash('error', 'User Not Found!');
                     return redirect('en/verify-forgot-password-code');
                }
                
        }else{
           
            Session::flash('error', 'Code Not Valid!');
            return redirect('en/verify-forgot-password-code');
        }
       
    }


    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        
        $response = $this->broker()->sendResetLink($request->only('email'));
        
        return $response == Password::RESET_LINK_SENT
                    ? $this->sendResetLinkResponse($response)
                    : $this->sendResetLinkFailedResponse($request, $response);
    }
    protected function sendResetLinkResponse($response)
    {
        Session::flash('msg', 'We have send you an email. Please read instruction there. Thanks.' );
        return back()->with('status', trans($response));
    }
    protected function guard()
    {
        return Auth::guard('customer');
    }
    protected function broker()
    {
        return Password::broker('customers');
    }
}
