<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Cache\Store;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$slider = Slider::latest()->get();
		return view('admin.slider.index', compact('slider'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('admin.slider.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'title'		=> 'required|unique:sliders',
			'image'		=> 'required|mimes:jpg,jpeg,png,webp|max:3072'
		]);

		$image = $request->file('image');
		$slug = Str::slug($request->title);

		if (isset($image)) {

			$imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

			if (!Storage::disk('public')->exists('slider')) {
				Storage::disk('public')->makeDirectory('slider');
			}

			$setImage = Image::make($image)->resize(1680, 900)->stream();
			Storage::disk('public')->put('slider/' . $imageName, $setImage);
		} else {
			$imageName = 'default.png';
		}


		Slider::create([
			'title'		=> $request->title,
			'slug'		=> $slug,
			'image'		=> $imageName,
		]);

		Toastr::success('Slider Successfully Create');
		return redirect()->back();
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		$slider = Slider::findOrFail($id);
		return view('admin.slider.edit', compact('slider'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$this->validate($request, [
			'title'		=> 'required',
			'image'		=> 'mimes:jpg,jpeg,png,webp|max:3072'
		]);

		$slider = Slider::findOrFail($id);

		$image = $request->file('image');
		$slug = Str::slug($request->title);

		if (isset($image)) {
			$imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

			if (!Storage::disk('public')->exists('slider')) {
				Storage::disk('public')->makeDirectory('slider');
			}

			if (Storage::disk('public')->exists('slider/' . $slider->image)) {
				Storage::disk('public')->delete('slider/' . $slider->image);
			}

			$setImage = Image::make($image)->resize(1680, 900)->stream();
			Storage::disk('public')->put('slider/' . $imageName, $setImage);
		} else {
			$imageName = $slider->image;
		}

		$slider->update([
			'title'		=> $request->title,
			'slug' 		=> $slug,
			'image'		=> $imageName,
		]);

		Toastr::success('Slider Successfully Update');
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		Slider::findOrFail($id)->delete();
		Toastr::success('Slider Successfully Delete');
		return redirect()->back();
	}


	/**
	 * Active the specified resource from storage.
	 */
	public function active(string $id)
	{
		$active = Slider::findOrFail($id);
		$active->status = 'inactive';
		$active->update();

		Toastr::success('Slider Successfully Inactive');
		return redirect()->back();
	}

	/**
	 * Inactive the specified resource from storage.
	 */
	public function inactive(string $id)
	{
		$inactive = Slider::findOrFail($id);
		$inactive->status = 'active';
		$inactive->update();

		Toastr::success('Slider Successfully Active');
		return redirect()->back();
	}
}
