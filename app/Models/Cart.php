<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Vendor\VendorProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    public function product(){
        return $this->belongsTo(VendorProduct::class, 'product_id');
    }
}
