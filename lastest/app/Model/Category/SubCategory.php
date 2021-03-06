<?php

namespace App\Model\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
   	//use SoftDeletes;
    protected $table = 'sub_categories';

    public function Category(){
        return $this->belongsTo('App\Model\Category\Category');
    }

    public function subSubCategories(){
        return $this->hasMany('App\Model\Category\SubSubCategory');
    }
    public function products(){
        return $this->hasMany('App\Model\Product\Product');
    }
    public function creator(){
        return $this->belongsTo('App\Model\User\User','creator_id');
    }
    public function updater(){
        return $this->belongsTo('App\Model\User\User','updater_id');
    }

    public function deleter(){
        return $this->belongsTo('App\Model\User\User','deleter_id');
    }
}
