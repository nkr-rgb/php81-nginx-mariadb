@extends('layouts.post')

@section('title', '投稿編集')

@section('content')
<div class="grid grid-cols-1 gap-4 my-4">
    <div>
        <a href="{{ route('post.show', ['post' => $post]) }}"
            class="bg-white hover:bg-gray-700 text-gray hover:text-white
            outline outline-1 py-2 px-4 mx-4 rounded cursor-pointer">戻る</a>
    </div>
    <h1 class="text-center font-bold">投稿の編集</h1>
    <form action="{{ route('post.update') }}" method="POST" enctype="multipart/form-data"
    class="bg-white shadow-md rounded px-6 pb-8 mb-4">
        @csrf
        <input type="hidden" name="id" value="{{ $post->id }}">
        <input type="file" name="images[]" id="images" multiple>
        @if ($post->postImages->count() > 0)
            @foreach ($post->postImages as $image)
            <img src="{{ asset($image->url) }}" alt="{{ $post->title }}" width="100">
            @endforeach
        @endif
        <div class="mb-4">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">
                タイトル
            </label>
            <input type="text" name="title" id="title" value="{{ $post->title }}"
            class="shadow appearance-none border rounded w-full py-2 px-3
            text-gray-700 leading-tight focus:outline-none focus:ring-2">
        </div>
        <div class="mb-6">
            <label for="body" class="block text-gray-700 text-sm font-bold mb-2">
                内容
            </label>
            <textarea name="body" id="body"
            class="shadow appearance-none border rounded w-full py-2 px-3
            text-gray-700 leading-tight focus:outline-none focus:ring-2"
            >{{ $post->body }}</textarea>
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2">
            更新
        </button>
    </form>
</div>
@endsection