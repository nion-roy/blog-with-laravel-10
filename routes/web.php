<?php

use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('subscriber', [App\Http\Controllers\SubscriberController::class, 'store'])->name('subscriber.store');

Route::get('categories', [App\Http\Controllers\PostController::class, 'index'])->name('category');
Route::get('post/{slug}', [App\Http\Controllers\PostController::class, 'destails'])->name('post.destails');
Route::get('categories/{slug}', [App\Http\Controllers\PostController::class, 'postByCategory'])->name('category.post');
Route::get('tags/{slug}', [App\Http\Controllers\PostController::class, 'postByTag'])->name('tag.post');

Route::get('search', [App\Http\Controllers\SearchController::class, 'search'])->name('search');

Route::middleware(['auth'])->group(function () {
	Route::get('favorite/add/{post}', [App\Http\Controllers\FavoriteController::class, 'add'])->name('post.favorite');
	Route::get('favorite/remove/{post}', [\App\Http\Controllers\FavoriteController::class, 'add'])->name('favorite.remove');
	Route::post('comment/{post}', [\App\Http\Controllers\CommentController::class, 'store'])->name('comment.store');
});




Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');





require __DIR__ . '/admin.php';
