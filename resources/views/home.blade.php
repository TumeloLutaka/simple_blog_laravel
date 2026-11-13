<x-layout title="{{ auth()->check() ? 'Feed' : 'Welcome' }}">
    @auth
        <section class="feed">
            <div class="feed__header">
                <div>
                    <h1 class="feed__title">Community Feed</h1>
                    <p class="feed__subtitle">Browse the latest posts from all authors.</p>
                </div>
                <a href="/profile" class="btn btn--primary">+ New Post</a>
            </div>

            @if ($posts->isEmpty())
                <div class="feed__empty">
                    <p>No posts have been published yet. Head over to your Profile to write the first one!</p>
                </div>
            @else
                <div class="feed__list">
                    @foreach ($posts as $post)
                        <article class="post-card">
                            <div class="post-card__header">
                                <h2 class="post-card__title">
                                    <a href="/posts/{{ $post->id }}" class="post-card__title-link">
                                        {{ $post->title }}
                                    </a>
                                </h2>
                                <div class="post-card__meta">
                                    <span>By <strong class="post-card__author">{{ $post->user->name }}</strong></span>
                                    <span>&bull;</span>
                                    <span class="post-card__date">{{ $post->created_at->format('M j, Y') }}</span>
                                </div>
                            </div>

                            <p class="post-card__excerpt">{{ \Illuminate\Support\Str::limit($post->body, 220) }}</p>

                            <div class="post-card__footer">
                                <a href="/posts/{{ $post->id }}" class="post-card__read-more">
                                    Read full post &rarr;
                                </a>

                                @if (auth()->id() === $post->user_id)
                                    <div class="post-card__actions">
                                        <a href="/edit-post/{{ $post->id }}" class="btn btn--secondary btn--sm">Edit</a>
                                        <form action="/delete-post/{{ $post->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn--danger btn--sm">Delete</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </section>
    @else
        @php
            $showRegister = $errors->has('name') || $errors->has('email') || $errors->has('password');
        @endphp

        <section class="auth">
            <div class="auth__card">
                <div class="auth__tabs">
                    <button
                        type="button"
                        id="tab-login"
                        class="auth__tab {{ !$showRegister ? 'auth__tab--active' : '' }}"
                    >
                        Log In
                    </button>
                    <button
                        type="button"
                        id="tab-register"
                        class="auth__tab {{ $showRegister ? 'auth__tab--active' : '' }}"
                    >
                        Register
                    </button>
                </div>

                <!-- Login Panel -->
                <div id="panel-login" class="auth__panel {{ $showRegister ? 'auth__panel--hidden' : '' }}">
                    <div class="auth__header">
                        <h1 class="auth__title">Welcome back</h1>
                        <p class="auth__subtitle">Log in with your username and password.</p>
                    </div>

                    <form action="/login" method="POST" class="form">
                        @csrf
                        <div class="form__group">
                            <label for="login_name" class="form__label">Username</label>
                            <input
                                id="login_name"
                                name="login_name"
                                type="text"
                                value="{{ old('login_name') }}"
                                placeholder="Enter your username"
                                class="form__input"
                                required
                            >
                        </div>

                        <div class="form__group">
                            <label for="login_password" class="form__label">Password</label>
                            <input
                                id="login_password"
                                name="login_password"
                                type="password"
                                placeholder="Enter your password"
                                class="form__input"
                                required
                            >
                        </div>

                        <button type="submit" class="btn btn--primary btn--block">Log In</button>
                    </form>

                    <p class="auth__switch">
                        Don't have an account?
                        <button type="button" id="switch-to-register" class="auth__switch-btn">Register</button>
                    </p>
                </div>

                <!-- Register Panel -->
                <div id="panel-register" class="auth__panel {{ !$showRegister ? 'auth__panel--hidden' : '' }}">
                    <div class="auth__header">
                        <h1 class="auth__title">Create an account</h1>
                        <p class="auth__subtitle">Sign up to publish and manage blog posts.</p>
                    </div>

                    <form action="/register" method="POST" class="form">
                        @csrf
                        <div class="form__group">
                            <label for="name" class="form__label">Username</label>
                            <input
                                id="name"
                                name="name"
                                type="text"
                                value="{{ old('name') }}"
                                placeholder="4 to 15 characters"
                                class="form__input"
                                required
                            >
                        </div>

                        <div class="form__group">
                            <label for="email" class="form__label">Email</label>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                placeholder="you@example.com"
                                class="form__input"
                                required
                            >
                        </div>

                        <div class="form__group">
                            <label for="password" class="form__label">Password</label>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                placeholder="At least 8 characters"
                                class="form__input"
                                required
                            >
                        </div>

                        <button type="submit" class="btn btn--primary btn--block">Register</button>
                    </form>

                    <p class="auth__switch">
                        Already have an account?
                        <button type="button" id="switch-to-login" class="auth__switch-btn">Log In</button>
                    </p>
                </div>
            </div>
        </section>

        <script>
            (function () {
                const tabLogin = document.getElementById('tab-login');
                const tabRegister = document.getElementById('tab-register');
                const panelLogin = document.getElementById('panel-login');
                const panelRegister = document.getElementById('panel-register');
                const switchToRegister = document.getElementById('switch-to-register');
                const switchToLogin = document.getElementById('switch-to-login');

                function showMode(mode) {
                    const isLogin = mode === 'login';
                    tabLogin.classList.toggle('auth__tab--active', isLogin);
                    tabRegister.classList.toggle('auth__tab--active', !isLogin);
                    panelLogin.classList.toggle('auth__panel--hidden', !isLogin);
                    panelRegister.classList.toggle('auth__panel--hidden', isLogin);
                }

                tabLogin.addEventListener('click', function () { showMode('login'); });
                tabRegister.addEventListener('click', function () { showMode('register'); });
                switchToRegister.addEventListener('click', function () { showMode('register'); });
                switchToLogin.addEventListener('click', function () { showMode('login'); });
            })();
        </script>
    @endauth
</x-layout>
