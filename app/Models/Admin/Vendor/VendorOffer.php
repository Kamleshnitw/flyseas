<?php

namespace App\Models\Admin\Vendor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VendorOffer extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'category_id'   => 'array',
        'product_id'    => 'array',
    ];
}
