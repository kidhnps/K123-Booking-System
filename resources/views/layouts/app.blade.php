<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K123 訂房系統</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/dark.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <div class="layout-container">
            <nav>
                <a href="{{ route('home') }}" class="logo">K123 訂房</a>
                <div class="nav-links">
                    @auth
                        @can('admin')
                            <a href="{{ route('admin.dashboard') }}">管理後台</a>
                            <a href="{{ route('admin.users') }}">會員管理</a>
                            <a href="{{ route('admin.status') }}">房況</a>
                            <a href="{{ route('admin.settings') }}">系統設定</a>
                        @endcan
                        <a href="{{ route('dashboard') }}">我的訂房</a>
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger" style="padding: 5px 15px; font-size: 0.9rem;">登出</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}">登入</a>
                        <a href="{{ route('register') }}" class="btn">註冊</a>
                    @endauth
                </div>
            </nav>
        </div>
    </header>

    <main class="layout-container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        
        @yield('content')
    </main>

    <footer style="text-align: center; padding: 20px; color: var(--text-muted); margin-top: auto;">
        <p style="margin-bottom: 5px;">
            <a href="https://yes.k123.tw" target="_blank" style="color: var(--primary);">Yauger 練習</a>
        </p>
        &copy; {{ date('Y') }} K123 Hotel. All rights reserved.
    </footer>
</body>
</html>
