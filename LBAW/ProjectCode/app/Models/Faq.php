<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    public $timestamps = false;

    protected $table = 'faq';
    protected $guarded = [];

    /*protected $fillable = [
        question,
        answer
    ];*/




}
