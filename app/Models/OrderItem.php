<?php

namespace App\Models;

use App\Models\Food;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    function order()
    {
        return $this->belongsTo(Order::class);
    }
    function food()
    {
        return $this->belongsTo(Food::class);
    }
}
