<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sports extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sport_name',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Sport has many complexes
    public function complexes()
    {
        return $this->hasMany(Complex::class);
    }

    // Sport has many packages through the pivot table `sport_packages`
    public function packages()
    {
        return $this->belongsToMany(Packages::class, 'sport_packages');
    }
}
