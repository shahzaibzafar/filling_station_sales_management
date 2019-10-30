@extends('layouts.master')
@section('title')
Edit users | Admin Panel
@stop
@section('content')
<div class="col-md-12 py-5">
	<div class="row">
		<div class="offset-md-3 col-md-6 col-sm-12 col-xs-12">
			<div class="border border-primary" id="table-box">
				<h5 class="bg-primary text-white p-2">Edit User info</h5>

				<div class="p-3">
					@if($errors->any())
					@foreach($errors->all() as $error)
					<p class="badge badge-danger">{{$error}}</p>
					@endforeach
					@endif
					@foreach($userinfos as $user)
					<form method="post" action="{{route('updateUser')}}">
						@csrf
						<input type="hidden" name="id" value="{{$user->id}}">
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">First Name</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="inputEmail3" value="{{$user->name}}" name="name">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Last Name</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="inputEmail3" value="{{$user->last_name}}" name="last_name">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
							<div class="col-sm-9">
								<input type="email" class="form-control" id="inputEmail3" value="{{$user->email}}" name="email">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">User Type</label>
							<div class="col-sm-9">
								<select id="inputState" class="form-control" name="type">
									<option selected value="1">Manager</option>
									<option value="0">Admin</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Mobile No.</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="inputEmail3" value="{{$user->mobile}}" name="mobile">
							</div>
						</div>
						<button type="submit" class="btn btn-primary offset-md-9 col-3" style="border-radius:0px;">Update</button>
					</form>
					@endforeach
				</div>
			</div>
		</div>
	</div>

	</div>
	@stop