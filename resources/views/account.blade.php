@extends('layouts.default')
<!DOCTYPE html>
<html lang="en">
@section('head')
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Account</title>
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
<div class="container justify-content-center">
    <div class="row no-margin align-items-center d-flex justify-content-center">
        <h2 class="px-0">YOUR ACCOUNT</h2>
    </div>
</div>

<div class="account-background">
    <div class="account">
        <div class="container-fluid bg-dark account-box">
            <div class="row no-margin">
                <div class="form-container">
                    <form action="{{ route('updateAccount',['user'=> $user->id]) }}" id="update_account_form" method="POST" accept-charset="UTF-8" autocomplete="off">
                        @csrf
                        <div class="row no-margin">

                            <div class="offset-md-1 col-md-4 no-padding">

                                <div class="row form-group">
                                    <h3 class="no-padding"><b>Account overview</b></h3>
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="text" class="form-control" id="email" placeholder="mail@example.com" required minlength="8" value="{{$user->email}}" disabled>
                                </div>

                                <div class="row form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="********" required minlength="8" disabled>
                                </div>

                                <div class="row form-group">
                                    <h3 class="no-padding"><b>Matsuri Points</b></h3>
                                    <div class="matsuri-points">{{$user->matsuri_points}} points</div>
                                </div>
                                <div class="row form-group">
                                    <h3 class="no-padding"><b>Preferred Payment Method</b></h3>
                                    <select class="category-select" id="category" autocomplete="off" name="payment_method">
                                        @foreach ($payment_methods as $method)
                                            @if($method->id == $user->preferred_payment_id)
                                                <option value="{{$method->id}}" selected>{{$method->name}}</option>
                                            @else
                                                <option value="{{$method->id}}">{{$method->name}}</option>
                                            @endif
                                        @endforeach
                                        

                                    </select>

                                </div>

                            </div>

                            {{-- <div class="offset-md-2 col-md-4 offset-md-1 no-padding">
                                <div class="row form-group" id="account-form">
                                    <h3 class="no-padding"><b>Shipping address</b></h3>
                                    <select name="category-select" class="category-select" autocomplete="off">
                                        <option selected>Slovakia</option>
                                        <option>Hungary</option>
                                        <option>Austria</option>
                                        <option>Germany</option>
                                    </select>
                                    <div class="row no-padding no-margin">
                                        <div class="col-md-5 no-padding">
                                            <input type="text" class="form-control" placeholder="First name">
                                        </div>
                                        <div class="col-md-5 no-padding">
                                            <input type="text" class="form-control" placeholder="Last name">
                                        </div>

                                        <div class="row no-padding no-margin">
                                            <input type="text" class="form-control" placeholder="Address">
                                        </div>

                                        <div class="row no-padding no-margin">
                                            <div class="col-md-5 no-padding">
                                                <input type="text" class="form-control" placeholder="Postal code">
                                            </div>
                                            <div class="col-md-5 no-padding">
                                                <input type="text" class="form-control" placeholder="City">
                                            </div>
                                        </div>

                                        <div class="row no-padding no-margin">
                                            <input type="text" class="form-control" placeholder="Phone">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </form>
                </div>
            </div>



            <div class="row d-flex justify-content-center">
                <button type="submit" form="update_account_form" class="update-account-button btn-primary btn-block">UPDATE</button>
            </div>

            
            <div class="row d-flex justify-content-center">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <div class="form-group d-flex justify-content-center">
                        <button onclick="location.href = '{{ route('logout') }}';this.closest('form').submit();" type="button" class="logout-button btn-primary btn-block">LOGOUT</button>
                    </div>
                </form>
                
            </div>
        </div>

    </div>
</div>
@endsection


</body>
</html>
