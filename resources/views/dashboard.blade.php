@extends('layouts.master')
@section('title')
Dashboard
@stop
@section('content')
<div class="col-md-12 py-5">
	<div class="row">
		<div class="offset-md-3 col-md-6 col-sm-12 col-xs-12 p-5" style="box-shadow:0 0 10px .5px gray;">
			<div class="p5">
				<center>
			@foreach($companyinfos as $info)
			<h2>{{$info->name}}</h2>
			<h3>{{$info->email}}</h3>
			<h3>{{$info->mobile}}</h3>
			<p>{{$info->address}}</p>
			@endforeach
			</center>
		     </div>
			</div>
		</div>
	</div>
</div>
@stop
