<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complex extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'complex_name',
        'user_id',
        'sport_id',
        'start_time',
        'end_time',
        'latitude',
        'longitude',
        'description',
    ];

    public function images()
    {
        return $this->morphMany(Images::class, 'imageable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Complex belongs to a sport
    public function sport()
    {
        return $this->belongsTo(Sports::class);
    }

    // Complex belongs to many locations through the pivot table `location_complexes`
    public function locations()
    {
        return $this->belongsToMany(Location::class, 'location_complexes');
    }
}
