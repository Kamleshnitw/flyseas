<?php

namespace App\Models\Admin\Vendor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VendorProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'attribute_id'          => 'array',
        'variation_name'        => 'array',
        'variation_value'       => 'array',
        'combination_name'      => 'array',
        'thumbnail'             => 'array',
        'gallery'               => 'array',
        'tax'                   => 'array',
        'hsn_code'              => 'array',
        'description'           => 'array',
        'purchase_price'        => 'array',
        'selling_price'         => 'array',
        'mrp_price'             => 'array',
        'discount_price'        => 'array',
        'discount_type'         => 'array',
        'sku_code'              => 'array',
        'quantity'              => 'array',
    ];
}
