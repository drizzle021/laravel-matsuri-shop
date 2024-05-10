@extends('layouts.default')
<!doctype html>
<html lang="en">

@section('head')
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
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

@if(session('success'))
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Successful Order</h5>
                </div>
                <div class="modal-body">
                    {{ session('success') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#successModal').modal('hide');">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            $('#successModal').modal('show');
        });
    </script>
@endif

<div class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="hero-text">
                    <h1 class="hero-heading"><span>MANGA, FIGURES, ANIME MERCH</span></h1>
                    <p class="hero-subheading">All in one place</p>
                </div>
            </div>

        </div>
        <div class="row">
            @auth
            
            @else
            <button type="button" class="register-button" onclick="location.href = '{{ route('register') }}';">
                REGISTER NOW </button>
            @endauth
            
        </div>
    </div>
</div>

<div class="home">
    <div class="container-fluid bg-dark px-0">
        <div class="container px-0">
            <div class="row">
                <div class="col px-0  d-flex justify-content-center">
                    <a href="{{url('/products/list?filter-range-price-min=0&filter-range-price-max=300&product-list-order-by=disc_hi_lo')}}">
                        <div class="category">
                            <div class="category-image">
                                <img src="img/on_sale_icon.png">
                            </div>
                            <div class="category-name">
                                ON-SALE ITEMS
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col px-0  d-flex justify-content-center">
                    <a href="{{url('/products/list?filter-range-price-min=0&filter-range-price-max=300&product-list-order-by=az_asc&category%5B%5D=Figure')}}">
                        <div class="category">
                            <div class="category-image">
                                <img src="img/figures_category.jpg">
                            </div>
                            <div class="category-name">
                                FIGURES FOR YOUR COLLECTION
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col px-0  d-flex justify-content-center">
                    <a href="{{url('/products/list?filter-range-price-min=0&filter-range-price-max=300&product-list-order-by=az_asc&category%5B%5D=Manga')}}">
                        <div class="category">
                            <div class="category-image">
                                <img src="img/manga_category.jpg">
                            </div>
                            <div class="category-name">
                                DISCOVER MANGA
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection



</body>
</html>
