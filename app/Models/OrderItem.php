<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'unit_price'
    ];


    //orders
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    //product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    //product warehouses
    public function productWarehouse()
    {
        return $this->belongsTo(ProductWarehouse::class, 'product_id', 'product_id');
    }
}
