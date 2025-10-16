<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = [
          (object)['title' => '最初の投稿', 'body' => 'これは最初の投稿の本文です。'],
          (object)['title' => '二番目の投稿', 'body' => 'これは二番目の投稿の本文です。'],
          (object)['title' => '三番目の投稿', 'body' => 'これは三番目の投稿の本文です。']
        ];
        return view('posts.index', ['posts' => $posts]);
    }

    public function index2()
    {
        $posts = [
          (object)['title' => '最初の投稿', 'body' => 'これは最初の投稿の本文です。'],
          (object)['title' => '二番目の投稿', 'body' => 'これは二番目の投稿の本文です。'],
          (object)['title' => '三番目の投稿', 'body' => 'これは三番目の投稿の本文です。']
        ];
        return view('posts.index2', ['posts' => $posts]);
    }

    public function indexNormalSql()
    {
        $post = new Post();
        $posts = $post->GetPostsWithNormalSql();
        return $posts;
    }

    public function createPostWithNormalSql()
    {
        $dummyData = (object)[
            'user_id' => 1,
            'title' => '素のSQLで新しい投稿',
            'body' => '素のSQLでの新しい投稿の内容です。'
        ];
        $post = new Post();
        $post->createPostWithNormalSql($dummyData);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
