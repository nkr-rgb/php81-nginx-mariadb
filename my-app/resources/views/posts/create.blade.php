@extends('layouts.post')

@section('title', '新規投稿')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@section('content')
<div class="grid grid-cols-1 gap-4 my-4">
    <h1 class="text-center font-bold">新規投稿</h1>
    <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data"
    class="bg-white shadow-md rounded px-6 pb-8 mb-4">
        @csrf
        <div class="my-6">
            <label for="images">画像</label>
            <input type="file" name="images[]" id="images" multiple>
        </div>
        <div class="mb-4">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">
                タイトル<span class="text-red-400">※</span>
            </label>
            @if ($errors->first('title'))
                <div class="text-red-800">{{ $errors->first('title') }}</div>
            @endif
            <input type="text" name="title" id="title" value="{{ old('title') }}"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2">
        </div>
        <div class="mb-6">
            <label for="body" class="block text-gray-700 text-sm font-bold mb-2">
                内容<span class="text-red-400">※</span>
            </label>
            @if ($errors->first('body'))
                <div class="text-red-800">{{ $errors->first('body') }}</div>
            @endif
            <textarea name="body" id="body"
            class="shadow appearance-none border rounded w-full py-2 px-3
            text-gray-700 leading-tight focus:outline-none focus:ring-2"
            >{{ old('body') }}</textarea>
        </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2">
                投稿
            </button>
    </form>
</div>
@endsection