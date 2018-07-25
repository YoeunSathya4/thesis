<?php

namespace App\Model\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favorite extends Model
{
    //use SoftDeletes;
    protected $table = 'customer_product_favorites';
    //protected $dates = ['deleted_at'];

   	public function product(){
        return $this->belongsTo('App\Model\Product\Product');
    }
    public function customer(){
        return $this->belongsTo('App\Model\Customer\Customer');
    }
    
}
