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
					<form method="post" action="{{route('printreport')}}">
						@csrf
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Select date</label>
							<div class="col-sm-9">
								<input type="date" class="form-control" name="print_date">
							</div>
						</div>
						
						<button type="submit" class="btn btn-dark offset-md-7 col-5" style="border-radius:0px;">Generate Report</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@stop