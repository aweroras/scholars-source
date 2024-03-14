<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'status',
        'payment_method',
        'courier',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
