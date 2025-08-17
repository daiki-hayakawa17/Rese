<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>
<body>
    <header class="header">
        <button id="menuBtn" class="menuBtn">
            <img src="{{ asset('images/menu.png') }}" alt="メニュー画像">
        </button>
        <h1 class="header__title">Rese</h1>
    </header>

    <main>
        <div id="menuOverlay" class="overlay hidden">
            <div class="menu-content">
                <button id="closeMenu">
                    <img src="{{ asset('images/close.png') }}" alt="closeボタン">
                </button>
                <div class="menu__links">
                    <a href="/">Home</a>
                    @if (Auth::check())
                        <form class="logout__button" action="/logout" method="POST">
                            @csrf
                            <button class="logout__button--submit">Logout</button>
                        </form>
                        <a href="/mypage">Mypage</a>
                    @else
                        <a href="/register">Registration</a>
                        <a href="/login">Login</a>
                    @endif
                </div>
            </div>
        </div>
        @yield('content')
    </main>
    
    <script>
        document.getElementById('menuBtn').addEventListener('click', function () {
            document.getElementById('menuOverlay').classList.remove('hidden');
        });

        document.getElementById('closeMenu').addEventListener('click', function () {
            document.getElementById('menuOverlay').classList.add('hidden');
        });

        document.getElementById('menuOverlay').addEventListener('click', function (e) {
            if (e.target === this) {
                this.classList.add('hidden');
            }
        });
    </script>
    @yield('script')
</body>
</html>