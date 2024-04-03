<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    function branches()
    {
        return $this->belongsToMany(Branch::class);
    }


    function foods()
    {
        return $this->belongsToMany(Food::class);
    }

    function campaigns()
    {
        return $this->morphToMany(Campaign::class, 'campaignable');
    }
}
