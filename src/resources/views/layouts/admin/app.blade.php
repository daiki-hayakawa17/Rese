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
        @if (Auth::check())
            <button id="menuBtn" class="menuBtn">
                <img src="{{ asset('images/menu.png') }}" alt="メニュー画像">
            </button>
            <h1 class="header__title">Rese</h1>
        @else
            <div class="menuBtn">
                <img src="{{ asset('images/menu.png') }}" alt="メニュー画像">
            </div>
            <h1 class="header__title">Rese</h1>
        @endif
    </header>

    <main>
        <div id="menuOverlay" class="overlay hidden">
            <div class="menu-content">
                <button id="closeMenu">
                    <img src="{{ asset('images/close.png') }}" alt="closeボタン">
                </button>
                <div class="menu__links">
                    @csrf
                    <a class="create__form--link" href="/admin/owner/create">Store</a>
                    <a class="mail__form--link" href="/admin/mail">Mail-Form</a>
                    <form class="logout__button" action="/admin/logout" method="POST">
                        @csrf
                        <button class="logout__button--submit">Logout</button>
                    </form>
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