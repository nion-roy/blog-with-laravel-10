<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
	public function search(Request $request)
	{
		$query = $request->input('query');
		$posts = Post::where('title', 'LIKE', "%$query%")->latest()->approved()->active()->get();
		return view('search', compact('posts', 'query'));
	}
}
