<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editor extends Model
{
    public $timestamps = false;

    protected $table = 'editor';

    protected $fillable = [
        'name',
    ];
}
