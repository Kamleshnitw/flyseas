<?php

namespace App\Models\Admin\Vendor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GroupProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'product_id'    => 'array',
    ];
}
