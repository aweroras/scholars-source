<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = 'reviews';

    protected $fillable = [
        'review_id',
        'customer_id',
        'product_id',
        'rate',
        'comment',
        'img_path',
    ];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }
}

