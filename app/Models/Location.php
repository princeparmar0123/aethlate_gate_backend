<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'owner_name',
        'user_id',
        'address',
        'gst_certificate',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Location has many complexes through the pivot table `location_complexes`
    public function complexes()
    {
        return $this->belongsToMany(Complex::class, 'location_complexes');
    }
}
