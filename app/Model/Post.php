<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model {
    protected $fillable = [
        'category_id', 'title', 'authors', 'meta', 'sections', 'banners', 'images', 'order'
    ];

    protected $casts = [
        'authors' => 'json',
        'meta' => 'json',
        'sections' => 'json',
        'banners' => 'json',
        'images' => 'json',
    ];

    protected $with = ['category'];

    public static function booted() {
        static::creating(function ($order) {
            $order->created_by = Auth::id();
        });
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function media() {
        return $this->hasMany(Media::class);
    }
}
