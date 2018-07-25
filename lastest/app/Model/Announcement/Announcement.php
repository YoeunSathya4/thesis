<?php

namespace App\Model\Announcement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Announcement extends Model
{
    //use SoftDeletes;
    protected $table = 'announcements';
    //protected $dates = ['deleted_at'];

   public function creator(){
        return $this->belongsTo('App\Model\User\User','creator_id');
    }
    public function updater(){
        return $this->belongsTo('App\Model\User\User','updater_id');
    }


}
