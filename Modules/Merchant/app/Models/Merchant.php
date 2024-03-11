<?php

namespace Modules\Merchant\app\Models;

use App\Models\User;
use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Customers\Database\factories\CustomerFactory;

class Merchant extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'user_id';
    protected $guarded = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
