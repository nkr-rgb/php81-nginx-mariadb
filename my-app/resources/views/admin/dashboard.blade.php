@extends('layouts.post')

@section('title', '管理者ダッシュボード')

@section('content')
<div>
    <h1>管理者ダッシュボード</h1>
    <div>
        <a href="{{ route('admin.logout') }}">ログアウト</a>
    </div>
</div>
@endsection