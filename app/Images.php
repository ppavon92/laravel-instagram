<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $table="images";
    public $timestamps = true;

    public function comments(){
        return $this->hasMany('App\Comments', 'image_id')->orderBy('id','desc');
    }

    public function likes(){
        return $this->hasMany('App\Likes', 'image_id')->orderBy('id','desc');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function nlikes($image_id){
        $nlikes = $this->likes()->where('image_id', $image_id)->count();
        return $nlikes;
    }
}
