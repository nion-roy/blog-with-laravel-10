<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index()
	{
		$sliders = Slider::latest()->active()->get();
		$posts = Post::latest()->approved()->active()->take(6)->get();
		$recentPosts = Post::latest()->approved()->active()->take(4)->get();
		return view('home',compact('sliders', 'posts', 'recentPosts'));
	}
}
