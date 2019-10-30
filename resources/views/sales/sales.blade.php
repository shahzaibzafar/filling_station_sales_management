@extends('layouts.master')
@section('title')
Entry daily sales | Admin Panel
@stop
@section('content')
<style>
	hr{
		margin:2px;
	}
</style>
<form method="post" action="{{route('addDailySales')}}">
	@csrf
	
	<input type="hidden" name="creator" value="{{Auth::user()->id}}">
	<div class="col-md-12 p-4">
		<div class="row border border-dark p-0">
			<h5 class="bg-dark text-white p-2 col-sm-12">Entry daily sales</h5>

			<div class="col-md-6 col-sm-12 col-xs-12 py-3">
				@if($errors->any())
				@foreach($errors->all() as $error)
				<p class="alert alert-danger">{{$error}}</p>
				@endforeach
				@endif
				@if(Session::has('message'))
				<p class="alert alert-{{Session::get('type')}}">{{Session::get('message')}}</p>
				@endif
				<div class="form-group row">
					<label for="inputEmail3" class="col-sm-3 col-form-label">Select Date</label>
					<div class="col-sm-9">
						<input type="date" class="form-control" name="sales_date">
					</div>
				</div>
			</div>
			<div class="offset-md-4 col-md-2 col-sm-12 col-xs-12 py-3">
				<div class="form-group row">
					
					<button class="btn btn-primary" style="border-radius:0px;">Add Daily Sales</button>
				</div>
			</div>

			<div class="col-md-6 col-sm-12 col-xs-12 ">
				<div class="" id="table-box">
					<div class="p-0">
						<h5 class="d-inline">Retail Sales</h5>
						<hr>
					</div>
					<div class="p-0">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th class="font-weight-normal" scope="col">#</th>
									<th class="font-weight-normal" scope="col">Product Name</th>
									<th class="font-weight-normal" scope="col">Unit</th>
									
								</tr>
							</thead>
							<tbody>
								<?php
								$counter=0;
								?>
								@foreach($allproducts as $product)
								<?php
								$counter++;
								?>
								<tr>
									<th class="font-weight-normal" scope="row">{{$counter}}</th>
									<td>{{$product->product_name}}</td>
									<td>
										<input  type="hidden" name="rid[]" value="{{$product->id}}">
										<input  type="hidden" name="rbuy[]" value="{{$product->buy_price}}">
										<input  type="hidden" name="rsell[]" value="{{$product->retail_price}}">
										<input type="number" class="form-control input-sm pull-right" id="inputEmail4" placeholder="0.00" style="text-align:right;" name="rqty[]" step="any">
									</td>
									
								</tr>
								@endforeach

							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="col-md-6 col-sm-12 col-xs-12 ">
				<div class="" id="table-box">
					<div class="p-0">
						<h5 class="d-inline">Wholeales</h5>
						<hr>
					</div>
					<div class="p-0">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th class="font-weight-normal" scope="col">#</th>
									<th class="font-weight-normal" scope="col">Product Name</th>
									<th class="font-weight-normal" scope="col">Unit</th>
									
								</tr>
							</thead>
							<tbody>
								<?php
								$counter=0;
								?>
								@foreach($allproducts as $product)
								@if(!empty($product->wholesale_price))
								<?php
								$counter++;
								?>
								<tr>
									<th class="font-weight-normal" scope="row">{{$counter}}</th>
									<td>{{$product->product_name}}</td>
									<td>
										<input  type="hidden" name="wid[]" value="{{$product->id}}">
										<input  type="hidden" name="wbuy[]" value="{{$product->buy_price}}">
										<input  type="hidden" name="wsell[]" value="{{$product->wholesale_price}}">
										<input type="number" class="form-control input-sm pull-right" id="inputEmail4" placeholder="0.00" style="text-align:right;" name="wqty[]">
									</td>
									
								</tr>
								@endif
								@endforeach

							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<div class="col-md-6 col-sm-12 col-xs-12 pt-5">
				<div class="b" id="table-box">
					<div class="p-2">
						<h5 class="d-inline">Account</h5>
						<hr>
					</div>
					
					<div class="p-3">
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Due</label>
							<div class="col-sm-9">
								<input type="number" class="form-control" id="inputEmail3" placeholder="0.00" name="due" style="text-align:right;">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Return of Due</label>
							<div class="col-sm-9">
								<input type="number" class="form-control" id="inputEmail3" placeholder="0.00" name="return_due" style="text-align:right;">
							</div>
						</div>
					</div>
					<div class="p-2">
						<h5 class="d-inline">Notes</h5>
						<hr>
					</div>
					
					<div class="p-3">
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Notes</label>
							<div class="col-sm-9">
								<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="note"></textarea>
							</div>
						</div>
						
					</div>

				</div>
			</div>

			<div class="col-md-6 col-sm-12 col-xs-12 pt-5">
				<div class="b" id="table-box">
					<div class="p-2">
						<h5 class="d-inline">Expenses</h5>
						<hr>
					</div>
					<div class="col-12 pt-3" style="clear: both;">
						
						<div class="form-row">
							<div class="form-group col-md-5">
								<label for="inputEmail4">Expenses</label>
								<input type="Text" class="form-control" id="inputEmail4" placeholder="Expense " name="expense[]">
							</div>
							<div class="form-group col-md-5">
								<label for="inputPassword4">Cost</label>
								<input type="number" class="form-control" id="inputPassword4" placeholder="0.00" style="text-align:right;" name="cost[]">
							</div>
							<div class="col-md-2">
								<label for="inputextra">Action</label>
								<p class="btn btn-dark btn-block mr-3 addextra" id="inputextra">Add</p>
							</div>
						</div>
						
					</div>
					
					<div class="input_field_wrapper">
						<div>
							
						</div>
					</div>

				</div>
			</div>



		</div>

	</div>
</form>
<div class="col-md-8 col-sm-12 col-xs-12 py-2">
				<div class="border border-dark" id="table-box">
					<div class="p-0">
						<h5 class="bg-dark text-white p-2">Entry List</h5>
						
					</div>
					<div class="col-12 pt-3" style="clear: both;">
						<table class="table table-bordered">
					<thead>
						<tr>
							<th class="font-weight-bold" scope="col">#</th>
							<th class="font-weight-bold" scope="col">Entry Date</th>
							<th class="font-weight-bold" scope="col">Action</th>
							
							
						</tr>
					</thead>
					<tbody>
						<?php $counter=0;?>
                     @foreach($salesentry as $sales)
                     <?php $counter++;?>
						<tr>
							<th class="font-weight-normal" scope="row">{{$counter}}</th>
							<td>{{$sales->salesid}}</td>
							<td>
								<a class="btn btn-danger" href="{{route('delrecord',$sales->salesid)}}">Delete</a>
								<a class="btn btn-info" href="{{route('viewrecord',$sales->salesid)}}">View</a>
							</td>
						</tr>
                        @endforeach
					</tbody>
				</table>
						
						
					</div>
					
					

				</div>
			</div>
@stop