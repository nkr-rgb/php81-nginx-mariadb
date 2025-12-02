<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostImage extends Model {
    use HasFactory;

    //変更を許可するカラム
    protected $fillable = ['post_id', 'url'];

    //1対多のリレーション（"多"側） belongsは所属するという意味
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function saveImage($image, int $postId): PostImage
    {   
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);

        $postImage = new PostImage;
        $postImage->post_id = $postId;
        $postImage->url = 'images/' . $imageName;
        $postImage->save();
        return $postImage;
    }
    
    public function deleteImage(int $postId)
    {
        $images = PostImage::where('post_id', $postId)->get();
        foreach ($images as $image) {
            //物理ファイル削除
            $path = public_path($image->url);
            if (file_exists($path)) {
                unlink($path);
            }
            //レコード削除
            $image->delete();
        }
    }
}
