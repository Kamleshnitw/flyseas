<?php

namespace App\Models\Admin\Bakery;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BakeryProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'variation_data'        => 'array',
        'variation_options'     => 'array',
    ];

    public function bakeryVariation(){
        return $this->belongsTo(BakeryVariation::class, 'variant_id','id')->withTrashed();
    }
}
