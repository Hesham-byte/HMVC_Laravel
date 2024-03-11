<?php

namespace Modules\Banners\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Banners\Database\factories\BannerProductFactory;

class BannerProduct extends Model
{
    use HasFactory;

    protected $guarded = [];
}
