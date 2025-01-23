<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    
    protected $fillable = [
        'product_id', 
        'quantity_changed', 
        'expiration_date', 
        'transaction_date',
        'price_updated',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
