# Code Standards

## PHP & Laravel Code Readability
- **Beginner-to-Intermediate Level**: Write straightforward, self-explanatory PHP and Blade code that is easy to read and reference later.
- **Idiomatic Syntax**: Prefer standard, out-of-the-box Laravel helpers, Eloquent methods, and Blade directives over clever one-liners or deeply nested abstractions.

## CSS & Styling

### BEM Naming Convention
- Stick as close to the **BEM (Block, Element, Modifier)** naming convention (`block__element--modifier`) as possible for all CSS classes and styling.
- **Non-BEM Classes Policy**: Whenever a CSS class that does not follow the BEM naming convention is encountered:
  1. Alert the user about the non-conforming class name.
  2. Provide a suggested BEM-compliant replacement name.
  3. Ask for the user's explicit approval before updating the class name.

### Modular Stylesheet Organization
- Do **not** place all styles into a single monolithic CSS file.
- Separate stylesheets by responsibility/component (`public/css/base.css`, `layout.css`, `auth.css`, `post.css`, `profile.css`) so each file stays short, focused, and easy to maintain.

### Color System & CSS Relative Colors (`from`)
- Keep the CSS color palette minimal and simple:
  - **Brand**: `--primary`
  - **Surfaces / Backgrounds**: `--bg-dark`, `--bg-main`, `--bg-light`
  - **Typography**: `--text-main`, `--text-muted`
  - **Semantic Status Colors**: `--success`, `--warning`, `--danger`, `--info` (used where appropriate for alerts, validation feedback, and destructive actions)
- **Light & Dark Mode**: Support a simple header toggle switching between light and dark themes via `data-theme="dark"` (persisted in `localStorage`).
- **Relative Color Syntax (`from`)**: Use modern CSS relative color functions (e.g., `hsl(from var(--primary) h s calc(l - 8%))` or `rgb(from var(--danger) r g b / 0.12)`) for hover states, borders, and subtle alert backgrounds instead of cluttering `:root` with extra color variables.
