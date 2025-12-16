<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['title', 'subtitle', 'image_route', 'image_description', 'content', 'price'];
    
    /**
     * Obtener el precio del producto en pesos
     */
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
    /**
     * Obtener las compras del producto
     */
    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class, 'product_id_fk', 'id');
    }
}
