<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'birth_date', 'id_image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userReviews(){
        return $this->hasMany('App\Models\Review', 'id_user');
    }

    public function userCart(){
        return $this->hasMany('App\Models\Cart', 'id_user');
    }

    public function userWishlist() {
        return $this->hasMany('App\Models\Wishlist', 'id_user');
    }

    // /**
    //  * The cards this user owns.
    //  */
    //  public function cards() {
    //   return $this->hasMany('App\Models\Card');
    // }
}
