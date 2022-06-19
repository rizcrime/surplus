<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'file',
    ];

    public function product_images(){
        return $this->belongsTo(ProductImage::class, 'id', 'image_id');
    }

}
