<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'enable',
    ];

    public function category_products(){
        return $this->belongsTo(CategoryProduct::class, 'id', 'product_id');
    }
}
