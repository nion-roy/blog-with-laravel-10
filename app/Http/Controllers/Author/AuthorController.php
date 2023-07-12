<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
	public function index()
	{

		$user = Auth::user();
		$posts = $user->posts;
		$popular = $user->posts() 
		->withCount('favorite_users') 
		->withCount('comments') 
		->orderBy('view_count', 'desc')
		->orderBy('comments_count', 'desc')
		->orderBy('favorite_users_count', 'desc')
    ->take(5)->get();
		$pendding	= $posts->where('is_approved', 'false')->count();
		$favorites = $user->favorite_posts;
		$comments = $user->comments;
		return view('author.dashboard', compact('posts', 'popular', 'favorites', 'comments', 'pendding'));
	}
}
