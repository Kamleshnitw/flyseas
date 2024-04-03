<?php

namespace App\Models;

use App\Models\Admin\UserDetails;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'user_type',
        'email',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userDetails(){
        return $this->belongsTo(UserDetails::class, 'id', 'user_id');
    }

    public function retailerUserDetails(){
        return $this->belongsTo(Retailer::class, 'id', 'user_id');
    }

    public function retailerUserKyc()
    {
        return $this->belongsTo(RetailerKyc::class, 'id', 'user_id');
    }

    public function retailerBankDetail()
    {
        return $this->belongsTo(RetailerBankDetail::class, 'id', 'user_id');
    }
}
