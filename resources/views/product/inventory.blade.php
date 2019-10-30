@extends('layouts.master')
@section('title')
Inventory Information | Admin Panel
@stop
@section('content')
<div class="col-md-12 py-5">
	<div class="row">
		<div class="col-md-6 col-sm-12 col-xs-12">
			<div class="border border-dark" id="table-box">
				<h5 class="bg-dark text-white p-2">Add Product to Inventory</h5>

				<div class="p-3">
					@if($errors->any())
					@foreach($errors->all() as $error)
					<p class="badge badge-danger">{{$error}}</p>
					@endforeach
					@endif
					@if(Session::has('msg'))
					<p class="badge badge-success">{{Session::get('msg')}}</p>
					@endif
					<form method="post" action="{{route('addInventory')}}">
						@csrf
						
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Select Product</label>
							<div class="col-sm-9">
								<select id="inputState" class="form-control" name="proid">
									@foreach($productLists as $product)
									<option selected value="{{$product->id}}">{{$product->product_name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Quantiy</label>
							<div class="col-sm-9">
								<input type="number" class="form-control" id="inputEmail3" name="last_input">
							</div>
						</div>

						<button type="submit" class="btn btn-dark offset-md-9 col-3" style="border-radius:0px;">Save</button>
					</form>
				</div>
			</div>
		</div>
	</div>




	<div class="row pt-5">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="border border-dark" id="table-box">
				<h5 class="bg-dark text-white p-2">Inventory Information</h5>

				<div class="p-3">
					
					<table class="table table-bordered">
						<thead>
							<tr>
								<th class="font-weight-bold" scope="col">#</th>
								<th class="font-weight-bold" scope="col">Product Name</th>
								<th class="font-weight-bold" scope="col">Remain  Unit</th>
								<th class="font-weight-bold" scope="col">Last Import</th>
								
							</tr>
						</thead>
						<tbody>
							@foreach($inventoryInfo as $inventory)
							<tr>
								<th class="font-weight-normal" scope="row">1</th>
								<td>{{$inventory->product_name}}</td>
								<td>{{$inventory->remain_ammount}}</td>
								<td>{{$inventory->last_input}}</td>
								
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