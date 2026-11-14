# Project Overview

## Purpose
A clean, beginner-to-intermediate Laravel blog application designed as a portfolio piece and future code reference, targeted for deployment on **Render**. The goal is to elevate a foundational Laravel tutorial project with a serviceable, cohesive UI, modular BEM CSS, light/dark mode support, and a streamlined multi-page user flow without overcomplicating the codebase.

## Core User Flow & Access Model
- **Authenticated Experience**: Users log in or register via a dedicated authentication screen (with a simple toggle between Login and Register forms). Guest browsing is intentionally omitted to keep authentication and route protection straightforward.
- **Global Layout**:
  - **Header**:
    - **Brand Logo (Left)**: Typographic logo featuring the application name followed by an accent-colored period (`.`).
    - **Primary Navigation (Center)**: Clean single-word navigation links: **Feed** (all posts) and **Profile** (user details & personal posts).
    - **User & Theme Controls (Right)**: Simple **Light / Dark Mode toggle**, the authenticated user's name, and a **Log Out** button.
  - **Footer**: A clean, minimal footer grounding the page layout.

## Application Pages
1. **Authentication (Login / Register)**:
   - Serviceable form card allowing users to switch between signing in and creating an account.
2. **All Posts (`Feed`)**:
   - Displays posts from all users in clean, readable post cards (title, author, date, excerpt, and link to read the full post).
3. **User Profile & My Posts (`Profile`) — Two-Column Layout**:
   - **Posts Column**: Dedicated workspace where the logged-in user can create new posts and view, edit, or delete their own published posts.
   - **User Details Column**: Displays account details (username, email address, registration date, and total post count) alongside a **Delete Account** button for pruning test accounts and their associated data.
4. **Single Post View**:
   - Dedicated reading view for full-length blog posts, displaying full content, metadata, and author controls (Edit/Delete) when viewed by the post's creator.
5. **Edit Post View**:
   - Focused form view for updating an existing post.

## Hosting Target
- **Render**: Selected for GitHub-connected deployment (supporting PHP/Laravel runtime and database persistence).
- **Live URL**: [https://simple-blog-laravel.onrender.com/](https://simple-blog-laravel.onrender.com/)
