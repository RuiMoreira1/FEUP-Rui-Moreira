<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGenre extends Model
{
    public $timestamps = false;

    protected $table = 'product_genre';

    protected $primaryKey ='product_id';

    protected $fillable = [
        'product_id', 'genre_id',
    ];

    use HasFactory;
}
