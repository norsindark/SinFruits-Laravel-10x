<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_amount',
        'address',
        'phone',
        'email',
        'notes',
        'full_name',
        'status',
    ];


    //users
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    //order items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }


    // cancel order
    // public function cancelOrder()
    // {
    //     return $this->hasOne(OrderCancellation::class);
    // }
    public function orderCancellations()
    {
        return $this->hasMany(OrderCancellation::class);
    }

    // Cancel order
    public function cancelOrder()
    {
        $this->status = 4; 
        $this->save();

        // $cancellation = new OrderCancellation();
        // $cancellation->order_id = $this->id;
        // $cancellation->status = 1;
        // $cancellation->update();
    }
}
