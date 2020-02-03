@extends('layouts.frontend.layout')
@section('content')	
	<!-- HOME -->
	<div id="home">
		<!-- container -->
		<div class="container">
			<!-- home wrap -->
			<div class="home-wrap">
				<!-- home slick -->
				<div id="home-slick">
					<!-- banner -->
					<div class="banner banner-1">
						<img src="{{asset('img/banner01.jpg')}}" alt="">
						<div class="banner-caption text-center">
							<h1>Bags sale</h1>
							<h3 class="white-color font-weak">Up to 50% Discount</h3>
							<button class="primary-btn">Shop Now</button>
						</div>
					</div>
					<!-- /banner -->

					<!-- banner -->
					<div class="banner banner-1">
						<img src="{{asset('img/banner02.jpg')}}" alt="">
						<div class="banner-caption">
							<h1 class="primary-color">HOT DEAL<br><span class="white-color font-weak">Up to 50% OFF</span></h1>
							<button class="primary-btn">Shop Now</button>
						</div>
					</div>
					<!-- /banner -->

					<!-- banner -->
					<div class="banner banner-1">
						<img src="{{asset('img/banner03.jpg')}}" alt="">
						<div class="banner-caption">
							<h1 class="white-color">New Product <span>Collection</span></h1>
							<button class="primary-btn">Shop Now</button>
						</div>
					</div>
					<!-- /banner -->
				</div>
				<!-- /home slick -->
			</div>
			<!-- /home wrap -->
		</div>
		<!-- /container -->
	</div>
	<!-- /HOME -->

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- banner -->
				@for ($i = 0; $i < count($new_pro); $i++)
					<?php
	      
					    $parameter= Crypt::encrypt($new_pro[$i]->id);
					?>
				<div class="col-md-4 col-sm-6" style="text-align: center">
					<a class="banner-1" href="{{url('/product-detail/'.$parameter)}}" >
						<img src="{{ url('/thumbnails/'.$new_pro[$i]->big_thumbnail) }}" alt="">
						<div class="banner-caption text-center">
							<!-- <h2 class="white-color">NEW COLLECTION</h2> -->
						</div>
					</a>
				</div>
				 @endfor
				<!-- /banner -->

			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- section-title -->
				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title">Deals Of The Day</h2>
						<div class="pull-right">
							<div class="product-slick-dots-1 custom-dots"></div>
						</div>
					</div>
				</div>
				<!-- /section-title -->

				<!-- banner -->
				<!-- <div class="col-md-3 col-sm-6 col-xs-6">
					<div class="banner banner-2">
						<img src="{{asset('img/banner14.jpg')}}" alt="">
						<div class="banner-caption">
							<h2 class="white-color">NEW<br>COLLECTION</h2>
							<button class="primary-btn">Shop Now</button>
						</div>
					</div>
				</div> -->
				<!-- /banner -->

				<!-- Product Slick -->
				<div class="col-md-12 col-sm-6 col-xs-6" >
					<div class="row">
						<div id="product-slick-1" class="product-slick custom-styling">
							@for ($i = 0; $i < count($top_deals); $i++)
							<!-- Product Single -->
							<div class="col-md-3 col-sm-6 col-xs-6">
								<div class="product product-single">
									<div class="product-thumb" style="text-align: center;">
										<div class="product-label">
											<span class="sale">-{{$top_deals[$i]->discount}}%</span>
										</div>
										<!-- <ul class="product-countdown">
											<li><span>00 H</span></li>
											<li><span>00 M</span></li>
											<li><span>00 S</span></li>
										</ul> -->
										<?php
	      
										    $parameter= Crypt::encrypt($top_deals[$i]->id);
										?>
										<a href="{{url('/product-detail/'.$parameter)}}" class="main-btn quick-view" role="button"><i class="fa fa-search-plus"></i> Quick view</a>
										<img src="{{ url('/thumbnails/'.$top_deals[$i]->big_thumbnail) }}" alt="">
									</div>
									<div class="product-body">
										<h3 class="product-price">${{$top_deals[$i]->price}} <del class="product-old-price">${{$top_deals[$i]->compare_price}}</del></h3>
										<!-- <div class="product-rating">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star-o empty"></i>
										</div> -->
										<h2 class="product-name"><a href="{{url('/product-detail/'.$parameter)}}">{{$top_deals[$i]->name}}</a></h2>
										<div class="product-btns">
											<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
											<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
											<button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
										</div>
									</div>
								</div>
							</div>
							<!-- /Product Single -->

							@endfor
						</div>
					</div>
				</div>
				<!-- /Product Slick -->
			</div>
			<!-- /row -->

			
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

	<!-- section -->
	<div class="section section-grey">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- banner -->
				<div class="col-md-8">
					<div class="banner banner-1">
						<img src="{{asset('img/banner13.jpg')}}" alt="">
						<div class="banner-caption text-center">
							<h1 class="primary-color">HOT DEAL<br><span class="white-color font-weak">Up to 50% OFF</span></h1>
							<button class="primary-btn">Shop Now</button>
						</div>
					</div>
				</div>
				<!-- /banner -->

				<!-- banner -->
				<div class="col-md-4 col-sm-6">
					<a class="banner banner-1" href="#">
						<img src="{{asset('img/banner11.jpg')}}" alt="">
						<div class="banner-caption text-center">
							<h2 class="white-color">NEW COLLECTION</h2>
						</div>
					</a>
				</div>
				<!-- /banner -->

				<!-- banner -->
				<div class="col-md-4 col-sm-6">
					<a class="banner banner-1" href="#">
						<img src="{{asset('img/banner12.jpg')}}" alt="">
						<div class="banner-caption text-center">
							<h2 class="white-color">NEW COLLECTION</h2>
						</div>
					</a>
				</div>
				<!-- /banner -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title">Latest Products</h2>
					</div>
				</div>
				<!-- section title -->

				@for ($i = 0; $i < count($latest_pro); $i++)

				<!-- Product Single -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="product product-single">
						<div class="product-thumb" style="text-align: center;">
							<div class="product-label">
								<span>New</span>
								<!-- <span class="sale">-20%</span> -->
							</div>
							<?php
	      
							    $parameter= Crypt::encrypt($latest_pro[$i]->id);
							?>
							<!-- <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button> -->
							
							<img src="{{ url('/thumbnails/'.$latest_pro[$i]->big_thumbnail) }}">
						</div>
						<div class="product-body">
							<h3 class="product-price">${{$latest_pro[$i]->price}} <del class="product-old-price">${{$latest_pro[$i]->compare_price}}</del></h3>
							<!-- <div class="product-rating">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star-o empty"></i>
							</div> -->
							<h2 class="product-name"><a href="{{url('/product-detail/'.$parameter)}}">{{$latest_pro[$i]->name}}</a></h2>
							<div class="product-btns">
								<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
								<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
								<button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
							</div>
						</div>
					</div>
				</div>
				<!-- /Product Single -->
				@endfor

				
			</div>
			<!-- /row -->

			<!-- row -->
			<div class="row">
				<!-- banner -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="banner banner-2">
						<img src="./img/banner15.jpg" alt="">
						<div class="banner-caption">
							<h2 class="white-color">NEW<br>COLLECTION</h2>
							<button class="primary-btn">Shop Now</button>
						</div>
					</div>
				</div>
				<!-- /banner -->
				@for ($i = 0; $i < count($women_deals); $i++)
					<!-- Product Single -->
					<div class="col-md-3 col-sm-6 col-xs-6" style="text-align: center">
						<div class="product product-single">
							<div class="product-thumb">
								<div class="product-label">
									<span>New</span>
									<span class="sale">-{{$women_deals[$i]->discount}}%</span>
								</div>
								<?php
								    $parameter= Crypt::encrypt($women_deals[$i]->id);
								?>
								<a href="{{url('/product-detail/'.$parameter)}}" class="main-btn quick-view" role="button"><i class="fa fa-search-plus"></i> Quick view</a>
								<img src="{{ url('/thumbnails/'.$women_deals[$i]->big_thumbnail) }}" alt="">
							</div>
							<div class="product-body">
								<h3 class="product-price">${{$women_deals[$i]->price}} <del class="product-old-price">${{$women_deals[$i]->compare_price}}</del></h3>
								<!-- <div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o empty"></i>
								</div> -->
								<h2 class="product-name"><a href="{{url('/product-detail/'.$parameter)}}">{{$women_deals[$i]->name}}</a></h2>
								<div class="product-btns">
									<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
									<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
									<button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
								</div>
							</div>
						</div>
					</div>
					<!-- /Product Single -->
				@endfor
				
			</div>
			<!-- /row -->

			
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

@endsection
