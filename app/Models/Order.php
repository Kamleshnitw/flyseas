<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $casts = [
        'order_history' => 'array',
    ];

    public function address()
    {
        return $this->belongsTo(RetailerAddress::class,'address_id');
    }
}
