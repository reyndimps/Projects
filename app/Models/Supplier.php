<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'company', 
        'name', 
        'email',
        'phone',
        'address',
        'industry_type',
        'country',
        'status',
    ];
    
    public function supplier()
{
    return $this->belongsTo(Supplier::class);
}

}
