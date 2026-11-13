<header class="header">
    <div class="header__container">
        <a href="/" class="header__logo">
            SimpleBlog<span class="header__logo-dot">.</span>
        </a>

        @auth
            <nav class="header__nav">
                <a href="/" class="header__link {{ request()->is('/') ? 'header__link--active' : '' }}">
                    Feed
                </a>
                <a href="/profile" class="header__link {{ request()->is('profile') ? 'header__link--active' : '' }}">
                    Profile
                </a>
            </nav>
        @endauth

        <div class="header__actions">
            <button type="button" id="theme-toggle" class="header__theme-btn">
                Dark Mode
            </button>

            @auth
                <span class="header__user">{{ auth()->user()->name }}</span>
                <form action="/logout" method="POST" class="header__logout-form">
                    @csrf
                    <button type="submit" class="btn btn--secondary btn--sm">Log Out</button>
                </form>
            @endauth
        </div>
    </div>
</header>
