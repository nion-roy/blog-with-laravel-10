<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class CommentController extends Controller
{
	public function store(Request $request, $post)
	{
		$this->validate($request, [
			'name'		=> 'required',
			'email'		=> 'required|email',
			'subject'		=> 'required',
			'message'		=> 'required',
		]);

		$comment = new Comment();
		$comment->user_id = Auth::user()->id;
		$comment->post_id	= $post;
		$comment->name 		= $request->name;
		$comment->email 	= $request->email;
		$comment->subject = $request->subject;
		$comment->message = $request->message;
		$comment->save();

		Toastr::success('Your Comment Successfully Submit');
		return redirect()->back();
	}
}
