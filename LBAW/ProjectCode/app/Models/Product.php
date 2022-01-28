<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;

    protected $table = 'product';

    protected $guarded = [];
    
    public function getReviews(){
        return $this->hasMany('App\Models\Review','id_product');
    }

    public function getAuthor(){
        return $this->hasOne('\App\Models\ProductAuthor','product_id');
    }

    public function author(){
        return $this->hasOne('\App\Models\ProductAuthor','author_id');
    }

    public function productImages(){
        return $this->hasMany('\App\Models\ProductImage','id_product');
    }

    public function getEdition(){
        return $this->hasOne('\App\Models\Edition','editor_id');
    }
}
