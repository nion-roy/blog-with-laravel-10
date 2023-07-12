@extends('layouts.frontend.app')

@section('main_content')

<!--/banner-->
<div class="banner">
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
		</ol>
		<div class="carousel-inner" role="listbox">

			@foreach($sliders as $key=>$slider)

			<div class="carousel-item @if($loop->first) active @endif">
				<div class="carousel-caption">
					<h3> {{ $slider->title }} </h3>
					<div class="read">
						<a href="single.html" class="btn btn-primary read-m">Read More</a>
					</div>
				</div>
			</div>


			@endforeach

		</div>
		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
</div>
<!--/model-->
<!--//banner-->
<!---728x90--->

<!---728x90--->
<!--/main-->
<section class="main-content-w3layouts-agileits">
	<div class="container">
		<div class="row">
			<!--left-->
			<div class="col-lg-8 left-blog-info-w3layouts-agileits text-left">
				<div class="blog-girds-sec">
					<div class="row border-bottom">

						@foreach ($posts as $post)

						<div class="col-lg-6 card">
							<a href="{{ route('post.destails', $post->slug) }}">
								<img src="{{ Storage::disk('public')->url('post/thumbnail/'. $post->image) }}"
									class="card-img-top img-fluid" alt="{{ $post->title }}">
							</a>
							<div class="card-body">
								<ul class="blog-icons my-4">
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
											{{ $post->favorite_users->count() }} </a>
										{{-- <form id="favorite-form-{{ $post->id }}" action="{{ route('post.favorite', $post->id) }}"
											method="post" style="display: none">
											@csrf
										</form> --}}
										@endguest
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
									<a href="{{ route('post.destails', $post->slug) }}">{{ $post->title }}</a>
								</h5>
								<p class="card-text mb-3"> {!! Str::limit(strip_tags($post->body), 70) !!} </p>
							</div>
						</div>

						@endforeach

					</div>

					<div class="read text-center">
						<a href="{{ route('category') }}" class="btn btn-primary read-m">Read More</a>
					</div>

				</div>
			</div>
			<!--//left-->
			<!--right-->
			<aside class="col-lg-4 agileits-w3ls-right-blog-con text-right">
				<div class="right-blog-info text-left">

					<div class="tech-btm">
						<img src="{{ asset('frontend') }}/images/banner1.jpg" class="img-fluid" alt="">
					</div>
					<div class="tech-btm">
						<h4>Sign up to our newsletter</h4>
						<p>Pellentesque dui, non felis. Maecenas male </p>
						<form action="{{ route('subscriber.store') }}" method="post">
							@csrf
							<input type="email" placeholder="Email" name="email">
							<input type="submit" value="Subscribe">
						</form>

					</div>

					<div class="tech-btm">
						<h4>Recent Posts</h4>

						@foreach ($recentPosts as $recentPost)

						<div class="blog-grids row mb-3 border-bottom pb-3">
							<div class="col-md-5 blog-grid-left">
								<a href="{{ route('post.destails', $post->slug) }}">
									<img src="{{ Storage::disk('public')->url('post/thumbnail/'.$recentPost->image) }}" class="img-fluid"
										alt="{{ $recentPost->title }}" />
								</a>
							</div>
							<div class="col-md-7 blog-grid-right">
								<h5>
									<a href="{{ route('post.destails', $post->slug) }}">{{ $recentPost->title }}</a>
								</h5>
								<div class="sub-meta">
									<span> <i class="far fa-clock"></i> {{ $recentPost->created_at->format('d M, Y') }}</span>
								</div>
							</div>
						</div>

						@endforeach

					</div>
				</div>
			</aside>
			<!--//right-->
		</div>
	</div>
</section>
<!--//main-->

@endsection