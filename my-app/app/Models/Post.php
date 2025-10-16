<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model {
    use HasFactory;

    //ファクトリーで作成したデータをデータベース保存(データベースシーダーが実行)
    public function createPost($data)
    {
        $post = new Post;
        $post->title = $data->title;
        $post->content = $data->content;
        $post->save(); //データベースに保存
        return $post;
    }

    public function GetPostsWithNormalSql()
    {
        $posts = DB::select('SELECT * FROM posts');
        return $posts;
    }

    public function createPostWithNormalSql($data)
    {
        $post = DB::insert('INSERT INTO posts (user_id, title, body)
        VALUES (?, ?, ?)', [$data->user_id, $data->title, $data->body]);
        return $post;
    }

    public function updatePostWithNormalSql($data)
    {
        $post = DB::update('UPDATE posts SET title = ?, body = ? WHERE id = ?',
        [$data->title, $data->body, $data->id]);
    }
}
