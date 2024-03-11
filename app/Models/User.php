<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Modules\Famous\app\Models\Famous;
use Illuminate\Notifications\Notifiable;
use Modules\Merchant\app\Models\Merchant;
use Modules\Customers\app\Models\Customer;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;


    public static $types = [
        'admin',
        'customer',
        'famous',
        'merchant'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id'
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

    function getNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function merchants()
    {
        return $this->hasMany(Merchant::class);
    }

    public function famous()
    {
        return $this->hasMany(Famous::class);
    }

    public function advertises()
    {
        return $this->belongsToMany('Modules\Advertises\App\Models\Advertise', 'famous_advertises','famous_id','advertise_id')->distinct();
    }
}
