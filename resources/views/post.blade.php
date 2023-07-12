@extends('layouts.frontend.app')

@section('main_content')

<div class="banner-inner">
</div>
<ol class="breadcrumb">
	<li class="breadcrumb-item">
		<a href="{{ route('category') }}">Home</a>
	</li>
	<li class="breadcrumb-item active">Single</li>
</ol>

<section class="banner-bottom">
	<!--/blog-->
	<div class="container">
		<!---728x90--->

		<div class="row">
			<!--left-->
			<div class="col-lg-8 left-blog-info-w3layouts-agileits text-left">
				<div class="blog-grid-top pb-0">
					<div class="b-grid-top">
						<div class="blog_info_left_grid">
							<a href="{{ route('post.destails', $post->slug) }}">
								<img src="{{ Storage::disk('public')->url('post/'.$post->image) }}" class="img-fluid"
									alt="{{ $post->title }}">
							</a>
						</div>
						<div class="blog-info-middle">
							<ul>
								<li>
									<a href="#">
										<i class="far fa-calendar-alt"></i> {{ $post->created_at->format('d M, Y') }}</a>
								</li>
								<li class="mx-2">
									@guest
									<a href="javascript:void(0)"
										onclick="toastr.info('To add favorite list. You need to login first!', '', { progressBar: true })">
										<i class="far fa-heart"></i> {{ $post->favorite_users->count() }} </a>
									@else
									<a href="{{ route('post.favorite', $post->id) }}"><i
											class="far fa-heart {{ !Auth::user()->favorite_posts->where('pivot.post_id', $post->id)->count() == 0 ? 'fas fa-heart' : '' }}"></i>
										{{ $post->favorite_users->count() }} Favorites </a>
									@endguest

								</li>
								<li class="mx-2">
									<a href="#">
										<i class="fas fa-eye"></i> {{ $post->view_count }} Views</a>
								</li>
								<li>
									<a href="#comments">
										<i class="far fa-comment"></i> {{ $post->comments->count() }} Comments</a>
								</li>

							</ul>
						</div>
					</div>

					<h3>
						<a href="{{ route('post.destails', $post->slug) }}"> {{ $post->title }} </a>
					</h3>
					<p> {!! html_entity_decode($post->body) !!} </p>
				</div>

				<div class="comment-top mt-5" id="comments">
					<h4>Comments {{ $post->comments->count() }} </h4>

					@if ($post->comments->count() <= 0) <p class="text-danger">No Commnet yet. Be the first :)</p>
						@else
						@foreach ($post->comments as $comment)
						<div class="media mt-4">
							<img src="{{ Storage::disk('public')->url('profile/'. $comment->user->image) }}"
								style="width:60px" alt="{{ $comment->user->name }}" class="img-fluid mr-3">
							<div class="media-body">
								<h5 class="mt-0">{{ $comment->user->name }} <span style="font-size: 14px; font-weight: normal"> on {{
										$comment->created_at->diffForHumans() }} </span></h5>
								<p> {{ $comment->message }} </p>
							</div>
						</div>
						@endforeach
						@endif

				</div>

				<div class="comment-top mt-5">
					<h4>Leave a Comment</h4>
					<div class="comment-bottom mt-4">
						@guest
						<form>
							<input class="form-control mb-3" type="text" name="name" placeholder="Name">
							<input class="form-control mb-3" type="email" name="email" placeholder="Email">
							<input class="form-control mb-3" type="text" name="subject" placeholder="Subject">
							<textarea class="form-control mb-3" name="message" placeholder="Message..."></textarea>
							<a class="btn btn-dark px-5" href="{{ route('login') }}">Login</a>
							<p class="text-danger">For post a new comment. You need to login first*</p>
						</form>

						@else
						<form action="{{ route('comment.store', $post->id) }}" method="post">
							@csrf
							<input class="form-control mb-3" type="text" name="name" placeholder="Name" value="{{ old('name') }}">
							<input class="form-control mb-3" type="email" name="email" placeholder="Email" value="{{ old('email') }}">

							<input class="form-control mb-3" type="text" name="subject" placeholder="Subject"
								value="{{ old('subject') }}">

							<textarea class="form-control mb-3" name="message" placeholder="Message..."></textarea>
							<button type="submit" class="btn btn-dark px-5">Submit</button>
						</form>
						@endguest
					</div>
				</div>
			</div>

			<!--//left-->
			<!--right-->
			<aside class="col-lg-4 agileits-w3ls-right-blog-con text-right">
				<div class="right-blog-info text-left">
					<div class="tech-btm">
						<img src="images/banner1.jpg" class="img-fluid" alt="">
					</div>
					<div class="tech-btm">
						<h4>Sign up to our newsletter</h4>
						<p>Pellentesque dui, non felis. Maecenas male </p>
						<form action="#" method="post">
							<input type="email" placeholder="Email" required="">
							<input type="submit" value="Subscribe">
						</form>

					</div>
					<div class="tech-btm">
						<h4>Categories</h4>
						<ul class="single nav">
							@foreach ($categories as $category)
							<li class="nav-list">
								<a class="btn btn-sm btn-info mx-1" href="{{ route('category.post', $category->slug) }}">{{ $category->name }} <span
										class="badge badge-warning badge-pill">{{
										$category->posts->count() }}</span></a>

							</li>
							@endforeach
						</ul>
					</div>
					<div class="tech-btm">
						<h4>Tags</h4>
						<ul class="single nav">
							@foreach ($tags as $tag)
							<li class="nav-list">
								<a class="btn btn-sm btn-primary mx-1" href="{{ route('tag.post', $tag->slug) }}">{{ $tag->name }} <span
										class="badge badge-warning badge-pill">{{
										$tag->posts->count() }}</span></a>
							</li>
							@endforeach
						</ul>
					</div>



					<div class="single-gd tech-btm">
						<h4>Recent Post</h4>


						@foreach ($recentPosts as $recentPost)

						<div class="blog-grids row mb-3 border-bottom pb-3">
							<div class="col-md-5 blog-grid-left">
								<a href="{{ route('post.destails', $recentPost->slug) }}">
									<img src="{{ Storage::disk('public')->url('post/thumbnail/'.$recentPost->image) }}" class="img-fluid"
										alt="{{ $recentPost->title }}" />
								</a>
							</div>
							<div class="col-md-7 blog-grid-right">
								<h5>
									<a href="{{ route('post.destails', $recentPost->slug) }}">{{ $recentPost->title }}</a>
								</h5>
								<div class="sub-meta">
									<span> <i class="far fa-clock"></i> {{ $recentPost->created_at->diffForHumans() }}</span>
								</div>
							</div>
						</div>

						@endforeach


					</div>
				</div>

			</aside>
			<!--//right-->

			<div class="inner-sec border-top pt-5">
				<h4>Recommend by</h4>
				<!--left-->
				<div class="left-blog-info-w3layouts-agileits text-left mt-4">
					<div class="row">

						@foreach ($randomPosts as $randomPost)

						<div class="col-lg-4 card">
							<a href="{{ route('post.destails', $randomPost->slug) }}">
								<img src="{{ Storage::disk('public')->url('post/thumbnail/'. $randomPost->image) }}"
									class="card-img-top img-fluid" alt="{{ $randomPost->title }}">
							</a>
							<div class="card-body">
								<ul class="blog-icons my-4">
									<li>
										<a href="#">
											<i class="far fa-calendar-alt"></i> {{ $randomPost->created_at->format('d M, Y') }}</a>
									</li>
									<li class="mx-2">
										<a href="#">
											<i class="far fa-comment"></i> {{ $post->comments->count() }}</a>
									</li>
									<li>
										<a href="#">
											<i class="fas fa-eye"></i> {{ $post->view_count }}</a>
									</li>

								</ul>
								<h5 class="card-title">
									<a href="{{ route('post.destails', $randomPost->slug) }}">{{ $randomPost->title }}</a>
								</h5>
								<p class="card-text mb-3"> {!! Str::limit(strip_tags($randomPost->body), 70) !!} </p>
								<a href="{{ route('post.destails', $randomPost->slug) }}" class="btn btn-primary read-m">Read More</a>
							</div>
						</div>

						@endforeach
					</div>
					<!--//left-->
				</div>
			</div>

		</div>
	</div>
</section>

@endsection