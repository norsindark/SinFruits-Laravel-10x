<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $fillable = ['name'];

    public function product_warehouse()
    {
        return $this->hasMany(ProductWarehouse::class);
    }
}
