<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
	public function index()
	{
		$users = User::Authors()->orderBy('id', 'DESC')
		->withCount('posts')
		->withCount('favorite_posts')
		->withCount('comments')
		->get();
		return view('admin.user.index', compact('users'));
	}

	public function destroy(string $id)
	{
		User::findOrFail($id)->delete();

		Toastr::success('User Successfully Delete');
		return redirect()->back();
	}
}
