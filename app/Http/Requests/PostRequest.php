<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        $rules = [
            'category' => 'required|max:255',
            'title' => 'required|max:255',
            'order' => 'required|integer|gte:0|lte:99999',
            'sections' => 'required|array',
            'authors' => 'nullable|array',
            'meta' => 'nullable|array',
            'banners' => 'nullable|array',
            'images' => 'nullable|array',
        ];
        return $rules;
    }
}
