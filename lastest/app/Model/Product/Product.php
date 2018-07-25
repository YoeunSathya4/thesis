<?php

namespace App\Model\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //use SoftDeletes;
    protected $table = 'products';
    //protected $dates = ['deleted_at'];

   	public function Category(){
        return $this->belongsTo('App\Model\Category\Category');
    }
    public function SubCategory(){
        return $this->belongsTo('App\Model\Category\SubCategory');
    }
    public function MainCategory(){
        return $this->belongsTo('App\Model\Category\SubSubCategory');
    }
    public function details(){
        return $this->hasMany('App\Model\Order\OrderDetails','product_id');
    }

    public function favorites(){
        return $this->hasMany('App\Model\Product\Favorite');
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
