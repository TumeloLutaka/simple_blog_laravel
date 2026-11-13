<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'login_name' => 'required',
            'login_password' => 'required',
        ]);

        if (auth()->guard()->attempt([
            'name' => $incomingFields['login_name'],
            'password' => $incomingFields['login_password'],
        ])) {
            $request->session()->regenerate();
            return redirect('/')->with('status', 'Welcome back!');
        }

        return back()
            ->withErrors(['login_name' => 'Invalid username or password.'])
            ->onlyInput('login_name');
    }

    public function logout(Request $request)
    {
        auth()->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'You have been logged out.');
    }

    public function register(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => ['required', 'min:4', 'max:15', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:100'],
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);
        auth()->guard()->login($user);

        return redirect('/')->with('status', 'Account created successfully!');
    }

    public function profile()
    {
        if (!auth()->guard()->check()) {
            return redirect('/');
        }

        /** @var User $user */
        $user = auth()->guard()->user();
        $posts = $user->posts()->latest()->get();

        return view('profile', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    public function deleteAccount(Request $request)
    {
        if (!auth()->guard()->check()) {
            return redirect('/');
        }

        /** @var User $user */
        $user = auth()->guard()->user();

        auth()->guard()->logout();
        $user->posts()->delete();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'User account and posts have been deleted.');
    }
}
