<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    const CREATED_AT = 'purchased_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = ['user_id', 'product_id_fk', 'payment_method', 'purchased_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id_fk', 'id');
    }
}
