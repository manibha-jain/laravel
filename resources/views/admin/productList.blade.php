@extends('layouts.admin')
@section('content')	
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header pull-left">Product List</h1>
				<a class="btn btn-primary pull-right" href="{{route('products')}}" role="button" style="margin-top: 20px;">Add Product +</a>
			</div>

		</div><!--/.row-->

		<div class="row">
			@if(Session::has('message'))
				<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
			@endif
			<div class="col-md-10 col-md-offset-1">
				 <table class="table table-striped" id="pro-table">
				    <thead>
				      <tr>
				      	<th>#</th>
				      	<th>Category</th>
				        <th>Name</th>
				        <th>Image</th>
				        <th>Price</th>
				        <th>Quantity</th>
				        <th>Action</th>
				      </tr>
				    </thead>
				    <tbody>

				    	@for ($i = 0; $i < count($products); $i++)
					      <tr>
					      	<td>{{$i+1}}</td>
					      	<td>{{$products[$i]->category}}</td>
					      	<td>{{$products[$i]->name}}</td>
					      	<td><img src="{{ url('/thumbnails/'.$products[$i]->big_thumbnail) }}"></td>
					      	<td>{{$products[$i]->price}}</td>
					      	<td>{{$products[$i]->quantity}}</td>
					      	<?php
	      
							    $parameter= Crypt::encrypt($products[$i]->id);
							?>
					        <td>
					        	<a class="btn btn-primary" href="{{url('variants-form/'.$parameter)}}" role="button" style="margin-bottom: 6px">Add Variant <i class="fa fa-plus"></i></a> 
					        	<a class="btn btn-primary" href="{{url('variants/'.$parameter)}}" role="button" >See Variants <i class="fa fa-eye"></i></a>
					        </td>
					      </tr>
				      @endfor
				    
				    </tbody>
				  </table>
			</div>
		</div><!--/.row-->
	</div>	<!--/.main-->
	
@endsection

