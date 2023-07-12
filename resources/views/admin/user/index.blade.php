@extends('layouts.backend.app')

@section('main_content')

<!-- Exportable Table -->
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<div style="display:flex; align-items:center; justify-content: space-between">
					<h2> ALL USERS LIST <span class="badge bg-pink"></span></h2>
				</div>
			</div>
			<div class="body">
				<div class="table-responsive" style="padding-top: 6px">
					<table class="table table-bordered table-striped table-hover dataTable js-exportable">
						<thead>
							<tr>
								<th>SL</th>
								<th>Name</th>
								<th>Email</th>
								<th>Posts</th>
								<th>Comments</th>
								<th>Favorites</th>
								<th>Join</th>
								<th>Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>SL</th>
								<th>Name</th>
								<th>Email</th>
								<th>Posts</th>
								<th>Comments</th>
								<th>Favorites</th>
								<th>Join</th>
								<th>Action</th>
							</tr>
						</tfoot>
						<tbody>

							@foreach ($users as $key=> $user)
							<tr>
								<td>{{ $key + 1 }}</td>
								<td>{{ $user->name }}</td>
								<td>{{ $user->email }}</td>
								<td>{{ $user->posts_count }}</td>
								<td>{{ $user->comments_count }}</td>
								<td>{{ $user->favorite_posts_count }}</td>
								<td>{{ $user->created_at->format('d M, Y') }}</td>
								<td>
									<a href="{{ route('user.destroy', $user->id) }}" id="delete"
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