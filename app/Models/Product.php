<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['id','name', 'sku', 'price', 'quantity'];

    public function salesOrderItems()
    {
        return $this->hasMany(SalesOrderItem::class);
    }
}
