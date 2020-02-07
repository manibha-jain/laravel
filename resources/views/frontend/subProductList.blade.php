@extends('layouts.frontend.layout')
@section('content')	
<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- ASIDE -->

				<div id="aside" class="col-md-3">
						<!-- aside widget -->
						<div class="aside">
							<h3 class="aside-title">Filter By Price:</h3>
							<div class="slidecontainer">
								<p>min : 1</p>
								<p>max : {{$max_price}}</p>
							  <input type="range" min="1" max="{{$max_price}}" value="" class="slider" id="myRange">
							  <p>Value: <span id="demo"></span></p>
							</div>
						</div>
						<!-- aside widget -->

						<!-- aside widget -->
						@if(count($colors) > 0)
						<div class="aside">
							<h3 class="aside-title">Filter By Color:</h3>
							<ul class="color-option">
								<!-- <li class="active"><a href="#" style="background-color:#BF6989;"></a></li> -->
								@foreach( $colors as $color)
								<li class="form-class filter" data-value="{{$color}}"><a href="#" style="background-color:{{$color}};"></a></li>
								@endforeach
							</ul>
						</div>
						@endif
						<!-- /aside widget -->

						<!-- aside widget -->
						@if(count($sizes) > 0)
						<div class="aside">
							<h3 class="aside-title">Filter By Size:</h3>
							<ul class="size-option">
								@foreach( $sizes as $size)
								<div class="checkbox">
								  <label><input type="checkbox" value="{{$size}}" name="brand">{{$size}}</label>
								</div>
								@endforeach
							</ul>
						</div>
						@endif
					<!-- /aside widget -->

					<!-- aside widget -->
					<div class="aside">
						<h3 class="aside-title">Filter by Brand</h3>
						<div class="checkbox">
						  <label><input type="checkbox" value="Nike" name="brand" class="filter">Nike</label>
						</div>
						<div class="checkbox">
						  <label><input type="checkbox" value="Adidas" name="brand" class="filter">Adidas</label>
						</div>
						<div class="checkbox">
						  <label><input type="checkbox" value="Polo" name="brand" class="filter">Polo</label>
						</div>
						<div class="checkbox">
						  <label><input type="checkbox" value="Lacost" name="brand" class="filter">Lacost</label>
						</div>
					</div>
					<!-- /aside widget -->
					<!-- aside widget -->
					<!-- <div class="aside">
						<h3 class="aside-title">Filter by Gender</h3>
						<ul class="list-links">
							<li class="active"><a href="#">Men</a></li>
							<li><a href="#">Women</a></li>
						</ul>
					</div> -->
					<!-- /aside widget -->

					<!-- aside widget -->
					<div class="aside">
						<h3 class="aside-title">Top Rated Product</h3>
						<!-- widget product -->
						<div class="product product-widget">
							<div class="product-thumb">
								<img src="./img/thumb-product01.jpg" alt="">
							</div>
							<div class="product-body">
								<h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
								<h3 class="product-price">$32.50 <del class="product-old-price">$45.00</del></h3>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o empty"></i>
								</div>
							</div>
						</div>
						<!-- /widget product -->

						<!-- widget product -->
						<div class="product product-widget">
							<div class="product-thumb">
								<img src="./img/thumb-product01.jpg" alt="">
							</div>
							<div class="product-body">
								<h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
								<h3 class="product-price">$32.50</h3>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o empty"></i>
								</div>
							</div>
						</div>
						<!-- /widget product -->
					</div>
					<!-- /aside widget -->
				</div>
				<!-- /ASIDE -->

				<!-- MAIN -->
				<div id="main" class="col-md-9">
					

					<!-- STORE -->
					<div id="store">
						<!-- row -->
						<div class="row">
							<!-- Product Single -->
							@foreach ($products as $product)

							<div class="col-md-4 col-sm-6 col-xs-6">
								<div class="product product-single">
									<div class="product-thumb" style="text-align: center">
										<div class="product-label">
											<span>New</span>
											<span class="sale">-{{$product['discount']}}%</span>
										</div>
										<?php
	      
										    $parameter= Crypt::encrypt($product['id']);
										?>
										<a href="{{url('/product-detail/'.$parameter)}}" class="main-btn quick-view" role="button"><i class="fa fa-search-plus"></i> Quick view</a>
										<img src="{{ url('/thumbnails/'.$product['big_thumbnail']) }}" alt="">
									</div>
									<div class="product-body">
										<h3 class="product-price">{{$product['price']}} <del class="product-old-price">{{$product['compare_price']}}</del></h3>
										<!-- <div class="product-rating">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star-o empty"></i>
										</div> -->
										<h2 class="product-name"><a href="#">{{$product['name']}}</a></h2>
										<div class="product-btns">
											<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
											<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
											<button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
										</div>
									</div>
								</div>
							</div>
							<!-- /Product Single -->

							@endforeach

						</div>
						<!-- /row -->
					</div>
					<!-- /STORE -->

					
				</div>
				<!-- /MAIN -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

	 <script type="text/javascript">
		$(document).ready(function () {
			var slider = document.getElementById("myRange");
			var output = document.getElementById("demo");
			output.innerHTML = slider.value;

			slider.oninput = function() {
			  output.innerHTML = this.value;
			  $('#myRange').val(this.value);
			  filter_product();
			}
		    // $(".js-range-slider").ionRangeSlider({
		    //     min: 100,
		    //      max: "{{$max_price}}",
		    //     from: 550
		    // });

		    $('.form-class').on('click',function(){
		    	if($(this).hasClass('active')){
		    		$(this).removeClass('active')
		    	}else{
		    		$(this).addClass('active')
		    	}
		    });
		    $('.filter').on('click',function(){
		 		filter_product();
		 	});

		 	function filter_product(){
		 		var price = $('#myRange').val();		
		 		var colors =[]; 
		 		var brands = [];		
		 		$.each($("input[name='brand']:checked"), function(){
	                brands.push($(this).val());
	            });

		 		$('.color-option li').each(function(i){
				    if($(this).is('.active')){
				    	colors.push($(this).attr('data-value'));
				    } 
				});
		 		$.ajaxSetup({
				    headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    }
				});
		 		$.ajax({
		 			
				  url: "{{url('filter-subproducts')}}",
				  data: {'price':price,'subcategory_id':"{{$subcategory_id}}",'color':colors,'brands':brands},
				  method: "POST",
				}).done(function() {
				  // $( this ).addClass( "done" );
				});
		 	}
	 	});

	 	

	 </script>
@endsection


	