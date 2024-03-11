<?php

namespace Modules\Advertises\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Advertises\Database\factories\AdvertiseFactory;

class Advertise extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];


    public function famous()
    {
        return $this->belongsToMany('App\Models\User', 'famous_advertises','advertise_id','famous_id')->distinct();
    }

}
