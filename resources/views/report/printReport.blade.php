
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA_Compatible" content="ie=edge">
	<!--bootstrap-->
	<link rel="stylesheet" type="text/css" href="{{asset('public/asset/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/asset/css/all.min.css')}}">
	<!--fontawesome-->
	<link rel="stylesheet" type="text/css" href="{{asset('public/asset/css/fontawesome.min.css')}}">
	<!--customised css file-->
	<link rel="stylesheet" type="text/css" href="{{asset('public/asset/css/style.css')}}">
	<title>Sales Report</title>
</head>

<body>

	<section id="test-site">
		<div class="container">
			<div class="row" style="border-bottom: 1px solid #ccc;">
				<div class="col-12 test-site-heading">
					<h2>Ayon Filling Station</h2>
					<p>Dhaka</p>
					<p>Mobile : 01234456</p>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="serial-no">
						<p>Date : {{$date}}</p>
					</div>
				</div>
				
			</div>
			<div class="row">
				<div class="col-12" id="table">
					<center><h4>Sales Report</h4></center>
					<table style="width:100%">
						<tr>
							<th colspan="4">Retail</th>
						</tr>
						<tr>
							<th>Serial No</th>
							<th>Product Name</th> 
							<th>Quantity</th>
							<th class="text-right pr-2">Amount</th>
						</tr>
						<?php
						$counter=0;
						$totalretails=0;
						?>
						@foreach($retailSales as $retail)
						<?php
						$counter++;
						$totalretails+=($retail->qty*$retail->sellprice);
						?>
						<tr>
							<td>{{$counter}}</td>
							<td>{{$retail->product_name}}</td>
							<td>
								<?php
								if($retail->qty==null){
									$retail->qty=0;
								}
								?>
								{{$retail->qty}}x{{$retail->sellprice}}</td>
								<td class="text-right pr-2">{{$retail->qty*$retail->sellprice}}</td>
							</tr>
							@endforeach

							<tr>
								<td class="text-right pr-2" colspan="3">Total Retail</td>
								<td class="text-right pr-2">{{$totalretails}}</td>
							</tr>
							<tr>
								<th colspan="4">Wholesales</th>
							</tr>
							<tr>
								<th>Serial No</th>
								<th>Product Name</th> 
								<th>Quantity</th>
								<th class="text-right pr-2">Amount</th>
							</tr>
							<?php
							$counter=0;
							$totalws=0;
							?>
							@foreach($wholeSales as $ws)
							<?php
							$counter++;
							$totalws+=($ws->qty*$ws->sellprice);
							?>
							<tr>
								<td>{{$counter}}</td>
								<td>{{$ws->product_name}}</td>
								<td>
									<?php
									if($ws->qty==null){
										$ws->qty=0;
									}
									?>

									{{$ws->qty}}x{{$ws->sellprice}}</td>
									<td class="text-right pr-2">{{$ws->qty*$ws->sellprice}}</td>
								</tr>
								@endforeach

								<tr>
									<td class="text-right pr-2" colspan="3">Total Wholesales</td>
									<td class="text-right pr-2">{{$totalws}}</td>
								</tr>

								<tr>
									<th colspan="4">Expenses</th>
								</tr>
								<tr>
									<th>Serial No</th>
									<th colspan="2">Title</th> 
									<th class="text-right pr-2">Amount</th>
								</tr>
								<?php
								$counter=0;
								$totalex=0;
								?>
								@foreach($expenses as $ex)
								<?php
								$counter++;
								$totalex+=$ex->cost;
								?>
								<tr>
									<td>{{$counter}}</td>
									<td colspan="2">{{$ex->expense}}</td>
									<td class="text-right pr-2 co">{{$ex->cost}}</td>
								</tr>
								@endforeach
								<tr>
									<td class="text-right pr-2" colspan="3">Total Expenses</td>
									<td class="text-right pr-2">{{$totalex}}</td>
								</tr>
								<tr>
									<th colspan="4">Summary</th>
								</tr>
								<tr>
									<th>Serial No</th>
									<th colspan="2">Account</th> 
									<th class="text-right pr-2">Amount</th>
								</tr>
								<tr>
									<td>1</td>
									<td colspan="2">Total sale</td>
									<td class="text-right pr-2">{{$totalws+$totalretails}}</td>
								</tr>
								<tr>
									<td>2</td>
									<td colspan="2">Due</td>
									<td class="text-right pr-2">{{$due}}</td>
								</tr>
								<tr>
									<td>3</td>
									<td colspan="2">Return Due</td>
									<td class="text-right pr-2">{{$return_due}}</td>
								</tr>
								<tr>
									<td>4</td>
									<td colspan="2">Total Expense</td>
									<td class="text-right pr-2">{{$totalex}}</td>
								</tr>
								<tr>
									<td>5</td>
									<td colspan="2">Total Revenue</td>
									<td class="text-right pr-2">{{$total_revenue-$totalex}}</td>
								</tr>
								<tr>

									<td colspan="3"><b>Cash</b></td>
									<td class="text-right pr-2"><b>
										<?php
										$cash=($totalws+$totalretails+$return_due)-($totalex+$due);
										?>

										{{$cash}}
									</b></td>
								</tr>

							</table>
							<div class="row">
								<div class="col-12">
									<p><b>Note:-</b> <span>{{$note}}</span></p>

								</div>

							</div>
						</div>
					</div>
				</div>
			</section>


			<!--js file-->
			<script src="{{asset('public/asset/js/jquery-3.4.1.min.js')}}"></script>
			<script src="{{asset('public/asset/js/popper.min.js')}}"></script>
			<script src="{{asset('public/asset/js/bootstrap.min.js')}}"></script>
			<script src="{{asset('public/asset/js/all.min.js')}}"></script>
			<script src="{{asset('public/asset/js/main.js')}}"></script>
		</body>
		</html>