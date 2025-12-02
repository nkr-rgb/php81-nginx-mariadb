@extends('layouts.post')

@section('title', '投稿一覧')

@section('content')

@if (session('success'))
<div id="alert-border-2" class="flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800" role="alert">
    <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
      <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
    </svg>
    <div class="ms-3 text-sm font-medium">
      {{ session('success') }}
    </div>
    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"  data-dismiss-target="#alert-border-2" aria-label="Close">
      <span class="sr-only">Dismiss</span>
      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
      </svg>
    </button>
</div>
@endif

<div class="grid grid-cols-1 gap-4 my-4">
    <div>
        <a href="/post/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full cursor-pointer">
            新規投稿
        </a>
    </div>
    @foreach($posts as $post)
    <div class="overflow-hidden h-96 w-64 md:w-80 cursor-pointer m-auto shadow-md">
        <a href="{{ route('post.show',['post' => $post]) }}" class="w-full block h-full">
            @if ($post->postImages->count() > 0)
            <div class="swiper">
                <div class="swiper-wrapper">
                    @foreach ($post->postImages as $image)
                    <div class="swiper-slide">
                        <img src="{{ asset($image->url) }}" alt="{{ $post->title }}" class="max-h-40 w-full">
                    </div>
                    @endforeach
                </div>

                <div class="swiper-pagination"></div>

                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
            @else
                <img alt="blog photo" src="https://picsum.photos/200" class="max-h-40 w-full">
            @endif
            <div class="bg-white dark:bg-gray-800 h-56 w-full p-4">
                <p class="text-gray-800 dark:text-white text-xl font-medium mb-2">
                    {{ $post->title }}
                </p>
                <p class="text-gray-600 dark:text-gray-300 text-md font-light">
                    {{ $post->body }}
                </p>
                <p class="text-gray-300 text-right">
                    by: <i>{{ $post->user->name }}</i>
                </p>
            </div>
        </a>
    </div>
    @endforeach
</div>
@endsection