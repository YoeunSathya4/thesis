<?php

namespace App\Http\Controllers\CP\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Customer\Customer;
use App\Model\User\User;
use App\Model\Product\Product;
use App\Model\Order\Order;
use App\Model\Order\OrderDetails;
use App\Model\User\Tracking;

class MainController extends Controller
{
   public function __construct(){
        $this->route = "cp.dashboard";
    }
    public function validObj($id=0){
        $data = Model::find($id);
        if(empty($data)){
           echo "Invalide Object"; die;
        }
    }


    public function index(){
        $now      = date('Y:m:d 23:59:59');
        $yesterday = date('Y:m:d 00:00:00');
        $today_customer = count(Customer::select('*')->whereBetween('created_at', [$yesterday, $now])->get());
        $today_order = count(Order::select('*')->whereBetween('created_at', [$yesterday, $now])->get());

        $trackings      = Tracking::select('*')->orderBy('created_at','DESC')->limit(10)->get();
        $customers = Customer::select('*')->get();


        $orders = Order::select('*')->get();
        $products = Product::select('*')->where('is_deleted', 0)->get();

        $top_products  = Product::select('*')->withCount('details as num_top_products')->orderBy('num_top_products','DESC')->limit(4)->get();
        //dd($top_products);
        $new_orders = Order::select('*')->where('is_new',0)->get();


        //if(!empty($provinces && $users)){
            return view($this->route.'.index', ['route'=>$this->route, 'top_products'=>$top_products,'trackings'=>$trackings,'customers'=>$customers,'orders'=>$orders,'products'=>$products,'new_orders'=>$new_orders,'today_order'=>$today_order,'today_customer'=>$today_customer]);
        // }else{
        //     return view('errors.404');
        // }
       
    }
   
}
