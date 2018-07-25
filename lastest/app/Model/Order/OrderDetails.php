<?php

namespace App\Model\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetails extends Model
{
   	use SoftDeletes;
    protected $table = 'order_details';

    public function order(){
    	return $this->belongsTo('App\Model\Order\Order');
    }
    public function product(){
        return $this->belongsTo('App\Model\Product\Product','product_id');
    }
    
}