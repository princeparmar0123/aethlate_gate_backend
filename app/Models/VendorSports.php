<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorSports extends Model
{
    use HasFactory;

    protected $fillable = [
        'sport_id',
        'user_id',
    ];
}
