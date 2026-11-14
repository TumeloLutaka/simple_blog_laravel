<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database with demo users and sample blog posts.
     */
    public function run(): void
    {
        $demoUser = User::firstOrCreate(
            ['email' => 'demo@example.com'],
            [
                'name' => 'demouser',
                'password' => 'password123',
            ]
        );

        $secondUser = User::firstOrCreate(
            ['email' => 'alex@example.com'],
            [
                'name' => 'alexwriter',
                'password' => 'password123',
            ]
        );

        Post::firstOrCreate(
            ['title' => 'Welcome to SimpleBlog: A Clean Laravel MVC Reference'],
            [
                'user_id' => $demoUser->id,
                'body' => "SimpleBlog is a portfolio-ready Laravel application built to demonstrate core MVC fundamentals without unnecessary complexity.\n\nIt uses standard Laravel routing, Eloquent relationships between Users and Posts, session-based authentication, and reusable Blade layout components. You can log in with the demo account (username: demouser / password: password123) or register your own account to create, edit, and delete posts.",
            ]
        );

        Post::firstOrCreate(
            ['title' => 'Styling with Modular BEM CSS and Relative Color Syntax'],
            [
                'user_id' => $secondUser->id,
                'body' => "Instead of relying on a heavy frontend build pipeline or a single monolithic stylesheet, this project splits its vanilla CSS into focused files under public/css/ (base.css, layout.css, auth.css, post.css, and profile.css).\n\nEvery component follows the BEM (block__element--modifier) naming convention, and hover states, borders, and subtle alert backgrounds are derived dynamically from a minimal set of core CSS variables using modern CSS relative color syntax.",
            ]
        );

        Post::firstOrCreate(
            ['title' => 'Inside the Two-Column Profile Workspace'],
            [
                'user_id' => $demoUser->id,
                'body' => "Head over to the Profile link in the top navigation bar to explore the two-column workspace.\n\nThe left column lets you publish new articles and manage your existing posts, while the right column summarizes your account details and includes a Danger Zone option to cleanly delete your user account along with all of your published posts.",
            ]
        );
    }
}
