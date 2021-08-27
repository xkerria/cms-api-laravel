<?php

namespace App\Http\Controllers;

use App\Model\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller {
    function index(Request $request) {
        if ($request->has('cover')) {
            return Media::where('is_cover', true)->get();
        }
        return Media::all();
    }

    function store(Request $request) {
        $file = $request->file('file');
        $isCover = $request->has('cover');
        $url = Storage::url($file->store('public/media'));
        $media = Media::create([
            'url' => $url,
            'name' => $file->getClientOriginalName(),
            'size' => $file->getSize(),
            'extension' => $file->extension(),
            'mime' => $file->getClientMimeType(),
            'is_cover' => $isCover
        ]);
        return $media;
    }

    function destroy(Media $media) {
        $arr = $media->toArray();
        $path = str_replace('storage', 'public', $media->url);
        Storage::delete($path);
        $media->delete();
        return $media;
    }
}
