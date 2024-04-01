<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\Product;

class Cart extends Model
{
    use HasFactory;
    
    public function product()
{
    return $this->belongsTo(Product::class);
}

public function customer()
{
    return $this->belongsTo(Customer::class);
}
    
}


