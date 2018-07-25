<?php

namespace App\Model\User;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
   
    protected $table = 'user_trackings';
    public function user(){
        return $this->belongsTo('App\Model\User\User', 'user_id');
    }
   
}
