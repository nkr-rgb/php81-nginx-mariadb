<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Post extends Model {
    use HasFactory;
    use SoftDeletes; //ソフトデリート

    //データ変更を許可するカラムを指定（他カラムは保護される）
    protected $fillable = [
        'title',
        'body',
    ];

    //1対多のリレーション ポストに紐づくユーザを返す
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //1対多 ポストに紐づく複数の画像を返す
    public function postImages()
    {
        return $this->hasMany(PostImage::class);
    }

    //多対多のリレーション ポストに紐づく複数のタグを返す
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function createPost($data): Post
    {
        $user = Auth::user();

        $post = new Post;
        $post->user_id = $user->id;
        $post->title = $data['title'];
        $post->body = $data['body'];
        $post->save(); //データベースに保存
        return $post;
    }

    public function updatePost($data): Post
    {   
        $post = Post::find($data['id']);

        // $this->authorize('update', $post); //ポリシーの適用

        $post->title = $data['title'];
        $post->body = $data['body'];
        $post->save();
        return $post;
    }

    public function deletePost($id): Post
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return $post;
    }

    // //ファクトリーで作成したデータをデータベース保存(データベースシーダーが実行)
    // public function createPost($data)
    // {
    //     $post = new Post;
    //     $post->title = $data->title;
    //     $post->body = $data->body;
    //     $post->save(); //データベースに保存
    //     return $post;
    // }

    // public function GetPostsWithNormalSql()
    // {
    //     $posts = DB::select('SELECT * FROM posts');
    //     return $posts;
    // }

    // public function createPostWithNormalSql($data)
    // {
    //     $post = DB::insert('INSERT INTO posts (user_id, title, body)
    //     VALUES (?, ?, ?)', [$data->user_id, $data->title, $data->body]);
    //     return $post;
    // }

    // public function updatePostWithNormalSql($data)
    // {
    //     $post = DB::update('UPDATE posts SET title = ?, body = ?, updated_at = ?
    //     WHERE id = ?', [$data->title, $data->body, now(), $data->id]);
    //     return $post;
    // }

    // public function deletePostWithNormalSql($data)
    // {
    //     //$post = DB::table('posts')->where('id', $data->id)->delete();
    //     $post = DB::delete('DELETE FROM posts WHERE id = ?', [$data->id]);
    //     return $post;
    // }

    // //トランザクション処理 複数の処理が全て正常に通った場合のみ、データベース保存される
    // //1は通るが2でuser_id未挿入でエラーのため、1の保存は行われない
    // public function createBulkPostWithNormalSql()
    // {
    //     DB::transaction(function () {
    //         $user_id = "1";
    //         $title = "1トランザクション";
    //         $body = "トランザクションテスト１やで";
            
    //         DB::insert('INSERT INTO posts (user_id, title, body)
    //         VALUES (?, ?, ?)', [$user_id, $title, $body]);
            

    //         $title = "2トランザクション";
    //         $body = "トランザクションテスト２やで";

    //         DB::insert('INSERT INTO posts (title, body)
    //         VALUES (?, ?)', [$title, $body]);
    //     });
    // }

    // //クエリビルダー　追加
    // public function createPostWithQueryBuilder($data)
    // {
    //     $post = DB::table('posts')->insert([
    //         'user_id' => $data->user_id,
    //         'title' => $data->title,
    //         'body' => $data->body,  
    //     ]);
    //     return $post;
    // }

    // //クエリビルダー　表示
    // public function getPostWithQueryBuilder()
    // {
    //     $posts = DB::table('posts')->get();
    //     dd($posts);
    //     return $posts;
    // }

    // //クエリビルダー　更新
    // public function updatePostWithQueryBuilder($data)
    // {
    //     $post = DB::table('posts')->where('id', $data->id)->update([
    //         'title' => $data->title,
    //         'body' => $data->body,
    //         'updated_at' => now()
    //     ]);
    //     return $post;
    // }

    // //クエリビルダー　削除
    // public function deletePostWithQueryBuilder($data)
    // {
    //     $post = DB::table('posts')->where('id', $data->id)->delete();
    //     return $post;
    // }

    // //クエリビルダー　where句
    // public function getPostWithQueryBuilderByFilter()
    // {
    //     // $posts = DB::table('posts')
    //     // ->where('body', 'like', '%内容%')
    //     // ->whereIn('id', [1, 2, 3])
    //     // ->orderBy('id', 'desc')
    //     // ->get();

    //     //ページネーション
    //     $posts = DB::table('posts')->paginate
    //     (5);

    //     return $posts;
    // }

    // //クエリビルダー　count
    // public function getCountPosts()
    // {
    //     $count = DB::table('posts')->count();
    //     return $count;
    // }

    // //クエリビルダー join
    // public function getPostAndUserWithQueryBuilder()
    // {
    //     $posts = DB::table('posts')
    //         ->join('users', 'posts.user_id', '=', 'users.id')
    //         ->select('posts.*', 'users.name')
    //         ->get();
    //     return $posts;
    // }

    // //クエリビルダー サブクエリ
    // public function getPostWithQueryBuilderBySubQuery()
    // {
    //     $posts = DB::table('posts')
    //         ->whereIn('id', function ($query) {
    //             $query->select(DB::raw('MAX(id)'))
    //             ->from('posts')
    //                 ->groupBy('user_id');
    //         })
    //             ->get();
    //         //SQLに置き換えた時中身を見る用
    //         //     ->toSql();
    //         // dd($posts);
    //         return $posts;
    // }

    // //Eloquent select*
    // public function getPostWithEloquent()
    // {
    //     // $posts = Post::all();

    //     //withメソッドを使うことで、内部的にWHERE INを使って関連データを引っ張ってこれる
    //     //ループ処理に連動して毎回SQLを発行するのはパフォーマンスが悪い
    //     //↓で投稿内容とタグを結合した状態で取得できる
    //     $posts = Post::with('tags')->get(); //N+1問題対策 多対多のリレーション
    //     return $posts;
    // }
    
    // //Eloquent id指定
    // public function getPostWithEloquentById($id)
    // {
    //     $post = Post::find($id);
    //     return $post;
    // }

    // //Eloquent ソフトデリートされたデータを取得
    // public function getTrashPostWithEloquent()
    // {
    //     $posts = Post::onlyTrashed()->get(); //ソフトデリートされたデータのみ取得
    //     //$posts = Post::withTrashed()->get(); //ソフデリも含めて全て取得
    //     return $posts;
    // }

    // //Eloquent データ挿入
    // public function createPostWithEloquent($data)
    // {
    //     $post = new Post;
    //     $post->user_id = $data->user_id;
    //     $post->title = $data->title;
    //     $post->body = $data->body;
    //     $post->save();
    //     return $post;
    // }

    // //Eloquent データ更新
    // public function updatePostWithEloquent($data)
    // {
    //     $post = Post::find($data->id);
    //     $post->title = $data->title;
    //     $post->body = $data->body;
    //     $post->save();
    //     return $post;
    // }

    // //Eloquent データ削除
    // public function deletePostWithEloquent(int $id)
    // {
    //     $post = Post::find($id);
    //     $post->delete();
    //     return $post;
    // }
}
