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
                    
                     <form method="POST" action="{{ route('login') }}" class="form-container">
                        <h1 class="text-center">Login Here!</h1>
                        @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your email">
                         @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                       <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password">
                          @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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