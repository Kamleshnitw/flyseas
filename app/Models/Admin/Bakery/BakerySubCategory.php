<?php

namespace App\Models\Admin\Bakery;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BakerySubCategory extends Model
{
    use HasFactory, SoftDeletes;

    public function bakeryCategory(){
        return $this->belongsTo(BakeryCategory::class, 'categorie_id','id')->withTrashed();
    }
}
