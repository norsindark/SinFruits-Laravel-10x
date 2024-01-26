<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'user_id', 'comment', 'rating', 'parent_id'];

    //products
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    //users
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //replies
    public function replies()
    {
        return $this->hasMany(ProductReview::class, 'parent_id');
    }

    //paren comments
    public function parent()
    {
        return $this->belongsTo(ProductReview::class, 'parent_id');
    }
}
