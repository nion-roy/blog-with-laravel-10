<?php

namespace App\Http\Controllers\Author;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\NewAuthorPost;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$post = Auth::user()->posts()->latest()->get();
		return view('author.post.index', compact('post'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$category = Category::all();
		$tag = Tag::all();
		return view('author.post.create', compact('category', 'tag'));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'title'					=> 'required|unique:posts',
			'image'					=> 'required|mimes:jpg,jpeg,png|max:3072',
			'categories'		=> 'required',
			'tags'					=> 'required',
			'body'					=> 'required',
		]);

		// get form image
		$image = $request->file('image');
		$slug = Str::slug($request->title);
		if (isset($image)) {

			// make unique name for image
			$imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

			// check post dir is exists
			if (!Storage::disk('public')->exists('post')) {
				Storage::disk('public')->makeDirectory('post');
			}
			// resize image for post add upload
			$setImage = Image::make($image)->resize(1600, 1066)->stream();
			Storage::disk('public')->put('post/' . $imageName, $setImage);

			// check post thumbnail dir is exists
			if (!Storage::disk('public')->exists('post/thumbnail')) {
				Storage::disk('public')->makeDirectory('post/thumbnail');
			}
			// resize image thumbnail for post add upload
			$setImageThumbnail = Image::make($image)->resize(560, 360)->stream();
			Storage::disk('public')->put('post/thumbnail/' . $imageName, $setImageThumbnail);
		} else {
			$imageName = 'default.png';
		}

		$post = new Post();
		$post->user_id	= Auth::id();
		$post->title		= $request->title;
		$post->slug			= $slug;
		$post->image		= $imageName;
		$post->body			= $request->body;

		if (isset($request->status)) {
			$post->status	= 'active';
		} else {
			$post->status	= 'inactive';
		}

		$post->is_approved = 'false';
		$post->save();


		$post->category()->attach($request->categories);
		$post->tag()->attach($request->tags);

		// Author SMTP mail server
		$users = User::where('role', 'author')->get();
		Notification::send($users, new NewAuthorPost($post));

		Toastr::success('Post Successfully Create');
		return redirect()->back();
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Post $post)
	{
		// The author can edit articles that do not belong to him
		if ($post->user_id !== Auth::id()) {
			Toastr::error('You are not authorized to access this post');
			return redirect()->back();
		}

		$category = Category::all();
		$tag = Tag::all();
		return view('author.post.show', compact('post', 'category', 'tag'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Post $post)
	{
		// The author can edit articles that do not belong to him
		if ($post->user_id !== Auth::id()) {
			Toastr::error('You are not authorized to access this post');
			return redirect()->back();
		}

		$category = Category::all();
		$tag = Tag::all();
		return view('author.post.edit', compact('post', 'category', 'tag'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Post $post)
	{
		// The author can edit articles that do not belong to him
		if ($post->user_id !== Auth::id()) {
			Toastr::error('You are not authorized to access this post');
			return redirect()->back();
		}

		$this->validate($request, [
			'title'				=> 'required',
			'image'				=> 'mimes:jpg,jpeg,png|max:3072',
			'categories'		=> 'required',
			'tags'					=> 'required',
			'body'				=> 'required',
		]);

		// get form image
		$image = $request->file('image');
		$slug = Str::slug($request->title);
		if (isset($image)) {

			// make unique name for image
			$imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

			// check post dir is exists
			if (!Storage::disk('public')->exists('post')) {
				Storage::disk('public')->makeDirectory('post');
			}

			// old image delete with update
			if (Storage::disk('public')->exists('post/' . $post->image)) {
				Storage::disk('public')->delete('post/' . $post->image);
			}

			// resize image for post add upload
			$setImage = Image::make($image)->resize(1600, 1066)->stream();
			Storage::disk('public')->put('post/' . $imageName, $setImage);

			// check post thumbnail dir is exists
			if (!Storage::disk('public')->exists('post/thumbnail')) {
				Storage::disk('public')->makeDirectory('post/thumbnail');
			}

			// old image delete with update
			if (Storage::disk('public')->exists('post/thumbnail/' . $post->image)) {
				Storage::disk('public')->delete('post/thumbnail/' . $post->image);
			}

			// resize image thumbnail for post add upload
			$setImageThumbnail = Image::make($image)->resize(560, 360)->stream();
			Storage::disk('public')->put('post/thumbnail/' . $imageName, $setImageThumbnail);
		} else {
			// with out upload image
			$imageName = $post->image;
		}

		$post->user_id	= Auth::id();
		$post->title		= $request->title;
		$post->slug			= $slug;
		$post->image		= $imageName;
		$post->body			= $request->body;

		if (isset($request->status)) {
			$post->status	= 'active';
		} else {
			$post->status	= 'inactive';
		}

		$post->is_approved = 'false';
		$post->save();

		$post->category()->sync($request->categories);
		$post->tag()->sync($request->tags);


		Toastr::success('Post Successfully Update');
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Post $post)
	{
		// The author can edit articles that do not belong to him
		if ($post->user_id !== Auth::id()) {
			Toastr::error('You are not authorized to access this post');
			return redirect()->back();
		}
		// image delete with storage
		if (Storage::disk('public')->exists('post/' . $post->image)) {
			Storage::disk('public')->delete('post/' . $post->image);
		}

		// image delete with storage
		if (Storage::disk('public')->exists('post/thumbnail/' . $post->image)) {
			Storage::disk('public')->delete('post/thumbnail/' . $post->image);
		}

		$post->category()->detach();
		$post->tag()->detach();
		$post->delete();
		Toastr::success('Post Successfully Delete');
		return redirect()->back();
	}
}
