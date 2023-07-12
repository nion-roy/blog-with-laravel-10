@extends('layouts.backend.app')

@section('main_content')

<!-- Exportable Table -->
<div class="block-header">
	<a href="{{ route('slider.create') }}" class="btn btn-danger waves-effect">
		<i class="material-icons">add</i>
		<span>Add New Slider</span>
	</a>
</div>

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<div style="display:flex; align-items:center; justify-content: space-between">
					<h2> ALL SLIDERS <span class="badge bg-pink">{{ $slider->count() }}</span></h2>
				</div>
			</div>
			<div class="body">
				<div class="table-responsive" style="padding-top: 6px">
					<table class="table table-bordered table-striped table-hover dataTable js-exportable">
						<thead>
							<tr>
								<th>SL</th>
								<th>Title</th>
								<th>Slug</th>
								<th>Image</th>
								<th>Status</th>
								<th>Create</th>
								<th>Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>SL</th>
								<th>Title</th>
								<th>Slug</th>
								<th>Image</th>
								<th>Status</th>
								<th>Create</th>
								<th>Action</th>
							</tr>
						</tfoot>
						<tbody>
							@foreach ($slider as $key => $row)
							<tr>
								<th>{{ $key + 1 }}</th>
								<th>{{ Str::limit($row->title, 16, '...') }}</th>
								<th>{{ Str::limit($row->slug, 16, '...') }}</th>
								<th>
									<img src="{{ Storage::disk('public')->url('slider/'.$row->image) }}" class="img-thumbnail"
										width="80px" alt="{{ $row->image }}">
								</th>
								<th>{{ $row->created_at->format('d-M-y') }}</th>
								<th>
									@if ($row->status == 'active')
									<a href="{{ route('slider.active', $row->id) }}" class="btn btn-xs btn-success">Active</a>
									@else
									<a href="{{ route('slider.inactive', $row->id) }}" class="btn btn-xs btn-danger">Inative</a>
									@endif
								</th>
								<th>
									<a href="{{ route('slider.edit', $row->id) }}" class="btn bg-green btn-xs waves-effect"><i
											class="material-icons">create</i></a>
									<a href="{{ route('slider.delete', $row->id) }}" id="delete"
										class="btn btn-danger btn-xs waves-effect"><i class="material-icons">delete</i></a>
								</th>
							</tr>

							@endforeach

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- #END# Exportable Table -->

@endsection