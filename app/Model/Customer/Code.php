<?php

namespace App\Model\Customer;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
   
    protected $table = 'customer_verify_codes';
    
    public function customer(){
        return $this->belongsTo('App\Model\Customer\Customer', 'customer_id');
    }
   
}
