@extends('layouts.admin')
@section('content')	
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header pull-left">Variant List</h1>
				<!-- <a class="btn btn-primary pull-right" href="{{route('products')}}" role="button" style="margin-top: 20px;">Add Product +</a> -->
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
				        <th>Name</th>
				        <th>Image</th>
				        <th>Price</th>
				        <th>Color</th>
				        <th>Quantity</th>
				      </tr>
				    </thead>
				    <tbody>

				    	@for ($i = 0; $i < count($variants); $i++)
					      <tr>
					      	<td>{{$i+1}}</td>
					      	<td>{{$variants[$i]->name}}</td>
					      	<td><img src="{{ url('/thumbnails/'.$variants[$i]->big_thumbnail)}}" style="width: 150px; height: 150px;"></td>
					      	<td>{{$variants[$i]->price}}</td>
					      	<td>{{$variants[$i]->color}}</td>
					      	<td>{{$variants[$i]->quantity}}</td>
					      </tr>
				      @endfor
				    
				    </tbody>
				  </table>
			</div>
		</div><!--/.row-->
	</div>	<!--/.main-->
	
@endsection

