<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'city',
        'mobile',
        'password',
        'type',
        'is_approved',
        'longitude',
        'latitude'
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function sports()
    {
        return $this->hasMany(Sports::class);
    }

    public function complexes()
    {
        return $this->hasMany(Complex::class);
    }

    public function packages()
    {
        return $this->hasMany(Packages::class);
    }

    public function getUserId(){
        return Auth::user()->id;
    }
}
