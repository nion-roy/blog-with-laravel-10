<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class SubscriberController extends Controller
{
	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|email|unique:subscribers',
		]);

		// return $request;

		Subscriber::create([
			'email' => $request->email,
		]); //object create with model name

		Toastr::success('You Successfully add to our subscriber list');
		return redirect()->back();
	}
}
