@extends('layouts.backend.app')

@section('main_content')

<!-- Exportable Table -->
<div class="block-header">
	<a href="{{ route('post.create') }}" class="btn btn-danger waves-effect">
		<i class="material-icons">add</i>
		<span>Add Now Post</span>
	</a>
</div>

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<div style="display:flex; align-items:center; justify-content: space-between">
					<h2> ALL POST <span class="badge bg-pink">{{ $post->count() }}</span></h2>
				</div>
			</div>
			<div class="body">
				<div class="table-responsive" style="padding-top: 6px">
					<table class="table table-bordered table-striped table-hover dataTable js-exportable">
						<thead>
							<tr>
								<th>SL</th>
								<th>Title</th>
								<th>Image</th>
								<th>Is Approved</th>
								<th>Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>SL</th>
								<th>Title</th>
								<th>Image</th>
								<th>Is Approved</th>
								<th>Action</th>
							</tr>
						</tfoot>
						<tbody>


							@foreach ($post as $key => $row)

							<tr>
								<td>{{ $key + 1 }}</td>
								<td>{{ Str::limit($row->title, 20, '...') }}</td>
								<td>
									<img src="{{ asset('storage/post/'. $row->image) }}" class="img-thumbnail" width="60px"
										alt="{{ $row->name }}">
								</td>
								<td>
									@if ($row->is_approved == 'true')
									<span class="badge bg-green">Approved</span>
									@else
									<span class="badge bg-deep-orange">Pendding..</span>
									@endif
								</td>
								<td>
									<a href="{{ route('post.edit', $row->id) }}" class="btn bg-green btn-xs waves-effect"><i
											class="material-icons">create</i></a>
									<a href="{{ route('post.show', $row->id) }}" class="btn bg-deep-purple btn-xs waves-effect"><i
											class="material-icons">visibility</i></a>
									<a href="{{ route('post.delete', $row->id) }}" id="delete"
										class="btn btn-danger btn-xs waves-effect"><i class="material-icons">delete</i></a>
								</td>
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