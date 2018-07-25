<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use Session ;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\CamCyber\AgentController as Agent;
use App\Http\Controllers\CamCyber\IpAddressController as IpAddress;
use App\Model\Product\Favorite;

use Image;
use App\Model\Product\Cart;
use App\Model\Customer\Customer as Model;
use App\Model\Order\Order as Order;
use App\Model\Order\OrderDetails as OrderDetails;
class ProfileController extends FrontendController
{
    

    public function index($locale) {
        $customer = Auth::guard('customer')->user();
        $defaultData = $this->defaultData($locale);
        if($customer != ''){
            return view('frontend.profile',['defaultData'=>$defaultData, 'locale'=>$locale,'data'=>$customer]);
        }else{
            return view('frontend.login',['defaultData'=>$defaultData, 'locale'=>$locale]);
        }
        
    }

     public function update(Request $request){
        $id = $request->input('id');
        Validator::make(
                        $request->all(), 
                        [
                            'name' => 'required',
                            'phone' => [
                                            'required',
                                            Rule::unique('customers')->ignore($id)
                                        ],
                            'email' => [
                                            'required',
                                            'email',
                                            Rule::unique('customers')->ignore($id)
                                        ],
                            
                        ],
                        [
                            'email.unique' => 'New new email address :'.$request->input('email').' can not be used. It has already been taken.',
                            
                        ])->validate();

        
        $data = array(
                    'name' =>   $request->input('name'),
                    'location' =>   $request->input('location'),
                    'address' =>   $request->input('address'),
                    'phone' =>  $request->input('phone'), 
                    'email' =>  $request->input('email')
                );
        //echo  $request->input('name');die;
         if($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension(); 
            Image::make($image->getRealPath())->resize(200, 165)->save(public_path('uploads/customers/image/'.$imagename));
            $data['image']=$imagename;
        }

        //echo $picture; die;
        Model::where('id', $id)->update($data);
        Session::flash('msg', 'Data has been updated!' );
        return redirect()->back();
    }

    public function newPassword($locale ){

        $defaultData = $this->defaultData($locale);
        return view('frontend.new-password', ['defaultData'=>$defaultData ,'locale'=>$locale]);
    }

     public function submitNewPassword(Request $request,$locale){
        $id = Auth::guard('customer')->user()->id;
        
        $data = array(
                    'password' =>   bcrypt($request->input('password')),
                );

        //echo $picture; die;
        Model::where('id', $id)->update($data);
        Session::flash('msg', 'Password has been changed!' );
        return redirect($locale.'/profile');
    }


    public function changePassword (Request $request){
        $id = Auth::guard('customer')->user()->id;
        $old_password = $request->input('old_password');
        $current_password = Model::find($id)->password;
        // echo $old_password. '<br />';
        // echo $current_password. '<br />';die; 

        if (password_verify($old_password, $current_password)){ 

            Validator::make(
                        $request->all(), 
                        [
                            'new_password'         => 'required|min:6|max:18',
                            'confirm_password' => 'required|same:new_password',
                        ], 
                        [
                            'new_password.same' => 'Please confirm your password.',
                        ])->validate();
            Model::where('id', $id)->update(['password' => bcrypt($request->input('new_password'))]);
            Session::flash('msg', 'Password has been Reset!' );
            return redirect()->back();
        }else{
            Session::flash('error', 'Password dose not match!');
            return redirect()->back();
        }
       
        
    }


    public function pandingOrder($locale){
        $defaultData = $this->defaultData($locale);
        if(!Session::has('cart')){
            return view('frontend.panding-order',['defaultData'=>$defaultData,'locale'=>$locale,'product'=>null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('frontend.panding-order',['defaultData'=>$defaultData, 'locale'=>$locale,'products'=> $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

   public function orderHistory($locale){
        $customer_id = Auth::guard('customer')->user()->id;
        //dd($customer_id);
        $defaultData = $this->defaultData($locale);
        if($customer_id != ''){
            $orders = Order::select('*')->where('customer_id',$customer_id)->orderBy('id','DESC')->get();

            return view('frontend.order-history',['defaultData'=>$defaultData, 'locale'=>$locale,'orders'=>$orders]);
        }else{
            return view('frontend.login',['defaultData'=>$defaultData, 'locale'=>$locale]);
        }
   }

   public function orderHistoryDetail($locale='', $id = 0){

        $customer_id = Auth::guard('customer')->user()->id;
        //dd($customer_id);
        $defaultData = $this->defaultData($locale);
        if($customer_id != ''){
                $details = OrderDetails::select('*')->with(['product:id,'.$locale.'_name as productName'])->where('order_id',$id)->get();
                //dd($details);
                return view('frontend.order-history-detail',['defaultData'=>$defaultData, 'locale'=>$locale,'details'=>$details]);
        }else{
            return view('frontend.login',['defaultData'=>$defaultData, 'locale'=>$locale]);
        }
   }
   	
    public function favoriteProduct($locale){
        $customer_id = Auth::guard('customer')->user()->id;
        //dd($customer_id);
        $defaultData = $this->defaultData($locale);
        if($customer_id != ''){
            $favorites = Favorite::select('*')->where('customer_id',$customer_id)->with(['product:id,'.$locale.'_name as productName'])->get();
            //dd($favorites);
            return view('frontend.favorite-product',['defaultData'=>$defaultData, 'locale'=>$locale,'favorites'=>$favorites]);
        }else{
            return view('frontend.login',['defaultData'=>$defaultData, 'locale'=>$locale]);
        }
   }
   	
}
