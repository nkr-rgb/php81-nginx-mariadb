<!DOCTYPE html>
<html>

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    {{-- Flowbite --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header class="bg-blue-500 p-4">
        <nav class="container mx-auto flex items-center justify-between">
            <a href="{{route('posts.index')}}" class="text-white text-lg font-bold">
                <h1>インスタグラム風アプリ</h1>
            </a>
            <div class="flex items-center space-x-4">
                @auth
                <span class="text-white">{{ Auth::user()->name }}</span>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="text-white">ログアウト</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @else
                <a href="{{ route('login') }}" class="text-white">ログイン</a>
                <a href="{{ route('register') }}" class="text-white">新規登録</a>
                @endauth
            </div>
        </nav>
    </header>
    <div class="content">
        @yield('content')
    </div>
    <footer style="background-color: #1b72c9" class="text-center py-2">
        <p>©︎ 2023 インスタグラム風アプリ</p>
    </footer>
</body>
<script>
    (function() {
        const swiper = new Swiper('.swiper', {
            direction: 'horizontal',
            loop: true,

            pagination: {
                el: '.swiper-pagination',
            },

            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            scrollbar: {
                el: '.swiper-scrollbar',
            },
        });
    })();
</script>
</html>