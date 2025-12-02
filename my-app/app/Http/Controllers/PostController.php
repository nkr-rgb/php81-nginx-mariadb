<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller {
    /**
     * Display a listing of the resource.
     */

    // public function indexRedirect()
    // {
    //     return redirect()->route('posts.index_route');
    // }

    public function index()
    {
        $posts = Post::all();
        return view('posts.index', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(CreatePostRequest $request)
    {
        // 入力データのバリデーション
        // $request->validate([
        //     'title' => 'required|string|max:255',
        //     'body' => 'required',
        // ]);

        $post = new Post();
        $result = $post->createPost($request->all());

        //postImagesテーブルに画像を保存
        if ($request->hasFile('images')) {
            $postImageController = new PostImageController();
            $postImageController->store($request, $result->id);
        }
        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    public function edit(Post $post) //(int $id)
    {
        $this->authorize('update', $post); //ポリシーの適用
        
        //$post = Post::findOrFail($id);
        return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request)
    {
        // 入力データのバリデーション
        $request->validate([
            'id' => 'required|integer',
            'title' => 'required|string|max:255',
            'body' => 'required',
        ]);

        $postId = $request->input('id');
        // データの存在有無を確認
        $postId = 999;
        try {
            Post::findOrFail($postId);   
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            throw new ModelNotFoundException("Post not found");
        }

        $post = new Post();
        $result = $post->updatePost($request->all());

        //postImagesテーブルに画像を保存
        if ($request->hasFile('images')) {
            $postImageController = new PostImageController();
            $postImageController->store($request, $result->id);
        }
        return redirect()->route('posts.index');
    }

    public function destroy(int $id)
    {
        $post = new Post();
        $result = $post->deletePost($id);
        return redirect()->route('posts.index')->with('success', '投稿を削除しました');
    }

    // public function index2()
    // {
    //     $posts = [
    //       (object)['title' => '最初の投稿', 'body' => 'これは最初の投稿の本文です。'],
    //       (object)['title' => '二番目の投稿', 'body' => 'これは二番目の投稿の本文です。'],
    //       (object)['title' => '三番目の投稿', 'body' => 'これは三番目の投稿の本文です。']
    //     ];
    //     return view('posts.index2', ['posts' => $posts]);
    // }

    // public function indexNormalSql()
    // {
    //     $post = new Post();
    //     $posts = $post->GetPostsWithNormalSql();
    //     return $posts;
    // }

    // public function createPostWithNormalSql()
    // {
    //     $dummyData = (object)[
    //         'user_id' => 1,
    //         'title' => '素のSQLで新しい投稿',
    //         'body' => '素のSQLでの新しい投稿の内容です。'
    //     ];
    //     $post = new Post();
    //     $post->createPostWithNormalSql($dummyData);
    // }

    // public function updatePostWithNormalSql()
    // {
    //     $dummyData = (object)[
    //         'id' => 19,
    //         'title' => '更新された投稿',
    //         'body' => '更新された投稿の内容です。'
    //     ];
    //     $post = new Post();
    //     $post->updatePostWithNormalSql($dummyData);
    // }

    // public function deletePostWithNormalSql()
    // {
    //     $dummyData = (object)[
    //         'id' => 19,
    //     ];
    //     $post = new Post();
    //     $post->deletePostWithNormalSql($dummyData);
    // }

    // #トランザクション処理
    // public function createBulkPostWithNormalSql()
    // {
    //     $post = new Post();
    //     $post->createBulkPostWithNormalSql();
    // }
    
    // #クエリビルダー insert
    // public function createPostWithQueryBuilder()
    // {
    //     $dummyData = (object)[
    //         'user_id' => 1,
    //         'title' => 'クエリビルダーで新しい投稿',
    //         'body' => 'クエリビルダーでの新しい投稿の内容です。'
    //     ];
    //     $post = new Post();
    //     $post->createPostWithQueryBuilder($dummyData);
    // }

    // #クエリビルダー get
    // public function getPostWithQueryBuilder()
    // {
    //     $post = new Post();
    //     $posts = $post->getPostWithQueryBuilder();
    //     return $posts;
    // }

    // #クエリビルダー update
    // public function updatePostWithQueryBuilder()
    // {
    //     $dummyData = (object)[
    //         'id' => 11,
    //         'title' => '更新された投稿',
    //         'body' => '更新された投稿の内容です。'
    //     ];
    //     $post = new Post();
    //     $post->updatePostWithQueryBuilder($dummyData);
    // }

    // #クエリビルダー delete
    // public function deletePostWithQueryBuilder()
    // {
    //     $dummyData = (object)[
    //         'id' => 11,
    //     ];
    //     $post = new Post();
    //     $post->deletePostWithQueryBuilder($dummyData);
    // }

    // #クエリビルダー　where句
    // public function getPostWithQueryBuilderByFilter()
    // {
    //     $post = new Post();
    //     $posts = $post->getPostWithQueryBuilderByFilter();
    //     return $posts;
    // }

    // #クエリビルダー　　count
    // public function getCountPosts()
    // {
    //     $post = new Post();
    //     $count = $post->getCountPosts();
    //     return $count;
    // }

    // #クエリビルダー join
    // public function getPostAndUserWithQueryBuilder()
    // {
    //     $post = new Post();
    //     $posts = $post->getPostAndUserWithQueryBuilder();
    //     return $posts;
    // }

    // #クエリビルダー サブクエリ
    // public function getPostWithQueryBuilderBySubQuery()
    // {
    //     $post = new Post();
    //     $posts = $post->getPostWithQueryBuilderBySubQuery();
    //     return $posts;
    // }

    // #Eloquent select*
    // public function getPostWithEloquent()
    // {
    //     $post = new Post();
    //     $posts = $post->getPostWithEloquent();
    //     return $posts;
    // }

    // #Eloquent id指定
    // public function getPostWithEloquentById($id)
    // {
    //     $post = new Post();
    //     $posts = $post->getPostWithEloquentById($id);
    //     return $posts;
    // }

    // #Eloquent ソフトデリート
    // public function getPostWithEloquentTrashed()
    // {
    //     $post = new Post();
    //     $posts = $post->getTrashPostWithEloquent();
    //     return $posts;
    // }

    // #Eloquent データ挿入
    // public function createPostWithEloquent()
    // {
    //     $dummyData = (object)[
    //         'user_id' => 1,
    //         'title' => 'Eloquentで新しい投稿',
    //         'body' => 'Eloquentの新しい投稿の内容です。'
    //     ];

    //     $post = new Post();
    //     $posts = $post->createPostWithEloquent($dummyData);
    //     return $posts;
    // }

    // #Eloquent データ更新
    // public function updatePostWithEloquent()
    // {
    //     $dummyData = (object)[
    //         'id' => 18,
    //         'title' => 'Eloquentで更新された投稿',
    //         'body' => 'Eloquentで更新された投稿の内容'
    //     ];

    //     $post = new Post();
    //     $post->updatePostWithEloquent($dummyData);
    // }

    // #Eloquent データ削除
    // public function deletePostWithEloquent($id)
    // {
    //     $post = new Post();
    //     $post->deletePostWithEloquent($id);
    // }
}
