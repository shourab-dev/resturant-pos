<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;


    public function categories()
    {
        return $this->morphedByMany(Category::class, 'campaignable');
    }
    public function foods()
    {
        return $this->morphedByMany(Food::class, 'campaignable');
    }
}
