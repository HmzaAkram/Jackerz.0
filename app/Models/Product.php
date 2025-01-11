<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title', 'category', 'material', 'size', 'color', 'design_type', 'price', 'discount_price', 'quantity','image','image1','image2','image3'];
}
