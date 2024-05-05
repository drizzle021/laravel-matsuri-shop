@extends('layouts.default')

<!DOCTYPE html>
<html lang="en">
    
@section('head')
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link rel="icon" href="{{asset('img/logoAssetSmall 1@4x white.png')}}" type="image/icon type">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset("app.css") }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
</head>
@endsection
<body>


@section('content')
<div class="register register-background">
    

    <div class="container create-account">
        <div class="row align-items-center d-flex justify-content-center">
            <h2 class="create-account-text">CREATE ACCOUNT</h2>
        </div>
    
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        

        <div class="row align-items-center d-flex justify-content-center">
            <div class="col-md-5 form-container">
                <form action="{{ route('register') }}" id="register_form" method="POST" accept-charset="UTF-8">
                    {{ csrf_field() }}

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="mail@example.com" value="{{old('email')}}" required minlength="10">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="********" required minlength="8">
                    </div>
                    <div class="mb-3">
                        <label  for="password" class="form-label">Confirm Password</label>
                        <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="********" required minlength="8">
                    </div>

                    <p class="have-account">Already have an account?</p>
                    <p class="login-switch"><a href="{{ route('login') }}">Login</a></p>
                </form>
            </div>

            <div class="col-md-5 create-account-img offset-md-1 d-none d-md-block">
                <img src="{{asset('img/profile_tanjiru.jpg')}}" alt="account">
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <button type="submit" form="register_form" class="create-account-button btn-primary btn-block">REGISTER</button>
        </div>
        

    </div>
</div>
@endsection



</body>
</html>
