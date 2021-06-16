<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table="comments";
    public $timestamps = true;

    public function images(){
        return $this->belongsTo('App\Images', 'image_id');
    }
}
