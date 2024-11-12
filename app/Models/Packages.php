<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'package_name',
        'user_id',
        'price',
        'validity',
        'description',
        'attribute',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Package belongs to many sports through the pivot table `sport_packages`
    public function sports()
    {
        return $this->belongsToMany(Sports::class, 'sport_packages');
    }
}
