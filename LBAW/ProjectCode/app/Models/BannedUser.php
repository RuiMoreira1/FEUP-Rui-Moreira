<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannedUser extends Model
{

    public $timestamps = false;

    protected $table = 'banned_user';

    protected $primaryKey ='id_user';

    protected $guarded = [];
}
