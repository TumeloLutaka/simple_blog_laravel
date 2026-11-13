# Build Plan

## Overall Goal
Transform the foundational Laravel blog tutorial into a clean, portfolio-ready application (deployable on **Render**) with a serviceable UI, modular BEM stylesheets using CSS relative colors (`from`), light/dark mode toggle, a shared Blade layout, and a streamlined set of views.

## Completed Phases

### Phase 1: Shared Layout, Theme Toggle & Modular BEM CSS Setup (Completed)
- **Shared Blade Components (`resources/views/components/layout.blade.php`, `header.blade.php`, `footer.blade.php`)**:
  - **Header**: Typographic logo (`SimpleBlog.` with a primary-colored period), single-word navigation links (**Feed** and **Profile**), and right-aligned **Light/Dark theme toggle**, current user name, and **Log Out** button.
  - **Main Content Area**: Consistent container for page views and semantic status/validation messages.
  - **Footer**: Simple, minimal footer.
- **Modular CSS Architecture (`public/css/`)**:
  - Split styles into focused files strictly following BEM naming conventions and using CSS relative color syntax (`from`):
    - `base.css`: Reset, typography, core color variables (`--primary`, `--bg-dark`, `--bg-main`, `--bg-light`, and the 4 semantic colors `--success`, `--warning`, `--danger`, `--info`), light/dark theme definitions, and shared `.btn`, `.form`, and `.alert` blocks.
    - `layout.css`: `.page`, `.header`, and `.footer` blocks.
    - `auth.css`: `.auth` Login/Register card and form toggle styles.
    - `post.css`: `.feed`, `.post-card`, and `.post-view` blocks.
    - `profile.css`: `.profile` two-column profile layout, user details summary card, and danger-zone account deletion controls.

### Phase 2: Authentication View — Login & Register Toggle (Completed)
- Updated `home.blade.php` so guests see a serviceable authentication card (`.auth__card`) with a toggle to switch between **Log In** and **Register** forms.
- Authenticated users see the community **Feed** on `/`.

### Phase 3: Blog Views — Feed, Single Post, Edit Post (Completed)
- **All Posts (`Feed` at `/`)**:
  - Displays all users' posts in styled BEM post cards (`.post-card`).
  - Truncates long post bodies in the card preview and links to the Single Post page (`/posts/{post}`).
- **Single Post View (`/posts/{post}`)**:
  - Dedicated reading view (`resources/views/show-post.blade.php`) showing full title, author, timestamp, complete body text, and conditional Edit/Delete buttons for the author.
- **Edit Post View (`/edit-post/{post}`)**:
  - Updated `resources/views/edit-post.blade.php` to use `<x-layout>` and BEM form classes.

### Phase 4: Two-Column Profile Page — My Posts + User Details & Delete Account (Completed)
- Created `resources/views/profile.blade.php` and `/profile` routes using the two-column `.profile` BEM layout:
  - **Column 1 (`.profile__posts-col`)**: Create a New Post form + list of the authenticated user's own posts with Read, Edit, and Delete controls.
  - **Column 2 (`.profile__details-col`)**: Displays Username, Email, Member Since date, Total Posts count, and the **Delete User** button (`DELETE /profile`) that deletes the user's posts and account.

---

## Upcoming / Deferred Items (To Return To)

### Phase 5: Render Deployment & Database Seeder Prep
1. **Demo Database Seeder (`DatabaseSeeder`)**:
   - Create a seeder that populates a demo user account and sample blog posts (`php artisan migrate --force --seed` on startup).
   - Ensures that even if Render's free web service tier spins down and resets the ephemeral SQLite database, portfolio visitors always have sample posts and a demo login ready to explore.
2. **Render Environment & Start Configuration**:
   - Configure production environment variables (`APP_KEY`, `APP_ENV=production`, `APP_DEBUG=false`, `DB_CONNECTION=sqlite` or PostgreSQL URL).
   - Add Render build/start script or `Dockerfile` for seamless GitHub-to-Render deployment.
