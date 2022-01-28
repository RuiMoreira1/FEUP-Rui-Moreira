<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipped extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'shipped';

    protected $guarded = [];

    public function shipped(){
        return $this->belongsTo(Order::class, 'order_id');
    }
}
