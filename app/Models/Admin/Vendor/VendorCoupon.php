<?php

namespace App\Models\Admin\Vendor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VendorCoupon extends Model
{
    use HasFactory, SoftDeletes;
}
