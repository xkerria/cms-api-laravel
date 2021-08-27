<?php

namespace App\Model;

use App\Model\Ability\Sortable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Sortable;

    protected $sortable = ['name'];
    protected $sortEncoding = 'gbk';

    protected $fillable = [
        'name', 'remark', 'priority'
    ];

    public function posts() {
        return $this->hasMany(Post::class);
    }
}
