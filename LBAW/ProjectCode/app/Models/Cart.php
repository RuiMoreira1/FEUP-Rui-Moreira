<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $timestamps = false;

    protected $table = 'product_in_cart';

    protected $primaryKey ='id_product';

    protected $fillable = [
        'id_product', 'id_user', 'quantity',
    ];

    public function cartProduct(){
        return $this->belongsTo(Product::class, 'id_product');
    }

    public function userCart(){
        return $this->belongsTo(Product::class, 'id_user');
    }

}
