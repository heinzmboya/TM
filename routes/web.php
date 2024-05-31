<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
// use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

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

require __DIR__ . '/auth.php';
