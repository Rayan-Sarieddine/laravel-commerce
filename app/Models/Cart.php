<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

public function user()
{
    return $this->belongsTo(User::class);
}
public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function orderHistory()
    {
        return $this->belongsTo(OrderHistory::class);
    }

    use HasFactory;
}
