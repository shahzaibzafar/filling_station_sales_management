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

	
	
	<div class="col-md-12 p-4">
		<div class="row border border-dark p-0">
			<h5 class="bg-dark text-white p-2 col-sm-12">Daily sales Entry -{{$date}}</h5>

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
								@foreach($retailSales as $retail)
								<?php
								$counter++;
								?>
								<tr>
									<th class="font-weight-normal" scope="row">{{$counter}}</th>
									<td>{{$retail->product_name}}</td>
									<td>
										{{$retail->qty}}
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
									<th class="font-weight-normal" scope="col">Expense</th>
									<th class="font-weight-normal" scope="col">Ammount</th>
									
								</tr>
							</thead>
							<tbody>
								<?php
								$counter=0;
								?>
								@foreach($wholeSales as $ws)
								
								<?php
								$counter++;
								?>
								<tr>
									<th class="font-weight-normal" scope="row">{{$counter}}</th>
									<td>{{$ws->product_name}}</td>
									<td>
										{{$ws->qty}}
									</td>
									
								</tr>
								
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
								<input type="number" class="form-control" id="inputEmail3" placeholder="0.00" name="due" style="text-align:right;" value="{{$due}}" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Return of Due</label>
							<div class="col-sm-9">
								<input type="number" class="form-control" id="inputEmail3" placeholder="0.00" name="return_due" style="text-align:right;" value="{{$return_due}}" readonly>
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
								<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="note" readonly>{{$note}}</textarea>
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
						
						<table class="table table-bordered">
							<thead>
								<tr>
									<th class="font-weight-normal" scope="col">#</th>
									<th class="font-weight-normal" scope="col">Expense</th>
									<th class="font-weight-normal" scope="col">Amount</th>
									
								</tr>
							</thead>
							<tbody>
								<?php
								$counter=0;
								?>
								@foreach($expenses as $ex)
								
								<?php
								$counter++;
								?>
								<tr>
									<th class="font-weight-normal" scope="row">{{$counter}}</th>
									<td>{{$ex->expense}}</td>
									<td>
										{{$ex->cost}}
									</td>
									
								</tr>
								
								@endforeach

							</tbody>
						</table>
						
					</div>
					
					

				</div>
			</div>



		</div>

	</div>


@stop