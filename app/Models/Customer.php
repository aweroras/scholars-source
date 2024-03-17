<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customer_info';
    protected $fillable = [
        'user_id',
        'name',
        'Address',
        'PhoneNumber',
        'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
