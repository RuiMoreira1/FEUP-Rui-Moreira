<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edition extends Model
{
    public $timestamps = false;

    protected $table = 'edition';

    protected $fillable = [
        'product_id','editor_id','name','date',
    ];

    protected $primaryKey ='product_id';

    public function productEdition(){
        return $this->belongsTo(Product::class,'product_id');
    }

    public function editionEditor(){
        return $this->belongsTo(Editor::class,'editor_id');
    }
}
