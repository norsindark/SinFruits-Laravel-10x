<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    // protected $fillable = ['product_details_id', 'image_path'];

    // public function productDetail()
    // {
    //     return $this->belongsTo(ProductDetail::class);
    // }

    protected $fillable = [
        'product_id',
        'image_path',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
