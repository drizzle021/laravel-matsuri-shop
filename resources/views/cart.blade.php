@extends('layouts.default')
<!DOCTYPE html>
<html lang="en">
@section('head')
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset("app.css") }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet"></head>
</head>
@endsection


<body class="cart-background">
@section('content')
@if (session('failure'))
    <div class="alert alert-danger">
        <ul>
            {{ session('failure') }}
        </ul>
    </div>
@endif
        <div class="container justify-content-center">
            <div class="row">
                <h2 class="px-0">SHOPPING CART</h2>
            </div>
        </div>
        @if(count($cart_items) == 0)
        <div class="shopping-cart">
            <div class="container">
                        <div class="row align-items-center">
                            <div class="col d-flex justify-content-center">
                                <img class="empty-cart" src="{{asset("img/emptyCart.png")}}" alt="">
                            </div>
                            <div class="col" style="font-weight:bold;color:#FFF;font-size:2rem">
                               <div class="row">
                                <p>
                                    Your cart is empty..
                                </p>
                               </div>
                               <div class="row">
                                <p>
                                Come, take a look at our <a style="color:#8C69EF;text-decoration:underline;font-weight:bold" href="{{route('products',['page'=>0])}}">products</a>
                                </p>
                               </div>
                            </div>
                        </div>
            </div>
        </div>


        @else
            <div class="shopping-cart">
                <div class="container">
                    <div class="cart-items">
                        <div class="container-fluid">
                            @foreach ($cart_items as $item)
                                <div class="cart-item">
                                    <form action="{{route("updateCart",["cart"=>$item->cart_id])}}" method="POST" id="updateCart{{$item->id}}" accept-charset="UTF-8">
                                        @csrf
                                        <input name="cart_item_id" value="{{$item->id}}" hidden></input>
                                        <div class="row d-flex ">
                                            <div class="col-2 d-flex justify-content-center">
                                                <div class="item-image">
                                                    <img src="{{ asset('products') }}/{{ $item->product->main_img }}">
                                                </div>
                                            </div>
                                            <div class="col-4 d-flex align-items-center">
                                                <a href="{{route('productDetail',['product_id'=>$item->product->id])}}">{{$item->product->name}}</a>
                                            </div>
                                            <div class="col-1 d-flex align-items-center">
                                                <div class="row">
                                                    <div class="row my-0"> Amount:</div>
                                                    <div class="row my-0">
                                                        <select name="amount-select" class="amount-select" autocomplete="off" onchange="this.form.submit()">
                                                        @for($i = 1; $i <= $item->product->stock+$item->quantity && $i <= 5; $i++)
                                                            @if ($i == $item->quantity)
                                                                <option value="{{$i}}" selected>{{$i}}</option> {{-- CHANGE CART ITEM QUANTITY ON FIELD CHANGE  --}}
                                                            @else
                                                                <option value="{{$i}}">{{$i}}</option>
                                                            @endif
                                                            
                                                        @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2 d-flex align-items-center">
                                                <div class="row">
                                                    <div class="col-6 d-flex align-items-center">
                                                        <div class="row">
                                                            <div class="row my-0 px-0 mx-1"><b class="no-padding">Price:</b></div>
                                                            <div class="row my-0 px-0 mx-1">{{number_format($item->product->price - $item->product->price*$item->product->discount, 2, '.', ',' )}}€</div>
                                                        </div>

                                                    </div>
                                                    <div class="col-6 d-flex align-items-center">
                                                        <div class="row">
                                                            <div class="row my-0 px-0 mx-1"><b class="no-padding">Subtotal:</b></div>
                                                            <div class="row my-0 px-0 mx-1">{{number_format($item->product->price - $item->product->price*$item->product->discount, 2, '.', ',' )*$item->quantity}}€</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-1 d-flex align-items-center">
                                                <button class="remove" name="action" value="remove">Remove</button>
                                            </div>

                                        </div>
                                    </form>
                                </div> 
                            @endforeach
                            
                        </div>
                    </div>
                </div>

                <div class="container">
                    @php
                        $sum=0;
                        foreach($cart_items as $item){
                            $sum = $sum + ($item->product->price - $item->product->price*$item->product->discount)*$item->quantity;
                        }  
                    @endphp
                    <div class="row d-flex justify-content-center d-lg-block"><p class="total">Item total: {{number_format($sum, 2, '.', ',' )}}€</p></div>
                    <div class="row d-flex justify-content-center d-lg-block">
                        <button type="button" onclick="location.href = '{{route('checkout',['cart'=>$cart_items[0]->cart_id])}}';" class="checkout">Checkout</button>
                    </div>
                </div>


            </div>
        @endif
@endsection




</body>
</html>
