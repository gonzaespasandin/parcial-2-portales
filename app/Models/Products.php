<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    protected $fillable = ['title', 'subtitle', 'imageRoute', 'imageDescription', 'content', 'price'];
    public function price (): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return $value / 100; 
            },
            set: function ($value) {
                return $value * 100;
            },
        );
    }
}
