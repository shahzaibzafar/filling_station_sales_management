<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA_Compatible" content="ie=edge">
  <!--bootstrap-->
  <link rel="stylesheet" type="text/css" href="{{asset('public/asset/css/bootstrap.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('public/asset/css/all.min.css')}}">
  <!--dropdown plugin-->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('public/asset/css/bootnavbar.css')}}">

  <!--fontawesome-->
  <link rel="stylesheet" type="text/css" href="{{asset('public/asset/css/fontawesome.min.css')}}">
  <!--customised css file-->
  <link rel="stylesheet" type="text/css" href="{{asset('public/asset/css/style.css')}}">
  <title>

   @yield('title')
 </title>
</head>
<body>
	
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="navbar">
    <a class="navbar-brand" href="{{route('home')}}">AYON FILLING STATION</a>
    <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarcoll">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarcoll">
      <ul class="navbar-nav mr-auto">

       <?php
       $type=Auth::user()->type;
       ?>
       @if($type==0)
        <li class="nav-item">
         <a class="nav-link" href="{{route('companyinfo')}}">Company Info</a>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="{{route('users')}}">Users</a>
       </li>
       
       <li class="nav-item">
         <a class="nav-link" href="{{route('products')}}">Products</a>
       </li>
       @endif
       <li class="nav-item">
         <a class="nav-link" href="{{route('sales')}}">Sales</a>
       </li>
       @if($type==0)
       <li class="nav-item">
        <a class="nav-link" href="{{route('inventory')}}">Inventory</a>
      </li>
      <li class="nav-item">
       <a class="nav-link" href="{{route('report')}}">Report</a>
     </li>
     <li class="nav-item">
       <a class="nav-link" href="{{route('printreport')}}">Print Report</a>
     </li>
     @endif
   </ul>
 </div>
</nav>
<!--user-profile--rightpart-->
<div class="user-profile-part">
 <span class="navbar-text">
  <ul class="navbar-nav mr-auto">
   <li class="nav-item dropdown">
     <a class="nav-link" href="#" data-toggle="dropdown" id="user-profile">
      <img src="{{asset('public/asset/image/user.png')}}">
      <ul class="dropdown-menu p-2" id="user-profile-dropdown">
        <li>
          <a class="dropdown-item" href="#">{{Auth::user()->name}}</a>
        </li>
        <li>
          <a href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();" class="dropdown-item">
          Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </li>

    </ul>			     
  </li>
</ul> 
</span>
</div>
<!--table section-->
@yield('content')


<!--js file-->
<script src="{{asset('public/asset/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('public/asset/js/popper.min.js')}}"></script>
<script src="{{asset('public/asset/js/bootstrap.min.js')}}"></script>
<!--dropdown plugin file-->
<script src="{{asset('public/asset/js/bootnavbar.js')}}"></script>
<script src="{{asset('public/asset/js/all.min.js')}}"></script>
<script src="{{asset('public/asset/js/main.js')}}"></script>
<script>
  $(document).ready(function(){
   $("#proname").change(function(){
    var proid=$(this).val();
          //alert(proid);
          $.ajax({
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: "get",
          url: "getProPrice/" + proid, 
          data: "",
          cache: false,
          dataType:'json',
          success:function(data){
            $.each(data,function(index,product_infoObj){
              $("#buy").val(product_infoObj.buy_price);
              $("#retail").val(product_infoObj.retail_price);
              $("#wholesale").val(product_infoObj.wholesale_price);

            })
          },
          error:function(){
            alert("error ase");
          }
        });


        });
 });
</script>
</body>
</html>