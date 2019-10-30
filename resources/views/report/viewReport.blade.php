@extends('layouts.master')
@section('title')
Report| Admin Panel
@stop
@section('content')
<div class="col-md-12 py-5">
	<div class="row">
		<div class="col-md-5 col-sm-12 col-xs-12">
			<div class="border border-dark" id="table-box">
				<h5 class="bg-dark text-white p-2">Generate Report</h5>
				<div class="p-3">
					@if($errors->any())
					@foreach($errors->all() as $error)
					<p class="badge badge-danger">{{$error}}</p>
					@endforeach
					@endif
					@if(Session::has('msg'))
					<p class="alert alert-success">{{Session::get('msg')}}</p>
					@endif
					<form method="post" action="{{route('report')}}">
						@csrf
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Starting Date</label>
							<div class="col-sm-9">
								<input type="date" class="form-control" name="start_date">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Ending Date</label>
							<div class="col-sm-9">
								<input type="date" class="form-control" name="end_date">
							</div>
						</div>
						<button type="submit" class="btn btn-dark offset-md-7 col-5" style="border-radius:0px;">Generate Report</button>
					</form>
				</div>
			</div>
		</div>

		<div class="col-md-7 col-sm-12 col-xs-12">
			<div class="border border-dark" id="table-box">
				<h5 class="bg-dark text-white p-2">Summary</h5>

				<div class="p-3">
					<p class="alert alert-info">Summary report from {{$start}} to {{$end}}</p>
					
					<table class="table table-bordered">
						<thead>
							<tr>
								<th class="font-weight-bold" scope="col">#</th>
								<th class="font-weight-bold" scope="col">Account Name</th>
								<th class="font-weight-bold" scope="col">Amount</th>

							</tr>
						</thead>
						<tbody>

							<tr>
								<td>1</td>
								<td>Sales</td>
								<td>{{$total_sell}}</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Expense</td>
								<td>{{$expense}}</td>
							</tr>
							<tr>
								<td>3</td>
								<td>Due</td>
								<td>{{$due}}</td>
							</tr>
							<tr>
								<td>4</td>
								<td>DueBack</td>
								<td>{{$return_due}}</td>
							</tr>
							<tr>
								<td>5</td>
								<td>Revenue</td>
								<td>{{$total_revenue-$expense}}</td>
							</tr>

							<tr>
								<td colspan="2"><b>Cash</b></td>
								<td>
									<b><?php

									$grandtotal=($return_due+$total_sell)-($expense+$due);
									echo  $grandtotal;
									?></b></td>
								</tr>
							</tbody>
						</table>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop