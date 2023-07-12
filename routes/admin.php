<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/admin/login', [App\Http\Controllers\Admin\AdminController::class, 'login'])->name('admin.login');

// Admin Route Group
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {

	Route::controller(App\Http\Controllers\Admin\AdminController::class)->group(function () {
		Route::get('/dashboard', 'index')->name('admin.dashboard');
	}); // Admin Controller

	Route::controller(App\Http\Controllers\Admin\TagController::class)->group(function () {
		Route::get('/tag', 'index')->name('admin.tag.index');
		Route::get('/tag/create', 'create')->name('admin.tag.create');
		Route::post('/tag/store', 'store')->name('admin.tag.store');
		Route::get('/tag/edit/{id}', 'edit')->name('admin.tag.edit');
		Route::post('/tag/update/{id}', 'update')->name('admin.tag.update');
		Route::get('/tag/destroy/{id}', 'destroy')->name('admin.tag.destroy');
		Route::get('/tag/active/{id}', 'active')->name('admin.tag.active');
		Route::get('/tag/inactive/{id}', 'inactive')->name('admin.tag.inactive');
	}); // Tag Controller With Admin


	Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function () {
		Route::get('/category', 'index')->name('admin.category.index');
		Route::get('/category/create', 'create')->name('admin.category.create');
		Route::post('/category/store', 'store')->name('admin.category.store');
		Route::get('/category/edit/{id}', 'edit')->name('admin.category.edit');
		Route::post('/category/update/{id}', 'update')->name('admin.category.update');
		Route::get('/category/destroy/{id}', 'destroy')->name('admin.category.destroy');
		Route::get('/category/active/{id}', 'active')->name('admin.category.active');
		Route::get('/category/inactive/{id}', 'inactive')->name('admin.category.inactive');
	}); // Category Controller With Admin


	Route::controller(App\Http\Controllers\Admin\PostController::class)->group(function () {
		Route::get('/post', 'index')->name('admin.post.index');
		Route::get('/post/create', 'create')->name('admin.post.create');
		Route::post('/post/store', 'store')->name('admin.post.store');
		Route::get('/post/edit/{id}', 'edit')->name('admin.post.edit');
		Route::post('/post/update/{id}', 'update')->name('admin.post.update');
		Route::get('/post/destroy/{id}', 'destroy')->name('admin.post.destroy');
		Route::get('/post/show/{id}', 'show')->name('admin.post.show');
		Route::get('/post/active/{id}', 'active')->name('admin.post.active');
		Route::get('/post/inactive/{id}', 'inactive')->name('admin.post.inactive');
		Route::get('/post/approved/{id}', 'approved')->name('admin.post.approved');
		Route::get('/pendding/post', 'pendding')->name('admin.post.pendding');
	}); // Post Controller With Admin


	// Slider Controller With Admin
	Route::resource('slider', App\Http\Controllers\Admin\SliderController::class);
	Route::get('slider/delete/{id}', [App\Http\Controllers\Admin\SliderController::class, 'destroy'])->name('slider.delete');
	Route::get('slider/active/{id}', [App\Http\Controllers\Admin\SliderController::class, 'active'])->name('slider.active');
	Route::get('slider/inactive/{id}', [App\Http\Controllers\Admin\SliderController::class, 'inactive'])->name('slider.inactive');
	// Slider Controller With Admin

	// Subscriber Controller With Admin
	Route::get('subscriber', [App\Http\Controllers\Admin\SubscriberController::class, 'index'])->name('subscriber.index');
	Route::get('subscriber/destroy/{id}', [App\Http\Controllers\Admin\SubscriberController::class, 'destroy'])->name('subscriber.destroy');
	// Subscriber Controller With Admin

	// Profile Controller With Admin
	Route::get('profile', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('admin.profile.index');
	Route::get('profile/setting', [App\Http\Controllers\Admin\ProfileController::class, 'adminSetting'])->name('admin.profile.setting');
	Route::put('profile/setting/profile-update', [App\Http\Controllers\Admin\ProfileController::class, 'updateProfile'])->name('admin.setting.update.profile');
	Route::put('profile/setting/password-update', [App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('admin.setting.update.password');
	// Profile Controller With Admin

	// Favorite Controller With Admin
	Route::get('favorite/posts', [App\Http\Controllers\Admin\FavoriteController::class, 'index'])->name('admin.favorite.index');
	// Favorite Controller With Admin

	// All Author Controller With Admin
	Route::get('users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('user.view');
	Route::get('users/destroy/{id}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('user.destroy');
	// All Author Controller With Admin

	// Comment Controller With Admin
	Route::get('comment', [App\Http\Controllers\Admin\CommentController::class, 'index'])->name('admin.comment.index');
	Route::get('comment/destroy/{id}', [App\Http\Controllers\Admin\CommentController::class, 'destroy'])->name('admin.comment.destroy');
	// Comment Controller With Admin

}); // Admin Middleware


// Author Route Group
Route::group(['prefix' => 'author', 'middleware' => 'author'], function () {

	Route::controller(App\Http\Controllers\Author\AuthorController::class)->group(function () {
		Route::get('/dashboard', 'index')->name('author.dashboard');
	}); // Author Controller Group

	Route::resource('post', \App\Http\Controllers\Author\PostController::class);
	Route::get('post/delete/{post}', [App\Http\Controllers\Author\PostController::class, 'destroy'])->name('post.delete');

	// Profile Controller With Admin
	Route::get('profile', [App\Http\Controllers\Author\ProfileController::class, 'index'])->name('author.profile.index');
	Route::get('profile/setting', [App\Http\Controllers\Author\ProfileController::class, 'authorSetting'])->name('author.profile.setting');
	Route::put('profile/setting/profile-update', [App\Http\Controllers\Admin\ProfileController::class, 'updateProfile'])->name('author.setting.update.profile');
	Route::put('profile/setting/password-update', [App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('author.setting.update.password');
	// Profile Controller With Admin

	// Favorite Controller With Admin
	Route::get('favorite/posts', [App\Http\Controllers\Author\FavoriteController::class, 'index'])->name('author.favorite.index');
	// Favorite Controller With Admin

	// Comment Controller With Admin
	Route::get('comment', [App\Http\Controllers\Author\CommentController::class, 'index'])->name('author.comment.index');
	Route::get('comment/destroy/{id}', [App\Http\Controllers\Author\CommentController::class, 'destroy'])->name('author.comment.destroy');
	// Comment Controller With Admin

});// Author Middleware Group
