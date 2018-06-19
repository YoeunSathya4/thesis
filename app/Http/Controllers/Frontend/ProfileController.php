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


use Image;

use App\Model\Customer\Customer as Model;
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

   
   	
   	
}
