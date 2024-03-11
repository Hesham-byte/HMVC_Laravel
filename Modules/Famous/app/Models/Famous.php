<?php

namespace Modules\Famous\app\Models;

use App\Models\User;
use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Famous\Database\factories\FamousFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Famous extends Model
{
    use HasFactory, SoftDeletes;

    
    protected $guarded = ['user_id'];
    protected $table = 'famous';
    protected $primaryKey = 'user_id';
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
