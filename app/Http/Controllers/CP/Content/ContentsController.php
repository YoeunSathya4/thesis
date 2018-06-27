<?php

namespace App\Http\Controllers\CP\Content;

use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CamCyber\FileUploadController as FileUpload;

use App\Model\Content as Model;



class ContentsController extends Controller
{
    
    function __construct (){
       $this->route = "cp.content.content";
    }

    public function listData($page = ""){   
      $data = Model::where('page', $page)->get();
      if(!empty($data)){
        return view($this->route.'.list', ['route'=>$this->route,'page' => $page, 'data'=>$data]);
      }else{
        return response(view('errors.404'), 404);
      }
    }
    public function showEditForm($slug = ""){   
      $data = Model::where('slug', $slug)->first();
      if(!empty($data)){
        return view($this->route.'.editForm', ['route'=>$this->route,'data'=>$data]);
      }else{
        return response(view('errors.404'), 404);
      }
    }
    
    public function update(Request $request){
        
      $id = $request->input('id');
      $slug = $request->input('slug');
      $image = "";
      $validate = array(
                      'en_content' => 'required',
                      'kh_content' => 'required'
                  );
      $data = array(
                  'kh_content' =>   $request->input('kh_content'),
                  'en_content' =>   $request->input('en_content')
              );

      if($request->input('image_required')){
          $validate['image'] = array( 'sometimes',
                                      'required',
                                      'mimes:jpeg,png',
                                      Rule::dimensions()->maxWidth($request->input('width'))->maxHeight($request->input('height'))
                                      );
          
          
      }
      //print_r($validate); die;
      Validator::make($request->all(), $validate)->validate();
  
      if($request->input('image_required')){
          $image = FileUpload::uploadFile($request, 'image', 'uploads/content');
          if($image != ""){
              $data['image'] = $image; 
          }
      }

      Model::where('id', $id)->update($data);
      Session::flash('msg', 'Data has been updated!' );
      return redirect()->back();

    }

   
    
}
