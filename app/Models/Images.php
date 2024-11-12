<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;

    protected $fillable = ['url','imageable_type','imageable_id'];

    public function imageable()
    {
        return $this->morphTo();
    }

    #storing method 
    
    // $user->images()->create([
    //     'url' => 'path/to/user_profile.jpg',
    //     'alt_text' => 'User Profile Picture'
    // ]);
}
