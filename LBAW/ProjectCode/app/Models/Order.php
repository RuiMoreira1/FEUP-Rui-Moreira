<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;

    protected $table = 'order';

    protected $guarded = [];
    //protected $fillable = [
    //    'product_name', 'price', 'stock', 'discount', 'star_rating', 'synopsis', 'book_width', 'book_height', 'prod_type',
    //];


    public function processing(){
        return $this->belongsTo(Processing::class, 'id');
    }

    public function shipped(){
        return $this->belongsTo(Shipped::class, 'order_id');
    }

}
