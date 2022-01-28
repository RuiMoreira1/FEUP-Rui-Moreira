<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAuthor extends Model
{
    public $timestamps = false;

    protected $primaryKey ='product_id';

    protected $table = 'product_author';

    protected $fillable = [
        'product_id', 'author_id',
    ];

    public function productBelongs() {
        return $this->belongsTo('App\Models\Product','product_id');
    }

    public function authorBelongs() {
        return $this->belongsTo('App\Models\Author','author_id');
    }
}
