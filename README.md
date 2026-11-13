# SimpleBlog.

A clean, beginner-to-intermediate **Laravel** blog application built as a portfolio project and code reference. It demonstrates core Laravel MVC fundamentals—routing, controllers, session authentication, Eloquent relationships, and Blade components—paired with modular vanilla CSS following the **BEM (`block__element--modifier`)** naming convention.

---

## Features

- **Authentication**: Dedicated Login & Registration card with an interactive form toggle and session-based auth.
- **Community Feed (`/`)**: Browse blog posts from all users with clean post cards, excerpts, and author metadata.
- **Full Post Reader (`/posts/{post}`)**: Dedicated view for reading longer-form articles, with Edit/Delete actions restricted to the post's author.
- **Two-Column Profile Workspace (`/profile`)**:
  - **Posts Column**: Create new posts and manage (edit/delete) your own published posts.
  - **Profile & Account Column**: View account details (username, email, join date, post count) and delete the user account (automatically pruning all associated posts).
- **Light & Dark Theme Toggle**: Header theme switcher persisted in `localStorage` and powered by modern CSS relative color syntax (`hsl(from ...)` / `rgb(from ...)`).
- **Modular BEM Stylesheets**: Organized under `public/css/` (`base.css`, `layout.css`, `auth.css`, `post.css`, `profile.css`) with zero frontend build step required.

---

## Tech Stack

- **Backend**: PHP 8.3+, Laravel 13
- **Database**: SQLite (default) / MySQL / PostgreSQL via Eloquent ORM
- **Frontend**: Laravel Blade Components, Modular Vanilla CSS (BEM + CSS Relative Colors)

---

## Getting Started Locally

1. **Clone the repository**
   ```bash
   git clone <your-repo-url>
   cd simple-blog
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Configure environment & database**
   ```bash
   cp .env.example .env
   php artisan key:generate
   php artisan migrate
   ```

4. **Start the local development server**
   ```bash
   php artisan serve
   ```
   Visit `http://127.0.0.1:8000` in your browser.
