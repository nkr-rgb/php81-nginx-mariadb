@extends('layouts.app')

@section('title', '投稿一覧')

@section('content')
<x-alert type="warning">
    これは警告メッセージです。
</x-alert>
<h1 class="text-center">index2のタイトルです</h1>
@foreach($posts as $post)
<div>
    <h2>タイトル名:{{ $post->title }}</h2>
    <p>本文:{{ $post->body }}</p>
    <button class="bg-blue-900 text-white px-2 py-2 rounded">
        投稿する
    </button>
</div>
@endforeach
@endsection