@extends('layouts.master')
@section('title')
Company information | Admin Panel
@stop
@section('content')
<div class="col-md-12 py-5">
	<div class="row">
		<div class="offset-md-3 col-md-6 col-sm-12 col-xs-12">
			<div class="border border-dark" id="table-box">
				<h5 class="bg-dark text-white p-2">Company Information</h5>

				<div class="p-3">
					@if($errors->any())
					@foreach($errors->all() as $error)
					<p class="alert alert-danger">{{$error}}</p>
					@endforeach
					@endif
					@if(Session::has('msg'))
					<p class="alert alert-success">{{Session::get('msg')}}</p>
					@endif
					<form method="post" action="{{route('addcompanyinfo')}}">
						@csrf
						@foreach($companyinfos as $info)
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label"> Name</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="inputEmail3" placeholder="Company Name" name="name" value="{{$info->name}}">
							</div>
						</div>
						
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
							<div class="col-sm-9">
								<input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="email" value="{{$info->email}}">
							</div>
						</div>
						
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Mobile No.</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="inputEmail3" placeholder="Mobile " name="mobile" value="{{$info->mobile}}">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Address</label>
							<div class="col-sm-9">
								<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="address">{{$info->address}}</textarea>
							</div>
						</div>
						@endforeach
						<button type="submit" class="btn btn-dark offset-md-9 col-3" style="border-radius:0px;">Save</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
	@stop