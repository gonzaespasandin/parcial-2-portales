<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $fillable = ['title', 'content', 'image', 'image_description'];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_fk_id', 'category_id');
    }
}
