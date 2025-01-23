<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    protected $fillable = [
        'number_items',
        'total_amount', 
        'sales_tax',
        'cash_amount', 
        'change_amount'];

        protected $table = 'sales_order';

    public function items()
    {
        return $this->hasMany(SalesOrderItem::class);
    }

    public function products()
    {
        return $this->hasManyThrough(
            Product::class,
            SalesOrderItem::class,
            'sales_order_id', 
            'id',           
            'id',            
            'product_id'      
        );
    }
}