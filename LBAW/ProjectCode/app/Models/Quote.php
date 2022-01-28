<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    public $timestamps = false;
    public $incrementing = false;

    protected $table = 'quote';

    protected $primaryKey = 'id';
}
