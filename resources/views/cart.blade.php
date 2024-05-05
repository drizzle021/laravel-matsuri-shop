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
                                <div class="row d-flex ">
                                    <div class="col-2 d-flex justify-content-center">
                                        <div class="item-image">
                                            <img src="img/mem.jpg">
                                        </div>
                                    </div>
                                    <div class="col-4 d-flex align-items-center">
                                        <a href="{{route("productDetail",['product_id'=>$item->product_id])}}">{{App\Models\Product::where('id',$item->product_id)->first()->name}}</a>
                                    </div>
                                    <div class="col-1 d-flex align-items-center">
                                        <div class="row">
                                            <div class="row my-0"> Amount:</div>
                                            <div class="row my-0"><select name="amount-select" class="amount-select" autocomplete="off">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option selected>5</option>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 d-flex align-items-center">
                                        <div class="row">
                                            <div class="col-6 d-flex align-items-center">
                                                <div class="row">
                                                    <div class="row my-0 px-0 mx-1"><b class="no-padding">Price:</b></div>
                                                    <div class="row my-0 px-0 mx-1">26.99€</div>
                                                </div>

                                            </div>
                                            <div class="col-6 d-flex align-items-center">
                                                <div class="row">
                                                    <div class="row my-0 px-0 mx-1"><b class="no-padding">Subtotal:</b></div>
                                                    <div class="row my-0 px-0 mx-1">134.95€</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1 d-flex align-items-center">
                                        <button class="remove">Remove</button>
                                    </div>

                                </div>
                            </div> 
                            @endforeach
                            
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row d-flex justify-content-center d-lg-block"><p class="total">Item total: 4119.94€</p></div>
                    <div class="row d-flex justify-content-center d-lg-block"><button class="checkout">Checkout</button></div>
                </div>


            </div>
        @endif
@endsection




</body>
</html>
