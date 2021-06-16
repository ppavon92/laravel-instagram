<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table="users";
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    //FUNCTIONS
    public function images(){
        return $this->hasMany('App\Images', 'user_id')->orderBy('id','desc');
    }

    public function comments(){
        return $this->hasMany('App\Comments', 'user_id')->orderBy('id','desc');
    }

    public function likes(){
        return $this->hasMany('App\Likes', 'user_id')->orderBy('id','desc');
        // return $this->hasMany(Likes::Class)->orderBy('id','desc');
    }

    public function liked($id) {
        $image = $this->likes()->where('image_id', $id)->first();
        return $image != null;
    }

    public function hascomment($id) {
        $userid = Auth::user()->id;
        $comment = $this->comments()->where([
            ['id', $id],
            ['user_id', $userid]])->first();
        return $comment != null;
    }
}
