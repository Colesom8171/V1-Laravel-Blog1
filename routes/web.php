<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\BlogUserController;
use App\Http\Controllers\MessageController;

Route::get('/', function () {
    return view('welcome');
});
/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/
Route::get('/dashboard', [BlogUserController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('blogs_users', BlogUserController::class);
    Route::post('blogs_users/{id}/add_comment', [BlogUserController::class, 'add_comment']);
    //Route::post('blogs_users/{id}/delete_comment', [BlogUserController::class, 'delete_comment']);
    //Route::post('blogs_users/{id}', [BlogUserController::class, 'destroy']);
    Route::resource('comments', CommentController::class);
    Route::get('/dashboard', [BlogController::class, 'dashboard'])->name('dashboard');


    route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');

    //Route::get('blogs/create', [BlogController::class, 'create']);
    //
    // Mostrar el formulario para crear un nuevo blog
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');

    // Almacenar un nuevo blog
    Route::post('blogs', [BlogController::class, 'store'])->name('blogs.store');

    // Mostrar el formulario para editar un blog existente
    Route::get('blogs/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');

    // Actualizar un blog existente
    Route::put('blogs/{id}', [BlogController::class, 'update'])->name('blogs.update');

    // Eliminar un blog existente
    Route::delete('blogs/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');
    //

    Route::resource('comments', CommentController::class);

    Route::resource('messages', MessageController::class);
    Route::delete('/messages/{id}', [MessageController::class, 'destroy'])->name('messages.destroy');
    Route::get('/messages/chat/{receiverId}', [MessageController::class, 'chat'])->name('messages.chat');
    Route::get('/inbox', [MessageController::class, 'inbox'])->name('messages.inbox')->middleware('auth');

    //Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    //Route::get('/messages/create', [MessageController::class, 'create'])->name('messages.create');
    //Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    //Route::get('/messages/{id}', [MessageController::class, 'show'])->name('messages.show');
    
    
});

require __DIR__.'/auth.php';
