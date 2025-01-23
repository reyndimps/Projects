<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;


class Inventory extends Model
{
    protected $table = 'inventory';
    
    protected $fillable = [
        'product_id',
       'expiration_date',
       'date_added',
       'price',
       'quantity',
    ];

    protected $casts = [
        'date_added' => 'datetime',
        'expiration_date' => 'datetime',
    ];
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    
    
}   
