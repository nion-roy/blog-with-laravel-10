@extends('layouts.backend.app')

@section('main_content')

<div class="block-header">
	<h2>DASHBOARD</h2>
</div>

<!-- Widgets -->
<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="info-box bg-pink hover-zoom-effect">
			<div class="icon">
				<i class="material-icons">playlist_add_check</i>
			</div>
			<div class="content">
				<div class="text">ALL POSTS</div>
				<div class="number count-to" data-from="0" data-to="{{ $posts->count() }}" data-speed="1000"
					data-fresh-interval="20"></div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="info-box bg-cyan hover-zoom-effect">
			<div class="icon">
				<i class="material-icons">favorite</i>
			</div>
			<div class="content">
				<div class="text">FAVORITES POSTS</div>
				<div class="number count-to" data-from="0" data-to="{{ $favorites->count() }}" data-speed="1000"
					data-fresh-interval="20"></div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="info-box bg-light-green hover-zoom-effect">
			<div class="icon">
				<i class="material-icons">forum</i>
			</div>
			<div class="content">
				<div class="text">COMMENTS</div>
				<div class="number count-to" data-from="0" data-to="{{ $comments->count() }}" data-speed="1000"
					data-fresh-interval="20"></div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="info-box bg-orange hover-zoom-effect">
			<div class="icon">
				<i class="material-icons">select_all</i>
			</div>
			<div class="content">
				<div class="text">PENDIN POST</div>
				<div class="number count-to" data-from="0" data-to="{{ $pendding }}" data-speed="1000" data-fresh-interval="20">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- #END# Widgets -->

<div class="row clearfix">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="card">
			<div class="header">
				<div class="row clearfix">
					<div class="col-xs-12 col-sm-6">
						<h2 class="text-uppercase">TOP 5 POPULER POSTS WITH - {{ Auth::user()->name }}</h2>
					</div>
				</div>
			</div>
			<div class="body">
				<table class="table table-bordered table-striped table-hover dataTable js-exportable">
					<thead>
						<tr>
							<th>Rank List</th>
							<th>Titlel</th>
							<th>Views</th>
							<th>Favorites</th>
							<th>Comments</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($popular as $key=>$row)
						<tr>
							<td>{{ $key+ 1 }}</td>
							<td>{{ Str::limit($row->title, 20, '...') }}</td>
							<td>{{ $row->view_count }}</td>
							<td>{{ $row->favorite_users_count }}</td>
							<td>{{ $row->comments_count }}</td>
							<td>
								@if ($row->status == 'active' && $row->is_approved == 'true')
								<span class="btn btn-xs btn-success">Published</span>
								@else
								<span class="btn btn-xs btn-danger">Pending..</span>
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>



@endsection