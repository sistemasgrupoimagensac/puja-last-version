<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'slug', 'image', 'is_published'];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($post) {
            if ($post->isDirty('title')) {
                $post->slug = Str::slug($post->title);  // Genera el slug automáticamente
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}