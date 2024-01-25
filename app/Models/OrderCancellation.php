<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCancellation extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'cancel_reason',
        'status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
