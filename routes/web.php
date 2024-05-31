<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return view('welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::get('/get-started', function () {
    return Inertia::render('Auth/GetStarted');
})->name('get-started');

Route::get(
    '/dashboard',
    [TodoController::class, 'index']
)->middleware(['auth', 'verified'])->name('dashboard');

Route::post(
    '/dashboard',
    [TodoController::class, 'store']
)->middleware(['auth', 'verified'])->name('dashboard.post');

Route::patch(
    '/dashboard/{id}',
    [TodoController::class, 'update']
)->middleware(['auth', 'verified'])->name('todos.update');

Route::delete(
    '/dashboard/{id}',
    [TodoController::class, 'destroy']
)->middleware(['auth', 'verified'])->name('todos.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// oauth
Route::get('/auth/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name("google.redirect");

Route::get('/auth/callback', function () {
    $googleUser = Socialite::driver('google')->user();

    if (empty($googleUser)) {
        return;
    }
    $user = User::updateOrCreate([
        'google_id' => $googleUser->id,
    ], [
        'name' => $googleUser->name,
        'email' => $googleUser->email,
        'avatar' => $googleUser->avatar,
        'password' => Hash::make('password')
    ]);

    Auth::login($user);

    return redirect('/dashboard');
})->name("google.callback");

require __DIR__ . '/auth.php';
