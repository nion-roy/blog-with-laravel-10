<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Slider;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Subscriber;

class AdminController extends Controller
{
	public function index()
	{
		$posts = Post::all();
		$comments = Comment::all();
		$sliders = Slider::all();
		$subscribers = Subscriber::all();
		$popular = Post::withCount('comments')
			->withCount('favorite_users')
			->orderBy('view_count', 'desc')
			->orderBy('comments_count', 'desc')
			->orderBy('favorite_users_count', 'desc')
			->take(5)->get();

		$pending_posts = Post::where('is_approved', 'false')->count();
		$all_post_views = Post::sum('view_count');
		$author_count = User::where('role', 'author')->count();
		$new_author_today = User::where('role', 'author')->whereDate('created_at', Carbon::today())->count();
		$active_author = User::where('role', 'author')
			->withCount('posts')
			->withCount('comments')
			->withCount('favorite_posts')
			->orderBy('posts_count', 'desc')
			->orderBy('comments_count', 'desc')
			->orderBy('favorite_posts_count', 'desc')
			->take(10)->get();

		$categories_count = Category::all()->count();
		$tags_count = Tag::all()->count();

		return view('admin.dashboard', compact('posts', 'popular', 'comments', 'sliders', 'subscribers', 'pending_posts', 'all_post_views', 'author_count', 'new_author_today', 'active_author', 'categories_count', 'tags_count'));
	}


	public function login()
	{
		return view('admin.login');
	}
}
