@extends('layouts.master')
@section('title')
Users | Admin Panel
@stop
@section('content')
<div class="col-md-12 py-5">
	<div class="row">
		<div class="col-md-6 col-sm-12 col-xs-12">
			<div class="border border-dark" id="table-box">
				<h5 class="bg-dark text-white p-2">Add New User</h5>

				<div class="p-3">
					@if($errors->any())
					@foreach($errors->all() as $error)
					<p class="alert alert-danger">{{$error}}</p>
					@endforeach
					@endif
					@if(Session::has('msg'))
					<p class="alert alert-success">{{Session::get('msg')}}</p>
					@endif
					<form method="post" action="{{route('addUser')}}">
						@csrf
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">First Name</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="inputEmail3" placeholder="First Name" name="name">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Last Name</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="inputEmail3" placeholder="Last Name" name="last_name">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
							<div class="col-sm-9">
								<input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="email">
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
								<input type="text" class="form-control" id="inputEmail3" placeholder="Mobile " name="mobile">
							</div>
						</div>
						<div class="form-group row">
							<label for="password" class="col-md-3 col-form-label">{{ __('Password') }}</label>

							<div class="col-md-9">
								<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

								@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							<label for="password-confirm" class="col-md-3 col-form-label">{{ __('Confirm Password') }}</label>

							<div class="col-md-9">
								<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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
				<h5 class="bg-dark text-white p-2">Users List</h5>

				<div class="p-3">
					@if(Session::has('delmsg'))
					<p class="alert alert-success">{{Session::get('delmsg')}}</p>
					@endif
					<table class="table table-bordered">
						<thead>
							<tr>
								<th class="font-weight-bold" scope="col">#</th>
								<th class="font-weight-bold" scope="col">Name</th>
								<th class="font-weight-bold" scope="col">Email</th>
								<th class="font-weight-bold" scope="col">Mobile</th>
								<th class="font-weight-bold" scope="col">Type</th>
								<th class="font-weight-bold" scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($users as $user)
							<tr>
								<th class="font-weight-normal" scope="row">1</th>
								<td>{{$user->name}} {{$user->last_name}}</td>
								<td>{{$user->email}}</td>
								<td>{{$user->mobile}}</td>
								<td>
									@if($user->type==0)
									<p class="badge badge-success">Admin</p>
									@else
									<p class="badge badge-info">Manager</p>
									@endif
									<td>
										<a href="{{route('delUser',$user->id)}}" class="btn btn-danger">Delete</a>
										<a href="{{route('editUser',$user->id)}}" class="btn btn-info">Edit</a>
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