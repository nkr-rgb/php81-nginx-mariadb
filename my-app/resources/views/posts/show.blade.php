@extends('layouts.post')

@section('title', '投稿詳細')

@section('content')
<div class="grid grid-cols-1 gap-4 my-4">
    <div>
        <a href="{{ route('posts.index') }}"
            class="bg-white hover:bg-gray-700 text-gray hover:text-white
            outline outline-1 py-2 px-4 mx-4 rounded cursor-pointer">戻る</a>
    </div>
    <div class="overflow-hidden h-96 w-64 md:w-80 cursor-pointer m-auto shadow-md">
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
                    <i>by: {{ $post->user->name }}</i>
                </p>
            </div>
    </div>
    <div class="grid grid-cols-1">
        @can('update', $post)
        <div class="justify-self-center text-center mb-12">
            <a class="bg-white text-green-600 hover:bg-green-600 hover:text-white
            block h-10 w-36 leading-10 border border-green-600 rounded"
            href="{{ route('post.edit', ['post' => $post]) }}">編集する</a>
        </div>
        <div class="justify-self-center text-center mb-6">
            <form action="{{ route('post.delete', ['post' => $post]) }}" method="POST">
                @csrf
                <button type="submit"
                class="bg-red-500 text-white hover:bg-red-800 block h-10 w-36 leading-10 rounded"
                onclick="return confirmDeletion()">投稿を削除</button>
            </form>
        </div>
        @endcan
    </div>
</div>
<script>
    function confirmDeletion() {
        return confirm('本当にこの投稿を削除しますか？');
    }
</script>
@endsection