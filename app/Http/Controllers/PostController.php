<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function showPost(Post $post)
    {
        if (!auth()->guard()->check()) {
            return redirect('/');
        }

        return view('show-post', ['post' => $post]);
    }

    public function createPost(Request $request)
    {
        if (!auth()->guard()->check()) {
            return redirect('/');
        }

        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->guard()->id();

        Post::create($incomingFields);

        return redirect('/profile')->with('status', 'Post published successfully!');
    }

    public function deletePost(Post $post)
    {
        if ($post->user_id === auth()->guard()->id()) {
            $post->delete();
        }

        return redirect('/profile')->with('status', 'Post deleted.');
    }

    public function editPost(Post $post)
    {
        if ($post->user_id !== auth()->guard()->id()) {
            return redirect('/');
        }

        return view('edit-post', ['post' => $post]);
    }

    public function updatePost(Post $post, Request $request)
    {
        if ($post->user_id !== auth()->guard()->id()) {
            return redirect('/');
        }

        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $post->update($incomingFields);

        return redirect('/posts/' . $post->id)->with('status', 'Post updated successfully!');
    }
}
