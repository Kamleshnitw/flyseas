<?php

namespace App\Models\Admin\Bakery;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BakeryVariation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',    
        'value'
    ];

    public function productCategory() {
        return $this->belongsTo('App\Models\Admin\Bakery\BakeryCategory', 'category_id')->withTrashed();
    }
}
