@extends('layouts.master')
@section('title')
Product | Admin Panel
@stop
@section('content')
<div class="col-md-12 py-5">
	<div class="row">
		<div class="col-md-6 col-sm-12 col-xs-12">
			<div class="border border-dark" id="table-box">
				<h5 class="bg-dark text-white p-2">Add New Product</h5>
				<div class="p-3">
					@if($errors->any())
					@foreach($errors->all() as $error)
					<p class="badge badge-danger">{{$error}}</p>
					@endforeach
					@endif
					@if(Session::has('msg'))
					<p class="alert alert-success">{{Session::get('msg')}}</p>
					@endif
					<form method="post" action="{{route('add_product')}}">
						@csrf
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Product Name</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="inputEmail3" placeholder="Product name" name="product_name">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Buy Price(unit)</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="inputEmail3" placeholder="buy price" name="buy_price">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Retail Price</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="inputEmail3" placeholder="Retail" name="retail_price">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Wholesale Price</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="inputEmail3" placeholder="Wholesale" name="wholesale_price">
							</div>
						</div>
						
						<button type="submit" class="btn btn-dark offset-md-9 col-3" style="border-radius:0px;">Submit</button>
					</form>
				</div>
			</div>
		</div>

		<div class="col-md-6 col-sm-12 col-xs-12">
			<div class="border border-dark" id="table-box">
				<h5 class="bg-dark text-white p-2">Change Unit Price of a Product</h5>

				<div class="p-3">
					@if(Session::has('upmsg'))
					<p class="alert alert-success">{{Session::get('upmsg')}}</p>
					@endif
					<form method="post" action="{{route('updatePrice')}}">
						@csrf
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Select Product</label>
							<div class="col-sm-9">
								<select id="proname" name="proid"class="form-control">
									@foreach($productLists as $productList)
									<option value="{{$productList->id}}">{{$productList->product_name}}</option>
									@endforeach
									
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Buy Price(unit)</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="buy" placeholder="buy price" name="buy_price">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Retail Pricce</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="retail" placeholder="Retail" name="Retail">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Wholesale Price</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="wholesale" placeholder="Wholesale" name="Wholesale">
							</div>
						</div>
						<button type="submit" class="btn btn-dark offset-md-9 col-3" style="border-radius:0px;">Update</button>
					</form>
				</div>
			</div>
		</div>
	</div>




	<div class="row pt-5">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="border border-dark" id="table-box">
				<h5 class="bg-dark text-white p-2">Product List</h5>

				<div class="p-3">
					@if(Session::has('delmsg'))
					<p class="badge badge-success">{{Session::get('delmsg')}}</p>
					@endif
					<table class="table table-bordered">
						<thead>
							<tr>
								<th class="font-weight-bold" scope="col">#</th>
								<th class="font-weight-bold" scope="col">Product Name</th>
								<th class="font-weight-bold" scope="col">Buy Price</th>
								<th class="font-weight-bold" scope="col">Retail Price</th>
								<th class="font-weight-bold" scope="col">Wholesale Price</th>
								<th class="font-weight-bold" scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $counter=0;?>
							@foreach($productLists as $productList)
							<?php $counter++;?>
							<tr>
								<th class="font-weight-normal" scope="row">{{$counter}}</th>
								<td>{{$productList->product_name}}</td>
								<td>{{$productList->buy_price}}</td>
								<td>{{$productList->retail_price}}</td>
								<td>
									@if($productList->wholesale_price!=null)

									{{$productList->wholesale_price}}
                                    @else
                                    <p class="badge badge-danger">Not set</p>
                                    @endif
								</td>
								<td>
									<a href="{{route('delete_product',$productList->id)}}" class="btn btn-danger">Delete</a>
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