@extends('layouts.admin')
@section('content')	
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Add Variants</h1>
			</div>
		</div><!--/.row-->

		<div class="row">
			
			@if(Session::has('message'))
				<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
			@endif
			<div class="col-md-10 col-md-offset-1">
				
				
				<div class="panel panel-default">
					<div class="panel-heading">
						Variant Form
						<span class="pull-right panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body">
						<form class="form-horizontal" action="{{route('create_variant')}}" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
							<fieldset>
								<div class="form-group">
									<label class="col-md-2 control-label" for="name">Variant Name</label>
									<div class="col-md-10">
										<input id="name" name="variant_name" type="text" placeholder="Variant name" class="form-control" required>
									</div>
								</div>
								
								<input type="hidden" name="product_id" value="{{$pro_id}}" readonly="true">
								
								<div class="form-group">
									<label class="col-md-2 control-label" for="name">Color</label>
									<div class="col-md-10">
										<input id="color" name="color" type="color" placeholder="color" class="form-control" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label" for="name">Size</label>
									<div class="col-md-10">
										<input id="size" name="size" type="text" placeholder="size" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label" for="name">Price</label>
									<div class="col-md-10">
										<input id="price" name="price" type="text" placeholder="price" class="form-control" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label" for="name">Compare Price</label>
									<div class="col-md-10">
										<input id="comp_price" name="comp_price" type="text" placeholder="compare price" class="form-control" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label" for="name">Quantity</label>
									<div class="col-md-10">
										<input id="quantity" name="quantity" type="number" placeholder="quantity" class="form-control" required>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-2 control-label" for="name">Main Variant Image</label>
									<div class="col-md-10">
										<input id="Image" name="main_image" type="file" required>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-2 control-label" for="name">Image</label>
									<div class="col-md-10">
										<input id="other_image_as" name="other_images[]" type="file" class="file" multiple="multiple" required>
									</div>
								</div>
							
								
								<!-- Form actions -->
								<div class="form-group">
									<div class="col-md-12 widget-right">
										<button type="submit" class="btn btn-default btn-md pull-right">Submit</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div><!--/.col-->
			
		</div><!--/.row-->
	</div>	<!--/.main-->
	
@endsection

