<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class SubscriberController extends Controller
{
	public function index()
	{
		$subscriber = Subscriber::latest()->get();
		return view('admin.subscriber.index', compact('subscriber'));
	}

	public function destroy(string $id)
	{
		Subscriber::findOrFail($id)->delete();
		Toastr::success('Subscriber Successfully Delete');
		return redirect()->back();
	}
}
