<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    public $timestamps = false;
    public $incrementing = false;

    protected $table = 'wishlist';

    protected $primaryKey = ['product_id', 'id_user'];

    protected $fillable = [
     'product_id', 'id_user'   
    ];

    public function wishlistProduct(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function userWishlist(){
        return $this->belongsTo(Product::class, 'id_user');
    }
}
