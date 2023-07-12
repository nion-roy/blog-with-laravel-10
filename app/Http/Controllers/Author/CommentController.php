<?php

namespace App\Http\Controllers\Author;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
	public function index()
	{

		$user = Auth::user()->id;
		$comments = Comment::where('user_id', $user)->latest()->get();
		return view('author.comment.index', compact('comments'));

		// $posts = Auth::user()->comments;
		// return view('author.comment.index', compact('posts'));
	}


	public function destroy(string $id)
	{
		$comment = Comment::findOrFail($id);
		if ($comment->post->user->id == Auth::id()) {
			$comment->delete();
			Toastr::success('Comment Successfull Delete');
		} else {
			Toastr::error('You are not authorized to delete this comment');
		}
		return redirect()->back();
	}
}
