<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title', 'category', 'material', 'size', 'color', 'design', 'description', 'price', 'discount_price', 'quantity'];

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
