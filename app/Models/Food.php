<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    function categories()
    {
        return $this->belongsToMany(Category::class);
    }


    function variations()
    {
        return $this->hasMany(Variation::class);
    }
}
