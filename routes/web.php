<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;


// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

// Rute untuk menampilkan halaman dashboard
Route::get('/admin', function () {
    return view('admin');
})->middleware(['auth', 'admin'])->name('admin');

Route::middleware('guest')->group(function () {
// Rute menampilkan halaman untuk regiser   
Route::get('/register', [
        AuthController::class,
        'showRegister'
    ])->name('register');
//  Rute untuj menangani proses register
    Route::post('/register', [
        AuthController::class,
        'register'
    ]);

    // Rute menampilkan halaman untuk login
    Route::get('/login', [
        AuthController::class,
        'showLogin'
    ])->name('login');

    // Rute untuk menangani proses login
    Route::post('/login', [
        AuthController::class,
        'login'
    ])->middleware('throttle:5,1');
    // artinya adalah user hanya bisa mencoba login sebanyak 5 kali dalam 1 menit, jika lebih dari itu maka user akan diblokir sementara waktu.
});

// Rute untuk menangani proses logout
Route::post('/logout', [
    AuthController::class,
    'logout'
])->middleware('auth')->name('logout');

// Rute untuk menampilkan halaman dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/posts', [PostController::class, 'store'])
        ->name('posts.store');
});


/*
|--------------------------------------------------------------------------
| Route publik
|--------------------------------------------------------------------------
*/

Route::get('/', [PostController::class, 'index'])
    ->name('home');

Route::get('/posts', [PostController::class, 'index'])
    ->name('posts.index');

Route::get('/posts/create', [PostController::class, 'create'])
    ->middleware('auth')
    ->name('posts.create');

Route::get('/posts/{post}', [PostController::class, 'show'])
    ->name('posts.show');

/*
|--------------------------------------------------------------------------
| Route yang memerlukan login
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::post('/posts', [PostController::class, 'store'])
        ->name('posts.store');

    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])
        ->name('posts.edit');

    Route::put('/posts/{post}', [PostController::class, 'update'])
        ->name('posts.update');

    Route::delete('/posts/{post}', [PostController::class, 'destroy'])
        ->name('posts.destroy');
});


// Route::get('/admin', function() {
//     return response('Halaman Admin berhasil diakses');
// }) ->middleware('ensure.admin');





