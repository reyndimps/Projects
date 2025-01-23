<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesOrderItem extends Model
{
    protected $fillable = [
        'sales_order_id', 
        'inventory_id', 
        'quantity', 
        'price', 
        'total'
    ];

    public function salesOrder()
    {
        return $this->belongsTo(SalesOrder::class);
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function product()
    {
        return $this->hasOneThrough(
            Product::class,
            Inventory::class,
            'id', 
            'id', 
            'inventory_id', 
            'product_id' 
        );
    }
}
