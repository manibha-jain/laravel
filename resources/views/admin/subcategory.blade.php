@extends('layouts.admin')
@section('content')	
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Subcategory</h1>
			</div>
		</div><!--/.row-->

		<div class="row">
			
			@if(Session::has('message'))
				<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
			@endif
			<div class="col-md-10 col-md-offset-1">
				
				
				<div class="panel panel-default">
					<div class="panel-heading">
						Subcategory Form
						<span class="pull-right panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body">
						<form class="form-horizontal" action="{{route('create_subcategory')}}" method="post">
							{{ csrf_field() }}
							<fieldset>
								<!-- Name input-->
								<div class="form-group">
									<label class="col-md-2 control-label" for="name">Subcategory Name</label>
									<div class="col-md-10">
										<input id="name" name="category" type="text" placeholder="category name" class="form-control" required>
									</div>
								</div>
								<input type="hidden" name="cat_id" value="{{$cat_id}}">
								
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