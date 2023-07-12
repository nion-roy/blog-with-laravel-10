@extends('layouts.backend.app')

@section('main_content')

<form action="{{ route('slider.update', $slider->id) }}" method="post" enctype="multipart/form-data">
	@csrf
	@method('PUT')

	<div class="row clearfix">

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header">
					<h2>
						NEW SLIDER ADD
					</h2>
				</div>
				<div class="body">

					<label for="post">Slider Title</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" id="title" name="title" class="form-control" placeholder="Enter slider title"
								value="{{ $slider->title }}">
						</div>
					</div>

					<label for="image">Choose Image</label>
					<div class="form-group">
						<div class="form-line">
							<img src="{{ Storage::disk('public')->url('slider/'.$slider->image) }}" class="img-thumbnail" style="width: 160px" alt="{{ $slider->title }}">
							<input type="file" id="image" name="image" class="form-control" placeholder="Enter choose image">
						</div>
					</div>

					<a href="{{ route('slider.index') }}" class="btn btn-danger m-t-10 waves-effect">BACK</a>
					<button type="submit" class="btn btn-primary m-t-10 waves-effect">UPDATE</button>

				</div>
			</div>
		</div>

	</div>
</form>

@endsection