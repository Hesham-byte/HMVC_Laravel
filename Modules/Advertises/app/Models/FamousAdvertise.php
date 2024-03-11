<?php

namespace Modules\Advertises\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Advertises\Database\factories\FamousAdvertiseFactory;

class FamousAdvertise extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];
}
