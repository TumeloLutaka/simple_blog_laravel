# Progress Tracker

All notable changes, decisions, and milestones for the project are recorded here.

## Log

### 2026-11-14
- **Created `context/code-standards.md`**: Defined CSS styling rules enforcing the BEM (`block__element--modifier`) naming convention and requiring user approval before renaming non-BEM classes. Added PHP/Laravel code readability standards (beginner-to-intermediate clarity).
- **Updated `AGENTS.md`**: Added rule requiring the agent to always read all files inside `context/` before executing any command or request.
- **Created `context/architecture.md`**: Documented the beginner-to-intermediate simplicity philosophy and standard out-of-the-box Laravel MVC approach (avoiding unnecessary enterprise patterns like Repositories/Services).
- **Created & Updated `context/project-overview.md`**: Defined the project purpose and initial visibility model.
- **Created & Updated `context/build-plan.md`**: Recorded the initial polishing scope.
- **Created `context/progress-tracker.md`**: Initialized ongoing change log to track all project updates and decisions.
- **Refined `context/project-overview.md`, `context/build-plan.md`, `context/code-standards.md`, and `context/architecture.md`**:
  - Defined the portfolio-ready "serviceable & simple" design theme.
  - Added modular CSS requirement to `code-standards.md` (splitting styles into focused files such as `base.css`, `layout.css`, `auth.css`, `post.css`, and `profile.css`).
  - Specified the shared header design (typographic logo with colored period, single-word navigation links, right-aligned username and Log Out button) and simple footer.
- **Consolidated `My Posts` into a Two-Column `Profile` Page & Selected Render for Hosting**:
  - Updated `context/project-overview.md` and `context/build-plan.md` so the **Profile** page uses a two-column layout: one column for creating/listing the user's own posts, and the other column for displaying user details and the **Delete Account** button.
  - Streamlined primary navigation to two single-word links: **Feed** and **Profile**.
  - Recorded **Render** as the target hosting platform.
- **Locked in Theme Toggle & Relative CSS Color System**:
  - Added header **Light / Dark mode toggle** requirement to `project-overview.md`, `build-plan.md`, and `code-standards.md`.
  - Standardized the minimal color token system (`--primary`, `--bg-dark`, `--bg-main`, `--bg-light`, and the 4 semantic colors `--success`, `--warning`, `--danger`, `--info`) using CSS relative color syntax (`from`) for derived shades, borders, and hover states.
- **Completed Phases 1–4 Implementation**:
  - **BEM Audit**: Audited existing views and `public/css/app.css`. The only existing class was `.post-card` (which already conformed to BEM block naming); all other rules were bare element selectors.
  - **Modular BEM Stylesheets**: Created `public/css/base.css`, `public/css/layout.css`, `public/css/auth.css`, `public/css/post.css`, and `public/css/profile.css` using CSS relative color syntax (`hsl(from ...)` and `rgb(from ...)`) and `[data-theme="dark"]` support.
  - **Shared Layout Components**: Updated `resources/views/components/layout.blade.php` and `resources/views/components/header.blade.php`, and created `resources/views/components/footer.blade.php` (featuring the `SimpleBlog.` logo with colored dot, `Feed` and `Profile` navigation, Light/Dark mode toggle persisted in `localStorage`, username display, and Log Out button).
  - **Views**:
    - Updated `resources/views/home.blade.php` with the community **Feed** for logged-in users and a **Log In / Register toggle card** for guests.
    - Created `resources/views/show-post.blade.php` for reading full-length posts.
    - Updated `resources/views/edit-post.blade.php` to use the shared layout and BEM classes.
    - Created `resources/views/profile.blade.php` with a two-column layout (Create Post + My Posts in column 1; Profile Details + Delete User button in column 2).
  - **Routes & Controllers**: Updated `routes/web.php`, `app/Http/Controllers/UserController.php`, and `app/Http/Controllers/PostController.php` to support the community feed, single post view, two-column profile page, and account deletion with post cleanup.
- **Repository Cleanup, Git Initialization & Remote Push**:
  - Removed unused `resources/css/app.css` and `resources/css/reset.css`.
  - Recorded **Phase 5 (Render Deployment & Database Seeder Prep)** in `context/build-plan.md` for future implementation.
  - Replaced default `README.md` with project-specific documentation.
  - Initialized Git repository (`git init`), added remote `origin` (`https://github.com/TumeloLutaka/simple_blog_laravel.git`), committed project files on `main`, and pushed to GitHub.
- **Completed Phase 5 (Render Deployment & Database Seeder Prep)**:
  - Updated `app/Providers/AppServiceProvider.php` to force HTTPS scheme in production (`URL::forceScheme('https')`) behind Render's reverse proxy.
  - Updated `database/seeders/DatabaseSeeder.php` using `firstOrCreate` to seed demo accounts (`demouser` / `password123` and `alexwriter` / `password123`) and three sample blog posts on startup.
  - Created `Dockerfile` (`php:8.4-apache` with `pdo_sqlite` and `pdo_pgsql`), `scripts/render-start.sh`, `.dockerignore`, and `render.yaml` Blueprint for Render deployment.
  - Updated `README.md` and `context/build-plan.md` with demo credentials and Render deployment instructions.
- **Verified Live Render Deployment & Finalized Project**:
  - Verified live production deployment at `https://simple-blog-laravel.onrender.com/`.
  - Added the live demo link and repository URL to `README.md` and `context/project-overview.md` to close out the project.
