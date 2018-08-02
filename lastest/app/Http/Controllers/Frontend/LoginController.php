<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use Session ;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\CamCyber\AgentController as Agent;
use App\Http\Controllers\CamCyber\IpAddressController as IpAddress;

use App\Model\Customer\Log;
class LoginController extends FrontendController
{
    use AuthenticatesUsers;

    //protected $redirectTo = 'en/profile';

    public function showFormLogin($locale) {

    	if(Auth::guard('customer')->user() == ''){
            $defaultData = $this->defaultData($locale);
    		return view('frontend.login',['defaultData'=>$defaultData, 'locale'=>$locale]);
    	}else{
            if(Session::has('oldUrl')){
                $oldUrl = Session::get('oldUrl');
                Session::forget('oldUrl');
                return redirect()->to($oldUrl);
            }
    		return redirect('en/profile');
    	}
        
    }

    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password'); 
        //$credentials['status'] = 1; 
            
        return $credentials;
    }
   

    protected function authenticated(Request $request, $user)
    {
        if(Session::has('oldUrl')){
                $oldUrl = Session::get('oldUrl');
                Session::forget('oldUrl');
                return redirect()->to($oldUrl);
        }
        return redirect()->to('en/profile');

    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);
            $agent      = new Agent;
            $info       = $agent::showInfo();
            $ipAddress  = new IpAddress;
            $ip         = $ipAddress::getIP(); 
            //Save Logs
            $log = new Log; 
            //echo Auth::guard('customer')->id;die;
            $log->customer_id   = Auth::guard('customer')->user()->id;
            $log->ip        = $ip;
            $log->os        = $info['os'];
            $log->broswer   = $info['browser'];
            $log->version   = $info['version'];
            $log->save();

        return $this->authenticated($request, $this->guard('customer')->user())
                ?: redirect()->intended($this->redirectPath());
    }
    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }
    public function username()
    {
        return 'phone';
    }

    protected function guard()
    {
        return Auth::guard('customer');
    }

    public function logout(Request $request,$locale){
        $this->guard('customer')->logout();
        //$request->session()->flush();
        //$request->session()->regenerate();
        return redirect()->route('login',['locale'=>$locale]);
    }
   	
   	
}
