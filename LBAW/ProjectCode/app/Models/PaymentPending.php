<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentPending extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'payment_pending';

    protected $guarded = [];
}
