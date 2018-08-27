<?php

namespace App\Http\Controllers\CP\Product;

use Auth;
use Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CamCyber\FileUploadController as FileUpload;
use App\Http\Controllers\CamCyber\FunctionController;
use App\Http\Controllers\CamCyber\GenerateSlugController as GenerateSlug;

use App\Model\Product\Product as Model;
use App\Model\Category\Category as Category;
use App\Model\Category\SubCategory as SubCategory;

use App\Model\Category\SubSubCategory as SubSubCategory;
use App\Model\User\Tracking;
use Image;


class ProductController extends Controller
{
    protected $route; 
    public function __construct(){
        $this->route = "cp.product";
    }
    function validObj($id=0){
        $data = Model::find($id);
        if(empty($data)){
           echo "Invalide Object"; die;
        }
    }

    public function index(){
        $data            = Model::select('*');
        $limit           =   intval(isset($_GET['limit'])?$_GET['limit']:10); 
        $key             =   isset($_GET['key'])?$_GET['key']:"";
        $category        =   intval(isset($_GET['category'])?$_GET['category']:0); 
        $subcategory     =   intval(isset($_GET['subcategory'])?$_GET['subcategory']:0);
        $maincategory    =   intval(isset($_GET['maincategory'])?$_GET['maincategory']:0);
        $from=isset($_GET['from'])?$_GET['from']:"";
        $till=isset($_GET['till'])?$_GET['till']:"";
        $appends=array('limit'=>$limit);
        if( $key != "" ){
            $data = $data->where('en_name', 'like', '%'.$key.'%')->orWhere('kh_name', 'like', '%'.$key.'%');
            $appends['key'] = $key;
        }

        //=====================>>> Province
        if( $category > 0 ){
            $data = $data->where('category_id', $category);
            $appends['category'] = $category;
            if( $subcategory > 0){
                $data = $data->where('sub_category_id', $subcategory);
                $appends['subcategory'] = $subcategory;
                if( $maincategory > 0){
                    $data = $data->where('sub_sub_category_id', $maincategory);
                    $appends['maincategory'] = $maincategory;
                }
            }
        }

        if(FunctionController::isValidDate($from)){
            if(FunctionController::isValidDate($till)){
                $appends['from'] = $from;
                $appends['till'] = $till;

                $from .=" 00:00:00";
                $till .=" 23:59:59";

                $data = $data->whereBetween('created_at', [$from, $till]);
            }
        }
        if(Auth::user()->position_id == 1){
            $data= $data->orderBy('created_at', 'DESC')->paginate($limit);
        }else{
            $data= $data->orderBy('created_at', 'DESC')->where('is_deleted',0)->paginate($limit);
        }
        $categories = Category::get();
        return view($this->route.'.index', ['route'=>$this->route, 'categories'=>$categories, 'data'=>$data,'appends'=>$appends]);
    }
   
    public function create(){
        $categories = Category::get();
        return view($this->route.'.create' , ['route'=>$this->route,'categories'=>$categories]);
    }
    public function store(Request $request) {
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');

        $data = array(
                    'code' =>   $request->input('code'),
                    'category_id' =>   $request->input('category_id'),
                    'sub_category_id' =>   $request->input('subcategory_id'),
                    'sub_sub_category_id' =>   $request->input('maincategory_id'),
                    'kh_name' =>   $request->input('kh_name'), 
                    'en_name' =>  $request->input('en_name'),
                    'unit_price' =>   $request->input('unit_price'), 
                    'product_qty' =>  $request->input('product_qty'),
                    'slug'      =>   GenerateSlug::generateSlug('products', $request->input('en_name')),
                    'kh_description' =>   $request->input('kh_description'), 
                    'en_description' =>  $request->input('en_description'),
                    'kh_content' =>   $request->input('kh_content'), 
                    'en_content' =>  $request->input('en_content'),
                    'creator_id' => $user_id,
                    'is_published' =>  $request->input('status'),
                    'is_featured' =>  $request->input('featured'),
                    'is_deleted' =>  0,
                    'created_at' => $now
                );
        
        Session::flash('invalidData', $data );
        Validator::make(
                        $data, 
                        [
                            'category_id' => 'required|exists:categories,id',
                            'sub_category_id' => 'required|exists:sub_categories,id',
                            //'sub_sub_category_id' => 'required|exists:sub_sub_categories,id',
                           'kh_name' => 'required',
                           'en_name' => 'required',
                           'unit_price' => 'required',
                           'product_qty' => 'required',
                           'kh_description' => 'required',
                           'en_description' => 'required'
                        ]);

        // if($request->input('status')=="")
        // {
        //     $data['is_published']=0;
        // }else{
        //     $data['is_published']=1;
        // }
        // if($request->input('featured')=="")
        // {
        //     $data['is_featured']=0;
        // }else{
        //     $data['is_featured']=1;
        // }
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension(); 
            Image::make($image->getRealPath())->resize(420, 420)->save(public_path('uploads/product/image/'.$imagename));
            $data['image']=$imagename;
        }else{
            $data['image']='';
        }

		$id=Model::insertGetId($data);
        $tracking_data = Model::find($id);
        $tracking = new Tracking();
        $tracking->user_id = $user_id;
        $tracking->created_at = $now;
        $tracking->description = 'Create new product name:'.$tracking_data->en_name;
        $tracking->save();
        Session::flash('msg', 'Data has been Created!');
		return redirect(route($this->route.'.edit', $id));
    }

    public function edit($id = 0){
        $categories = Category::get();
        $this->validObj($id);
        $data = Model::find($id);
        $sub_category = SubCategory::select('*')->where('id',$data->sub_category_id)->first();
        $main_category = SubSubCategory::select('*')->where('id',$data->sub_sub_category_id)->first();
        return view($this->route.'.edit', ['route'=>$this->route, 'id'=>$id, 'data'=>$data,'categories'=>$categories,'sub_category'=>$sub_category,'main_category'=>$main_category]);
    }

    public function update(Request $request){
        $id = $request->input('id');
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');

        $data = array(
                    'code' =>   $request->input('code'),
                    'category_id' =>   $request->input('category_id'),
                    'sub_category_id' =>   $request->input('subcategory_id'),
                    'sub_sub_category_id' =>   $request->input('maincategory_id'),
                    'kh_name' =>   $request->input('kh_name'), 
                    'en_name' =>  $request->input('en_name'),
                    'unit_price' =>   $request->input('unit_price'), 
                    'product_qty' =>  $request->input('product_qty'),
                    'slug'      =>   GenerateSlug::generateSlug('products', $request->input('en_name')),
                    'kh_description' =>   $request->input('kh_description'), 
                    'en_description' =>  $request->input('en_description'),
                    'kh_content' =>   $request->input('kh_content'), 
                    'en_content' =>  $request->input('en_content'),
                    'is_published' =>  $request->input('status'),
                    'is_featured' =>  $request->input('featured'),
                    'is_deleted' =>  0,
                    'updater_id' => $user_id,
                    'updated_at' => $now
                );
        

        Validator::make(
        				$data, 
			        	[
                            'category_id' => 'required|exists:categories,id',
                            'sub_category_id' => 'required|exists:sub_categories,id',
                            //'sub_sub_category_id' => 'required|exists:sub_sub_categories,id',
                           'kh_name' => 'required',
                           'en_name' => 'required',
                           'unit_price' => 'required',
                           'product_qty' => 'required',
                           'kh_description' => 'required',
                           'en_description' => 'required'
						]);
        // if($request->input('status')=="")
        // {
        //     $data['is_published']=0;
        // }else{
        //     $data['is_published']=1;
        // }
        // if($request->input('featured')=="")
        // {
        //     $data['is_featured']=0;
        // }else{
        //     $data['is_featured']=1;
        // }
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension(); 
            Image::make($image->getRealPath())->resize(420, 420)->save(public_path('uploads/product/image/'.$imagename));
            $data['image']=$imagename;
        }else{
            $data['image']='';
        }
        Model::where('id', $id)->update($data);
        $tracking_data = Model::find($id);
        $tracking = new Tracking();
        $tracking->user_id = $user_id;
        $tracking->created_at = $now;
        $tracking->description = 'Update product name:'.$tracking_data->en_name;
        $tracking->save();
        Session::flash('msg', 'Data has been updated!' );
        return redirect()->back();
	}

    public function trash($id){
        $user_id    = Auth::id();
        $now      = date('Y-m-d H:i:s');
        Model::where('id', $id)->update(['is_deleted'=>1,'deleter_id' => Auth::id(), 'deleted_at'=>$now]);
        //Model::find($id)->delete();
        $tracking_data = Model::find($id);
        $tracking = new Tracking();
        $tracking->user_id = $user_id;
        $tracking->created_at = $now;
        $tracking->description = 'Delete product name:'.$tracking_data->en_name;
        $tracking->save();
        Session::flash('msg', 'Data has been delete!' );
        return response()->json([
            'status' => 'success',
            'msg' => 'Product has been deleted'
        ]);
    }

    public function delete($id){
        $now      = date('Y-m-d H:i:s');
        //Model::where('id', $id)->update(['is_deleted'=>1,'deleter_id' => Auth::id(), 'deleted_at'=>$now]);
        Model::find($id)->delete();
        Session::flash('msg', 'Data has been delete!' );
        return response()->json([
            'status' => 'success',
            'msg' => 'Product has been deleted'
        ]);
    }
    function updateStatus(Request $request){
      $user_id    = Auth::id();
      $now      = date('Y-m-d H:i:s');
      $id   = $request->input('id');
      $data = array('is_published' => $request->input('active'));
      Model::where('id', $id)->update($data);
      $tracking_data = Model::find($id);
      if($request->input('active') == 1){
        $tracking = new Tracking();
        $tracking->user_id = $user_id;
        $tracking->created_at = $now;
        $tracking->description = 'Update product publish name:'.$tracking_data->en_name;
        $tracking->save();
    }else{
        $tracking = new Tracking();
        $tracking->user_id = $user_id;
        $tracking->created_at = $now;
        $tracking->description = 'Update product unpublish name:'.$tracking_data->en_name;
        $tracking->save();
    }
      return response()->json([
          'status' => 'success',
          'msg' => 'Published status has been updated.'
      ]);
    }
    function updateFeatured(Request $request){
      $user_id    = Auth::id();
      $now      = date('Y-m-d H:i:s');
      $id   = $request->input('id');
      $data = array('is_featured' => $request->input('active'));
      
      Model::where('id', $id)->update($data);
      $tracking_data = Model::find($id);
      if($request->input('active') == 1){
        $tracking = new Tracking();
        $tracking->user_id = $user_id;
        $tracking->created_at = $now;
        $tracking->description = 'Update product feature name:'.$tracking_data->en_name;
        $tracking->save();
    }else{
        $tracking = new Tracking();
        $tracking->user_id = $user_id;
        $tracking->created_at = $now;
        $tracking->description = 'Update product unfeature name:'.$tracking_data->en_name;
        $tracking->save();
    }
      return response()->json([
          'status' => 'success',
          'msg' => 'Featured status has been updated.'
      ]);
    }
    function updateDeletedStatus(Request $request){
      $id   = $request->input('id');
      $data = array('is_deleted' => $request->input('active'));
      Model::where('id', $id)->update($data);
      return response()->json([
          'status' => 'success',
          'msg' => 'Status has been updated.'
      ]);
    }
    function getSubCategory($category_id = 0){
        $category_id = isset($_GET['category_id'])?$_GET['category_id']:'';
        if(  is_numeric ($category_id) ){
            if( $category_id != 0 ){
                $data = SubCategory::select('id', 'en_name','kh_name')->where('category_id',$category_id)->get();
                return view($this->route.'.sub-category-data', ['data'=>$data]);
            }else{
                echo '<select id="subcategory_id" name="subcategory_id" class="form-control">
                        <option value="0" >Please Select Category First</option>
                    </select>
                    ';
            }
        }else{
            echo "Not vaide data: ";
        }
    }


    function getMainCategory(){
        $subcategory_id = isset($_GET['subcategory_id'])?$_GET['subcategory_id']:'';
        if(  is_numeric ($subcategory_id) ){
            if( $subcategory_id != 0 ){
                $data = SubSubCategory::select('id', 'en_name','kh_name')->where('sub_category_id',$subcategory_id)->get();
                return view($this->route.'.main-category-data', ['data'=>$data]);
            }else{
                echo '<select id="maincategory_id" name="maincategory_id" class="form-control">
                        <option value="0" >Please Select Sub Category First</option>
                    </select>
                    ';
            }
        }else{
            echo "Not vaide data: ";
        }
    }

}
