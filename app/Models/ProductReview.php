<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'user_id', 'comment', 'rating'];

    //products
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    //user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
