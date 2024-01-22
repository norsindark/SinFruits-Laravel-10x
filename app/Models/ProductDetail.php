<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'description', 'price'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // public function images()
    // {
    //     return $this->hasMany(ProductImage::class);
    // }
}
