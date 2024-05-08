@extends('layouts.default')
<!DOCTYPE html>
<html lang="en">
    
@section('head')
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout</title>
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
<div class="payment-background">
    <div class="payment">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="container-fluid bg-dark checkout-box">
            <div class="row no-margin">
                <form  action="{{route("sendOrder",["cart"=>$cart_items[0]->cart_id])}}" method="POST" id="sendOrder" accept-charset="UTF-8">
                    @csrf
                    <div class="row no-margin">
                        <div class="col-md-6 no-margin no-padding">
                            <div class="row mb-3 no-margin">
                                <h3 class="checkout-heading no-padding"><b>Contact</b></h3>
                                <label for="email" class="form-label">Email Address</label>
                                @auth
                                    <input name="email" type="text" class="form-control" id="email" placeholder="mail@example.com" required minlength="10" value="{{$user->email}}">
                                @else
                                    <input name="email" type="text" class="form-control" id="email" placeholder="mail@example.com" required minlength="10">
                                @endauth
                            </div>
                            
                            
                            <div class="row no-margin form-group">
                                <h3 class="checkout-heading no-padding"><b>Shipping address</b></h3>
                                <select name="country" class="category-select" autocomplete="off">
                                    <option selected value="slovakia">Slovakia</option>
                                    <option value="hungary">Hungary</option>
                                    <option value="austria">Austria</option>
                                    <option value="germany">Germany</option>
                                </select>
                                <div class="row no-padding no-margin">
                                    <div class="col-md-5 no-padding">
                                        <input name="first_name" type="text" class="form-control" placeholder="First name">
                                    </div>
                                    <div class="col-md-5 no-padding">
                                        <input name="last_name" type="text" class="form-control" placeholder="Last name">
                                    </div>

                                    <div class="row no-padding no-margin">
                                        <input name="address" type="text" class="form-control" placeholder="Address">
                                    </div>

                                    <div class="row no-padding no-margin">
                                        <div class="col-md-5 no-padding">
                                            <input name="zip" type="text" class="form-control" placeholder="ZIP">
                                        </div>
                                        <div class="col-md-5 no-padding">
                                            <input name="city" type="text" class="form-control" placeholder="City">
                                        </div>
                                    </div>

                                    <div class="row no-padding no-margin">
                                        <input name="phone" type="text" class="form-control" placeholder="Phone">

                                    </div>
                                </div>
                            </div>
                            <div class="row no-margin">
                                <h3 class="checkout-heading no-padding"><b>Shipping method</b></h3>
                                <select name="shipping_method" class="category-select" id="shipping_select" onchange="changeShippingField()">
                                    @foreach ($ship_methods as $method)
                                        <option value="{{ $method->id }}">{{ $method->name}} - {{$method->price}}€</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 no-padding no-margin">
                            <h3 class="checkout-heading no-padding"><b>Payment Method</b></h3>
                            <select name="payment_method" class="category-select" id="payment_select" onchange="changePaymentField()">
                                @foreach ($payment_methods as $method)
                                    @auth
                                        @if ($method->id == $user->preferred_payment_id)
                                            <option value="{{ $method->id }}" selected>{{ $method->name}} - {{$method->price}}€</option>
                                        @else
                                            <option value="{{ $method->id }}">{{ $method->name}} - {{$method->price}}€</option>
                                        @endif

                                    @else
                                        <option value="{{ $method->id }}">{{ $method->name}} - {{$method->price}}€</option>
                                    @endauth
                                    
                                    
                                @endforeach
                            </select>

                            @auth
                                @if ($user->matsuri_points > 100)
                                    <div class="row">
                                        <div class="form-check matsuri-points-check mt-5">
                                            <div class="row">
                                                <div class="col">
                                                    <label class="form-check-label" for="matsuri_points">
                                                        Use Matsuri points <div style="display:inline;color:#8C69EF; font-weight:bold;"> ( {{$user->matsuri_points}} )</div>
                                                    </label>
                                                    <input class="form-check-input" type="checkbox" name="points" id="matsuri_points" value="{{$user->matsuri_points}}" onchange="changeDiscount()">
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    
                                @endif
                                
                            @endauth

                            <h3 class="checkout-heading no-padding mt-3"><b>Summary</b></h3>
                            <table style="color:#FFF">
                                <tr><td class="mr-2 p-3"><b>Name</b></td><td><b>Price</b></td><td><b>Quantity</b></td></tr>
                                @foreach ($cart_items as $item)
                                    <tr class="mt-1 py-1"><td class="mr-2 px-3">{{$item->product->name}}</td><td class="mr-2 px-3">{{number_format($item->product->price - $item->product->price*$item->product->discount, 2, '.', ',' )}}€</td> <td>{{$item->quantity}}</td></tr>
                                @endforeach
                                <tr class="mt-1 py-1" id="selected_payment"><td class="mr-2 px-3"></td><td class="mr-2 px-3"></td></tr>
                                <tr class="mt-1 py-1" id="selected_shipping"><td class="mr-2 px-3"></td><td class="mr-2 px-3"></td></tr>
                                
                                @php
                                $sum=0;
                                foreach($cart_items as $item){
                                    $sum = $sum + ($item->product->price - $item->product->price*$item->product->discount)*$item->quantity;
                                }  
                                @endphp
                                <tr class="mt-1 py-1" id="checkout_sum"><td class="mr-2 px-3">Total:</td><td class="mr-2 px-3">{{number_format($sum, 2, '.', ',' )}}€</td></tr>

                                

                            </table>
                            <div class="row mb-5">
                                <div class="row d-flex justify-content-center">
                                    <button type="submit" class="pay-now-button btn-primary btn-block" form="sendOrder">Pay now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

</body>
</html>
