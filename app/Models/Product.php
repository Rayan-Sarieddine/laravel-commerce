<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name',
        'product_barcode',
        'product_price',
    ];
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    use HasFactory;
}
