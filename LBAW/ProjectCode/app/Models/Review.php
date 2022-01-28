<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Review extends Model
{
    public $timestamps = false;

    protected $table= 'review';

    protected $primaryKey = 'id';

    protected $fillable = [
        'star_rating', 'comment', 'id_user', 'id_product',
    ];

    public function productReviews(){
        return $this->belongsTo(Product::class, 'id_product');

    }

    public function owner(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function banned($id){
        $bannedUser = BannedUser::find($id);
        
        if($bannedUser == null){
            return false;
        }
        return true;
    }
}
