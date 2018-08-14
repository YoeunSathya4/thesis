<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Model\Product\Product;
use App\Model\Category\Category;
use App\Model\Category\SubCategory;
use App\Model\Category\SubSubCategory;
use App\Model\Order\Order as Order;
use App\Model\Order\OrderDetails as OrderDetails;
use Session;
use Stripe\Charge;
use Stripe\Stripe;

use App\Model\Product\Cart;

class ProductController extends FrontendController
{
    
    public function index($locale) {
    	$data = Product::select('id',$locale.'_name as name','image','unit_price','slug');
        $key       =   isset($_GET['key'])?$_GET['key']:"";
        $category   =   intval(isset($_GET['category'])?$_GET['category']:0); 
        $subcategory    =   intval(isset($_GET['subcategory'])?$_GET['subcategory']:0);
        $maincategory    =   intval(isset($_GET['maincategory'])?$_GET['maincategory']:0);
        $appends=array();
        if( $key != "" ){
            $data = $data->where('en_name', 'like', '%'.$key.'%')->orWhere('kh_name', 'like', '%'.$key.'%');
            $appends['key'] = $key;
        }


        //=====================>>> Category
        if( $category > 0 ){
            $data = $data->where('category_id', $category);
            $appends['category'] = $category;
            $appends['category_name'] = Category::select('id',$locale.'_name as name')->where('id',$category)->first()->name;
            if( $subcategory > 0){
                $data = $data->where('sub_category_id', $subcategory);
                $appends['subcategory'] = $subcategory;
                $appends['sub_category_name'] = SubCategory::select('id',$locale.'_name as name')->where('id',$subcategory)->first()->name;
                if( $maincategory > 0){
                    $data = $data->where('sub_sub_category_id', $maincategory);
                    $appends['maincategory'] = $maincategory;
                    $appends['sub_sub_category_name'] = SubSubCategory::select('id',$locale.'_name as name')->where('id',$maincategory)->first()->name;
                }
            }
        }

        $data= $data->where(['is_published'=>1,'is_deleted'=>0])->orderBy('id', 'DESC')->paginate(9);

    	$defaultData = $this->defaultData($locale);
        return view('frontend.product',['defaultData'=>$defaultData, 'locale'=>$locale, 'data'=>$data,'appends'=>$appends]);
    }
    public function searchProduct($locale) {
        $data = Product::select('id',$locale.'_name as name','image','unit_price','slug');
        $key       =   isset($_GET['key'])?$_GET['key']:"";
        $min   =   intval(isset($_GET['min'])?$_GET['min']:0); 
        $max    =   intval(isset($_GET['max'])?$_GET['max']:0);
        $appends=array();
        if( $key != "" ){
            $data = $data->where('en_name', 'like', '%'.$key.'%')->orWhere('kh_name', 'like', '%'.$key.'%');
            $appends['key'] = $key;
        }

        if($min){
            if($max){
                

                $data = $data->whereBetween('unit_price', [$min, $max]);
                $appends['min'] = $min;
                $appends['max'] = $max;
            }
        }
       

        $data= $data->where(['is_published'=>1,'is_deleted'=>0])->orderBy('id', 'DESC')->paginate(9);

        $defaultData = $this->defaultData($locale);
        return view('frontend.product-search',['defaultData'=>$defaultData, 'locale'=>$locale, 'data'=>$data,'appends'=>$appends]);
    }
    public function detail($locale = '', $slug = ''){
        $data = Product::select('id', $locale.'_name as name', $locale.'_description as description',$locale.'_content as content', 'image','product_qty','unit_price', 'created_at')->where('slug', $slug)->first();
        $defaultData = $this->defaultData($locale);
        $productId = $data->id;
        $relatedProducts = Product::select('id',$locale.'_name as name','image','unit_price','slug')->whereNotIn('id',[$productId])->orderBy('id', 'DESC')->limit(3)->get();
        return view('frontend.product-detail',['defaultData'=>$defaultData, 'locale'=>$locale, 'data'=>$data,'relatedProducts'=>$relatedProducts]);
    }
    
    public function AddToCart(Request $request,$locale = '', $id = 0){
        $productSession = Product::find($id);
        $defaultData = $this->defaultData($locale);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart ($oldCart);
        $cart->add($productSession, $productSession->id);
        $request->session()->put('cart', $cart);
        //dd($request->session()->get('cart'));
        //return view('frontend.product-detail',['defaultData'=>$defaultData, 'locale'=>$locale, 'data'=>$data,'relatedProducts'=>$relatedProducts]);
        Session::flash('msg', 'Product has been added!' );
        return redirect()->back();
    }

    public function getReduceByOne($locale = '',$id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart ($oldCart);
        $cart->reduceByOne($id);
        if(count($cart->items) > 0){
            Session::put('cart',$cart);
        }else{
            Session::forget('cart');
        }

        //Session::put('cart',$cart);
        Session::flash('msg', 'Product has been increase!' );
        return redirect()->route('shopping-cart',$locale);
    }
    public function getPlusByOne($locale = '',$id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart ($oldCart);
        $cart->plusByOne($id);
        if(count($cart->items) > 0){
            Session::put('cart',$cart);
        }else{
            Session::forget('cart');
        }

        //Session::put('cart',$cart);
        Session::flash('msg', 'Product has been removed!' );
        return redirect()->route('shopping-cart',$locale);
    }
    public function RemoveItem($locale = '',$id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart ($oldCart);
        $cart->removeItem($id);
        if(count($cart->items) > 0){
            Session::put('cart',$cart);
        }else{
            Session::forget('cart');
        }
        Session::flash('msg', 'All Product has been added!' );
        return redirect()->route('shopping-cart',$locale);
    }

    public function ShoppingCart($locale){
        $defaultData = $this->defaultData($locale);
        if(!Session::has('cart')){
            return view('frontend.shopping-cart',['defaultData'=>$defaultData,'locale'=>$locale,'product'=>null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        //dd($cart);

       
        return view('frontend.shopping-cart',['defaultData'=>$defaultData, 'locale'=>$locale,'products'=> $cart->items, 'totalPrice' => $cart->totalPrice]);
        
    }

    public function Checkout($locale){
        $defaultData = $this->defaultData($locale);
        if(!Session::has('cart')){
            return view('frontend.shopping-cart',['defaultData'=>$defaultData,'locale'=>$locale]); 
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        $customer = Auth::guard('customer')->user();
        if($customer != ''){
            return view('frontend.checkout', ['defaultData'=>$defaultData,'locale'=>$locale,'total'=>$total]);
        }else{
            Session::put('oldUrl', route('checkout',$locale));
            
            return view('frontend.login',['defaultData'=>$defaultData, 'locale'=>$locale]);
        }
    }

    public function Buy(Request $request,$locale = '', $id = 0){

        $productSession = Product::find($id);
        $defaultData = $this->defaultData($locale);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart ($oldCart);
        $cart->add($productSession, $productSession->id);
        $request->session()->put('cart', $cart);

        $defaultData = $this->defaultData($locale);
        if(!Session::has('cart')){
            return view('frontend.shopping-cart',['defaultData'=>$defaultData,'locale'=>$locale]); 
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        $customer = Auth::guard('customer')->user();
        if($customer != ''){
            return view('frontend.checkout', ['defaultData'=>$defaultData,'locale'=>$locale,'total'=>$total]);
        }else{
            Session::put('oldUrl', route('checkout',$locale));
            
            return view('frontend.login',['defaultData'=>$defaultData, 'locale'=>$locale]);
        }
    }

    public function postCheckout(Request $request,$locale = ''){
        if(!Session::has('cart')){
            return redirect()->route('shopping-cart',$locale);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $customerName = Auth::guard('customer')->user()->name;
        $customerPhone = Auth::guard('customer')->user()->phone;
        Stripe::setApiKey('sk_test_fMXB2txgqlGSoCJFaBwKfPVI');
        try {
            $charge = Charge::create(
                array(
                    "amount"=> $cart->totalPrice * 100,
                    "currency" => 'usd',
                    "source" => 'tok_amex',
                    "description" => $customerName.' and tel:'.$customerPhone,

                )
            );
            //==================================== Add Product to Database
            //dd($cart);
            $customer_id = Auth::guard('customer')->user()->id;
            $order = new Order();
            $order->customer_id = $customer_id;
            $order->is_success = 1;
            $order->is_new = 0;
            //$order->name = $request->input('name');
            //$order->address = $request->input('address');
            $order->payment_id = $charge->id;
            $order->save();
            
            foreach($cart->items as $row){
                OrderDetails::insert(['order_id' => $order->id, 'product_id' => $row['item']['id'],'qty' => $row['qty'], 'unit_price' => $row['price']]);
            }

        } catch(\Excepttion $e){
            return redirect('checkout',$locale)->with('error', $e->getMessage());

        }



        Session::forget('cart');
        return redirect()->route('thanks',$locale)->with('success', 'Successfully purchased products!');
    }

     public function thanks($locale){
        $defaultData = $this->defaultData($locale);
        

        
        $customer = Auth::guard('customer')->user();
        if($customer != ''){
            return view('frontend.thanks', ['defaultData'=>$defaultData,'locale'=>$locale]);
        }else{
            return view('frontend.login',['defaultData'=>$defaultData, 'locale'=>$locale]);
        }
    }

}
