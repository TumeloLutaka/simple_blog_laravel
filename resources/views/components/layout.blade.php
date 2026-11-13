<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title . ' — SimpleBlog.' : 'SimpleBlog.' }}</title>

    <!-- Modular BEM Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('css/post.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

    <!-- Apply saved theme before paint to avoid flash -->
    <script>
        (function () {
            const savedTheme = localStorage.getItem('theme') || 'light';
            if (savedTheme === 'dark') {
                document.documentElement.setAttribute('data-theme', 'dark');
            }
        })();
    </script>
</head>

<body class="page">
    <x-header />

    <main class="page__main">
        @if (session('status'))
            <div class="alert alert--success">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert--danger">
                <ul class="alert__list">
                    @foreach ($errors->all() as $error)
                        <li class="alert__item">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{ $slot }}
    </main>

    <x-footer />

    <script>
        (function () {
            const toggleBtn = document.getElementById('theme-toggle');
            if (!toggleBtn) return;

            function syncButtonLabel() {
                const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
                toggleBtn.textContent = isDark ? 'Light Mode' : 'Dark Mode';
            }

            syncButtonLabel();

            toggleBtn.addEventListener('click', function () {
                const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
                if (isDark) {
                    document.documentElement.removeAttribute('data-theme');
                    localStorage.setItem('theme', 'light');
                } else {
                    document.documentElement.setAttribute('data-theme', 'dark');
                    localStorage.setItem('theme', 'dark');
                }
                syncButtonLabel();
            });
        })();
    </script>
</body>

</html>
