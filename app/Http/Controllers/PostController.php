<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Model\Category;
use App\Model\Post;
use Illuminate\Http\Request;

class PostController extends Controller {
    public function index(Request $req, Category $category) {
        if ($category->id)
            return $category->posts;
        return Post::with('category')->orderBy('order')->orderByRaw('convert(`order` using gbk) asc')->get();
    }

    public function show(Post $post) {
        return $post;
    }

    public function store(PostRequest $request) {
        $data = $request->validated();
        $category = Category::firstOrCreate(['name' => $data['category']]);
        $data['category_id'] = $category->id;
        return Post::create($data);
    }

    public function update(PostRequest $request, Post $post) {
        $data = $request->validated();
        $category = Category::firstOrCreate(['name' => $data['category']]);
        $data['category_id'] = $category->id;
        $post->fill($data)->save();
        return $post;
    }

    public function destroy(Post $post) {
        $post->delete();
        return $post;
    }
}
