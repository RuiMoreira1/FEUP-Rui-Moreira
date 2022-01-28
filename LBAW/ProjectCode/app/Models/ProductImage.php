<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    public $timestamps = false;

    protected $table = 'product_image';

    public function getImage(){
        return $this->belongsTo('\App\Models\Image','id_image');
    }
}
