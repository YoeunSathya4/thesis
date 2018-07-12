<?php

namespace App\Http\Controllers\Frontend;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rule;
use Session ;

use App\Model\Customer\Customer as Customer;
use App\Model\Customer\Code as Code;
use Nexmo\Laravel\Facade\Nexmo;

class SignUpController extends FrontendController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

   /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'en/verify-code';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    public function showRegisterForm($locale ){
        $defaultData = $this->defaultData($locale);
        return view('frontend.sign-up', ['defaultData'=>$defaultData ,'locale'=>$locale]);
    }

    public function register(Request $request, $locale){
        //$this->validator($request->all())->validate();
        $input = $request->all();
        $customer = $this->create($input)->toArray();
        
            //event(new Registered($customer = $this->create($request->all())));
            //$customer = $this->create($input)->toArray();
            $code = new Code;
            $code->code           = rand();
            $code->customer_id    = $customer['id'];
            $code->save();
            $numberPhone = '855'.substr( $customer['phone'], 1 );
            //echo $numberPhone;die;
            Nexmo::message()->send([
                'to'   => $numberPhone,
                'from' => $numberPhone,
                'text' => 'Your verify code is:'.$code->code
            ]); 

            $defaultData = $this->defaultData($locale);
            return view('frontend.verify-code', ['defaultData'=>$defaultData, 'locale'=>$locale]);
        
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'phone' => [
                            'required',
                            'regex:/(^[0][0-9].{7}$)|(^[0][0-9].{8}$)/',
                            'unique:customers'

                        ],
            'email' => 'required|email|max:255|unique:customers',
            'password' => 'required|min:6|confirmed',
        ], 
        [
            'email.unique' => 'The email address has already existed. Please try new one.',
            'phone.regex' => 'Please enter correct phone number format. E.g 0965416704'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        Session::flash('msg', 'Your account has been created. Please verify your code. ' );
        return Customer::create(
            [
                'name' => $data['name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]
        );
    }
    protected function guard()
    {
        return Auth::guard('customer');
    }

    public function verifyCodeForm($locale ){
        $defaultData = $this->defaultData($locale);
        return view('frontend.verify-code', ['defaultData'=>$defaultData ,'locale'=>$locale]);
    }

    public function submitCode(Request $request) {
        
        $this->validate($request, [
            'code' => 'required|min:6',
        ]);
        
        $code = $request->input('code'); 
        

        $data = Code::where(['code'=>$code])->orderBy('id', 'DESC')->first(); 
      
        if($data){
            
                $customer = Customer::findOrFail($data->customer_id);
                if($customer){
                    $customer->is_phone_verified = 1;
                    $customer->save();

                    Auth::guard('customer')->loginUsingId($customer->id, true);
                    
                    if(Session::has('oldUrl')){
                        $oldUrl = Session::get('oldUrl');
                        Session::forget('oldUrl');
                        return redirect()->to($oldUrl);
                    }

                    return redirect('en/profile');
                    
                }else{
                    
                     Session::flash('error', 'User Not Found!');
                     return redirect('en/verify-code');
                }
                
        }else{
           
            Session::flash('error', 'Code Not Valid!');
            return redirect('en/verify-code');
        }
       
    }

}
