@extends('layouts.default')
<!doctype html>
<html lang="en">
@section('head')
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$product->name}}</title>
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

 @if (session('failure'))
        <div class="alert alert-danger">
            <ul>
                {{ session('failure') }}
            </ul>
        </div>
@endif

    <div class="product-detail">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12 order-xl-1 order-2">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-3 d-xl-block d-none">
                                <div class="preview-side-bar">
                                    <div class="small-product-preview">
                                        <img class="active" src="{{ asset('products') }}/{{ $product->main_img }}" onclick="changePreviewImage(this)">
                                    </div>
                                    <div class="small-product-preview">
                                        <img src="{{ asset('products') }}/{{ $product->side_img_1 }}" onclick="changePreviewImage(this)">
                                    </div>
                                    <div class="small-product-preview">
                                        <img src="{{ asset('products') }}/{{ $product->side_img_2 }}" onclick="changePreviewImage(this)">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 d-lg-block d-flex mb-5">
                                <div class="large-product-preview">
                                    <img src="{{ asset('products') }}/{{ $product->main_img }}" id="largeProductIMG">
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex d-xl-none mt-5">
                            <div class="col">
                                <div class="row">
                                    <div class="col-2">
                                        <div class="small-product-preview-hor">
                                            <img class="active" src="{{ asset('products') }}/{{ $product->main_img }}" onclick="changePreviewImageHorizontal(this)">
                                        </div>
                                    </div>
                                    <div class="col-2 ml-2">
                                        <div class="small-product-preview-hor">
                                            <img src="{{ asset('products') }}/{{ $product->side_img_1 }}" onclick="changePreviewImageHorizontal(this)">
                                        </div>
                                    </div>
                                    <div class="col-2 ml-2">
                                        <div class="small-product-preview-hor">
                                            <img src="{{ asset('products') }}/{{ $product->side_img_2 }}" onclick="changePreviewImageHorizontal(this)">
                                        </div>
                                    </div>

                                </div>
                               
                            </div>
                            
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 offset-lg-1 order-lg-2 order-1">
                    <div class="container my-lg-5">
                        <div class="row">
                            <div class="product-title">{{ $product->name }}</div>
                            <div class="product-author">{{ $product->author }}</div>
                        </div>
                    </div>
                    <div class="container d-lg-block d-none">
                        <div class="row mb-5">
                            <div class="col-5">
                                <div class="row">
                                    <div class="row d-flex justify-content-center">
                                        <div class="product-price">{{ $product->price }}€</div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        @if($product->stock > 0)
                                            <div class="product-status in-stock">-IN STOCK-</div>
                                        @else
                                            <div class="product-status out-of-stock">-NO STOCK-</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-5">
                                @if($product->discount > 0)
                                    <span class="product-discount">-{{ $product->discount * 100 }}%<br>
                                                    {{ number_format($product->price - $product->price * $product->discount, 2, '.', ',' ) }}€</span>
                                @endif
                            </div>
                        </div>
                        @if ($product->stock > 0)
                            <div class="row my-0 d-flex align-items-center justify-content-center">
                                <div class="col-3">
                                    <form action="{{route('addToCart',['product_id'=>$product->id])}}" id="quantity_form" method="POST" accept-charset="UTF-8">
                                        @csrf
                                        <div class="form-group">
                                            <select name="quantity_select" class="quantity-select" autocomplete="off">
                                                @for($i = 1; $i <= $product->stock && $i <= 5; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
            
                                        </div>
                                    </form>
            
                                </div>
                                <div class="col-7 d-flex justify-content-center">
                                    <button type="submit" form="quantity_form" class="product-add">Add to cart</button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

        </div>
        <div class="container d-lg-none d-block mt-5">
            <div class="row mb-5 d-flex justify-content-center">
                <div class="col-6">
                    <div class="row">
                        <div class="row d-flex justify-content-center">
                            <div class="product-price">{{ $product->price }}€</div>
                        </div>
                        <div class="row d-flex justify-content-center">
                            @if($product->stock > 0)
                                <div class="product-status in-stock">-IN STOCK-</div>
                            @else
                                <div class="product-status out-of-stock">-NO STOCK-</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-5 d-flex justify-content-center">
                    @if($product->discount > 0)
                        <span class="product-discount">-{{ $product->discount * 100 }}%<br>
                                                    {{ number_format($product->price - $product->price * $product->discount, 2, '.', ',' ) }}€</span>
                    @endif
                </div>
            </div>
            @if ($product->stock > 0)
                <div class="row my-0 d-flex align-items-center justify-content-center">
                    <div class="col-3">
                        <form action="{{route('addToCart',['product_id'=>$product->id])}}" id="quantity_form" method="POST" accept-charset="UTF-8">
                            @csrf
                            <div class="form-group">
                                <select name="quantity_select" class="quantity-select" autocomplete="off">
                                    @for($i = 1; $i <= $product->stock && $i <= 5; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>

                            </div>
                        </form>

                    </div>
                    <div class="col-7 d-flex justify-content-center">
                        <button type="submit" form="quantity_form" class="product-add">Add to cart</button>
                    </div>
                </div>
            @endif

        </div>

        <div class="container bg-white">
            <div class="row">
                <div class="product-desc">
                    {{ $product->description }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-10 d-flex justify-content-center d-lg-block">
                    <div class="product-parameters">
                        <ul>
                            <li>Title: {{ $product->name }}</li>
                            @if($product->pages > 0)
                                <li>Pages: {{ $product->pages }}</li>
                            @endif
                            <li>Publisher: {{ $product->publisher }}</li>
                            <li>Dimensions: {{ $product->dimensions }}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-6 offset-1 d-sm-none d-md-block" style="display:none">
                    <div class="image">
                        <img src="/img/Asset 1@4x.png">
                    </div>
                </div>
            </div>
        </div>


        @if(count($recommendations) > 0)
            <div class="container-fluid bg-dark px-0">
                <div class="container product-recommendation">
                    <div>
                        <h2>More like this</h2>
                        <hr>
                    </div>
                    <div class="row">
                        @for($i = 0; $i < count($recommendations); $i++)
                            <div class="col d-flex justify-content-center">
                                <a href="/product/{{ $recommendations[$i]->id }}">
                                    <div class="product">
                                        <div class="product-image">
                                            <img src="{{ asset('products') }}/{{ $recommendations[$i]->main_img }}">
                                        </div>
                                    </div>
                                </a>
                            </div>

                        @endfor

                    </div>
                </div>
            </div>
        @endif


    </div>

@endsection


</body>
</html>
