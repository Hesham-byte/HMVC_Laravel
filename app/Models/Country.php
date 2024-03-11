<?php

namespace App\Models;

use App\Models\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory, HasLanguage;

    protected $guarded = [];
}
