<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostImage;

class PostImageController extends Controller {
    public function store(Request $request, int $postId)
    {
        $request->validate([
            'images.*' => 'required|file|image|mimes:jpeg,png,jpg,gif',
        ]);

        $post = Post::findOrFail($postId);

        $postImage = new PostImage();
        //編集の場合はリクエストにもidがあるので、idチェック後に編集前の画像を削除
        if ($request->id && $request->id == $postId) {
            $postImage->deleteImage($postId);
        }

        $images = $request->file('images');
        foreach ($images as $image) {
            $postImage->saveImage($image, $postId);
        }

        return redirect()->route('posts.index');
    }
}
