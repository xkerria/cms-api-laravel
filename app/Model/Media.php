<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Media extends Model {
    protected $table = 'media';

    protected $fillable = ['url', 'name', 'extension', 'mime', 'size', 'is_cover'];

    public function post() {
        return $this->belongsTo(Post::class);
    }
}
