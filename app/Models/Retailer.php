<?php

namespace App\Models;

use App\Models\Admin\City;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Bakery\BakeryCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Retailer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'city_id',
        'category_id',
        'kyc_status'
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function City(){
        return $this->belongsTo(City::class);
    }

    public function Category()
    {
        return $this->belongsTo(BakeryCategory::class);
    }

    public function retailerKyc()
    {
        return $this->belongsTo(RetailerKyc::class, 'user_id', 'user_id');
    }

    public function address()
    {
        return $this->hasMany(RetailerAddress::class, 'user_id', 'user_id');
    }

    public function walletHistory()
    {
        return $this->hasMany(RetailerWalletHistory::class, 'user_id', 'user_id');
    }
}
