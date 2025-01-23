<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product',
        'image',
        'supplier_id',
        'category',
        'brand',
        'description',
        'original_price',
        'product_code',
    ];

    public function inventory()
    {
        return $this->hasOne(Inventory::class, 'product_id');
    }

    public function stocktransaction()
    {
        return $this->hasOne(StockTransaction::class, 'product_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    
}
