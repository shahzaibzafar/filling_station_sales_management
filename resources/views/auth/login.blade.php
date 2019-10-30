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
    <title>Login</title>
</head>
<body class="form-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12"></div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <form class="form-container">
                    <h1 class="text-center">Login Here!</h1>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email address">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter your password">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Keep me sign in</label>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Login</button>
                </form>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12"></div>
        </div>
    </div>



    <!--js file-->
    <script src="{{asset('public/asset/js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('public/asset/js/popper.min.js')}}"></script>
    <script src="{{asset('public/asset/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/asset/js/all.min.js')}}"></script>
    <script src="{{asset('public/asset/js/main.js')}}"></script>
</body>
</html>