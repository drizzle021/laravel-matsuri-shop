@extends('layouts.default')

<!DOCTYPE HTML>
<html lang="en">
@section('head')  
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products</title>
    <link rel="icon" href="{{asset('img/logoAssetSmall 1@4x white.png')}}" type="image/icon type">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset("app.css") }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
</head>
@endsection

<body>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@section('content')
@auth  
    @if($auth_user->role == 'ADMIN')
        <!-- Add Product Modal -->
        <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('addProduct') }}" id="add_product_form" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="add-product-category" class="form-label">Category:</label>
                                <select name="category_select" class="category-select" id="add-product-category" autocomplete="off">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="add-product-series" class="form-label">Anime/Manga series:</label>
                                <select name="series_select" class="category-select" id="add-product-series" autocomplete="off">
                                    @foreach ($series as $serie)
                                        <option value="{{ $serie->id }}">
                                            {{ $serie->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="add-product-product-title" class="form-label">Product Title:</label>
                                <input type="text" class="form-control" id="add_product_product_title" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="add-product-author" class="form-label">Author (optional):</label>
                                <input type="text" class="form-control" id="add-product-author" name="author">
                            </div>
                            <div class="form-group">
                                <label for="add-product-pages" class="form-label">Pages (optional):</label>
                                <input type="number" class="form-control" id="add-product-pages" min="0" value="0" name="pages" required>
                            </div>
                            <div class="form-group">
                                <label for="add-product-publisher" class="form-label">Publisher:</label>
                                <input type="text" class="form-control" id="add-product-publisher" name="publisher" required>
                            </div>
                            <div class="form-group">
                                <label for="add-product-dimensions" class="form-label">Dimensions:</label>
                                <input type="text" class="form-control" id="add-product-dimensions" name="dimensions" required>
                            </div>
                            <div class="form-group">
                                <label for="add-product-price" class="form-label">Price:</label>
                                <input type="number" class="form-control" id="add-product-price" min="1" max="5000" step="0.01" value="20" name="price" required>
                            </div>
                            <div class="form-group">
                                <label for="add-product-discount" class="form-label">Discount:</label>
                                <input type="number" class="form-control" id="add-product-discount" min="0" max="1" step="0.01" value="0" name="discount" required>
                            </div>
                            <div class="form-group">
                                <label for="add-product-stock" class="form-label">Stock:</label>
                                <input type="number" class="form-control" id="add-product-stock" min="0" step="1" value="1" name="stock" required>
                            </div>
                            <div class="form-group">
                                <label for="add-product-description" class="form-label">Description:</label>
                                <textarea class="form-control" id="add-product-description" name="description" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="add-product-main-picture" class="form-label">Main image:</label>
                                <input type="file" class="form-control" id="add-product-main-picture" name="main_img" required>
                            </div>
                            <div class="form-group">
                                <label for="add-product-side-picture1" class="form-label">Side image 1:</label>
                                <input type="file" class="form-control" id="add-product-side-picture1" name="side_img_1" required>
                            </div>
                            <div class="form-group">
                                <label for="add-product-side-picture2" class="form-label">Side image 2:</label>
                                <input type="file" class="form-control" id="add-product-side-picture2" name="side_img_2" required>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" form="add_product_form" class="btn btn-primary" onclick="this.form.submit()">Add</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        @section('content')
        <!-- Add Category Modal -->
        <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('addCategory') }}" id="add_category_form" method="POST" accept-charset="UTF-8">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="add-category-title" class="form-label">Category Name:</label>
                                <input type="text" class="form-control" id="add-category-title" name="name" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" form="add_category_form" class="btn btn-primary">Add</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Series Modal -->
        <div class="modal fade" id="addSeriesModal" tabindex="-1" role="dialog" aria-labelledby="addSeriesModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSeriesModalLabel">Add Series</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('addSeries') }}" id="add_series_form" method="POST" accept-charset="UTF-8">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="add-series-title" class="form-label">Series Name:</label>
                                <input type="text" class="form-control" id="add-series-title" name="name" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" form="add_series_form" class="btn btn-primary">Add</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Product Modal -->
        @foreach( $products as $product)
            <div class="modal fade" id="edit{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('editProduct') }}" id="edit_form{{ $product->id }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="edit-product-id" class="form-label">ID:</label>
                                    <input type="text" class="form-control" id="edit-product-id" name="product_id" value="{{ $product->id }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="edit-product-category" class="form-label">Category:</label>
                                    <select name="category_select" class="category-select" id="edit-product-category" autocomplete="off">
                                        @foreach ( $categories as $category)
                                            @if( $category->id == $product->category_id)
                                                <option value="{{ $category->id }}" selected="selected">
                                                    {{ $category->name }}
                                                </option>
                                            @else
                                                <option value="{{ $category->id }}">
                                                    {{ $category->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="edit-product-series" class="form-label">Anime/Manga series:</label>
                                    <select name="series_select" class="category-select" id="edit-product-series" autocomplete="off">
                                        @foreach ( $series as $serie)
                                            @if( $serie->id == $product->series_id)
                                                <option value="{{ $serie->id }}" selected="selected">
                                                    {{ $serie->name }}
                                                </option>
                                            @else
                                                <option value="{{ $serie->id }}">
                                                    {{ $serie->name }}
                                                </option>
                                            @endif

                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="edit-product-product-title" class="form-label">Product Title:</label>
                                    <input type="text" class="form-control" id="edit-product-product-title" value="{{ $product->name }}" name="edit_title">
                                </div>
                                <div class="form-group">
                                    <label for="edit-product-author" class="form-label">Author (optional):</label>
                                    <input type="text" class="form-control" id="edit-product-author" value="{{ $product->author }}" name="edit_author">
                                </div>
                                <div class="form-group">
                                    <label for="edit-product-pages" class="form-label">Pages (optional):</label>
                                    <input type="number" class="form-control" id="edit-product-pages" min="0" value="{{ $product->pages }}" name="edit_pages">
                                </div>
                                <div class="form-group">
                                    <label for="edit-product-publisher" class="form-label">Publisher:</label>
                                    <input type="text" class="form-control" id="edit-product-publisher" value="{{ $product->publisher }}" name="edit_publisher">
                                </div>
                                <div class="form-group">
                                    <label for="edit-product-dimensions" class="form-label">Dimensions:</label>
                                    <input type="text" class="form-control" id="edit-product-dimensions" value="{{ $product->dimensions }}" name="edit_dimensions">
                                </div>
                                <div class="form-group">
                                    <label for="edit-product-price" class="form-label">Price:</label>
                                    <input type="number" class="form-control" id="edit-product-price" min="1" max="5000" step="0.01" value="{{ $product->price }}" name="edit_price">
                                </div>
                                <div class="form-group">
                                    <label for="edit-product-discount" class="form-label">Discount:</label>
                                    <input type="number" class="form-control" id="edit-product-discount" min="0" max="1" step="0.01" value="{{ $product->discount }}" name="edit_discount">
                                </div>
                                <div class="form-group">
                                    <label for="edit-product-stock" class="form-label">Stock:</label>
                                    <input type="number" class="form-control" id="edit-product-stock" min="0" step="1" value="{{$product->stock}}" name="edit_stock" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit-product-description" class="form-label">Description:</label>
                                    <textarea class="form-control" id="edit-product-description" name="edit_description">{{ $product->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="edit-product-main-picture" class="form-label">Main image:</label>
                                    <input type="file" class="form-control" id="edit-product-main-picture" value="{{ $product->main_img }}" name="edit_main_img">
                                </div>
                                <div class="form-group">
                                    <label for="edit-product-side-picture1" class="form-label">Side image 1:</label>
                                    <input type="file" class="form-control" id="edit-product-side-picture1" value="{{ $product->side_img_1 }}" name="edit_side_img_1">
                                </div>
                                <div class="form-group">
                                    <label for="edit-product-side-picture2" class="form-label">Side image 2:</label>
                                    <input type="file" class="form-control" id="edit-product-side-picture2" value="{{ $product->side_img_2 }}" name="edit_side_img_2">
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" form="edit_form{{ $product->id }}" class="btn btn-primary" name="action" value="update">Update</button>
                            <button type="submit" form="edit_form{{ $product->id }}" class="btn btn-primary" name="action" value="delete">Delete</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>


        @endforeach
    @endif
@endauth



@if(session('success'))
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Successfully Added</h5>
                </div>
                <div class="modal-body">
                    {{ session('success') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
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

@if(session('failure'))
    <div class="modal fade" id="failureModal" tabindex="-1" role="dialog" aria-labelledby="failureModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="failureModalLabel">Failure</h5>
                </div>
                <div class="modal-body">
                    {{ session('failure') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            $('#failureModal').modal('show');
        });
    </script>
@endif

@if(session('update'))
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update</h5>
                </div>
                <div class="modal-body">
                    {{ session('update') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            $('#updateModal').modal('show');
        });
    </script>
@endif






<div class="product-list-background">
    <div class="product-list">
        @auth  
            @if($auth_user->role == 'ADMIN')
                <div class="container">
                    <div class="col-10 col-md-10 col-lg-3">
                        <div class="row my-2">
                            <div class="d-flex justify-content-center col px-0 px-md-3 px-lg-4">
                                <button class="add-product-button" type="button" data-toggle="modal" data-target="#addProductModal">ADD PRODUCT</button>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="d-flex justify-content-center col px-0 px-md-3 px-lg-4">
                                <button class="add-category-button" type="button" data-toggle="modal" data-target="#addCategoryModal">ADD CATEGORY</button>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="d-flex justify-content-center col px-0 px-md-3 px-lg-4">
                                <button class="add-series-button" type="button" data-toggle="modal" data-target="#addSeriesModal">ADD SERIES</button>
                            </div>
                        </div>
                    </div>

                </div>
            @endif
        @endauth
        <div class="container">
            <div class="row justify-content-center">
                <div class="d-flex col-10 col-md-10 col-lg-3 justify-content-center px-0 px-md-3 px-lg-4 mx-lg-1">
                    <div class="container-fluid bg-dark product-list-filter-section p-4">
                        <form action="{{ route('searchProduct', ['page'=>0]) }}" method="GET" id="product_list_search" accept-charset="UTF-8">
                            {{ csrf_field() }}

                            <div class="row pb-5 mb-4">
                                <label class="form-label" for="filter-range-price-min">Search: </label>
                                <div class="col-10 mx-0 px-2">
                                    <input class="form-control" type="text" name="search">
                                </div>
                                <div class="col-1 mx-0 px-0">
                                    <button type="submit" class="product-list-search" form="product_list_search"></button>
                                </div>
                            </div>

                        </form>


                        <form action="{{ route('filterProduct', ['page'=>0]) }}" method="GET" id="product_list_filter" accept-charset="UTF-8">
                            {{ csrf_field() }}

                            <div class="row pb-3 justify-content-center">
                                <button type="submit" class="product-list-filter-button" form="product_list_filter">FILTER</button>
                            </div>
                            <div class="row justify-content-center pb-3">
                                <label class="form-label" for="filter-range-price-min">Price from (€):</label>
                                <input type="range" id="filter-range-price-min" name="filter-range-price-min" value="0" min="0" max="300" step="5">
                                <input type="number" id="filter-min-text" value="0" min="0" max="300" step="5" class="form-control" onchange="changeSliderValue(this.value, 'filter-range-price-min')">
                            </div>
                            <div class="row justify-content-center pb-5">
                                <label class="form-label" for="filter-range-price-max">Price to (€):</label>
                                <input type="range" id="filter-range-price-max" name="filter-range-price-max" value="300" min="0" max="300" step="5">
                                <input type="number" id="filter-max-text" value="300" min="0" max="300"  step="5" class="form-control" onchange="changeSliderValue(this.value, 'filter-range-price-max')">
                            </div>
                            <div class="row justify-content-center pb-4">
                                <label for="product-list-order-by" class="form-label">Order By</label>
                                <select name="product-list-order-by" class="category-select" id="product-list-order-by" autocomplete="off">
                                    <option value="az_asc">A-Z: Ascending</option>
                                    <option value="az_desc">A-Z: Descending</option>
                                    <option value="pri_hi_lo">Price: High - Low</option>
                                    <option value="pri_lo_hi">Price: Low - High</option>
                                    <option value="disc_hi_lo">Discount: High - Low</option>
                                </select>
                            </div>
                            <div class="row pb-4">
                                <div class="col">
                                    <button class="navbar-toggler py-4" type="button" data-toggle="collapse" data-target="#category" onclick="switchCollapseElement('category-collapse')">
                                        CATEGORY
                                    </button>
                                </div>

                                <div class="col collapse-element py-3" id="category-collapse">+</div>

                                <div class="collapse navbar-collapse" id="category">
                                    <ul class="navbar-nav ml-auto">
                                        @foreach($categories as $category)
                                            <li class="nav-item">
                                                <input type="checkbox" value="{{ $category->name }}" name="category[]">
                                                <label>{{ $category->name }}</label>
                                            </li>

                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="row pb-4">
                                <div class="col">
                                    <button class="navbar-toggler py-4" type="button" data-toggle="collapse" data-target="#series" onclick="switchCollapseElement('series-collapse')">
                                        SERIES
                                    </button>
                                </div>
                                <div class="col collapse-element py-3" id="series-collapse">+</div>


                                <div class="collapse navbar-collapse " id="series">
                                    <ul class="navbar-nav ml-auto">
                                        @foreach($series as $serie)
                                            <li class="nav-item">
                                                <input type="checkbox" value="{{ $serie->name }}" name="series[]">
                                                <label>{{ $serie->name }}</label>
                                            </li>

                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-8 justify-content-center px-0">
                    <div class="container justify-content-center px-0">
                        <div class="product-list-product-section">
                            @for($i = 0; $i < count($products)/2; $i++)
                                <div class="row">
                                    @for($j = 0; $j < 2; $j++)
                                        @if(2*$i+$j != count($products))
                                        <div class="col">
                                            <div class="product">
                                                <div class="product-menu">
                                                    <p class="product-title">{{ $products[2*$i+$j]->name }}</p>
                                                    <p class="product-author">{{ $products[2*$i+$j]->author }}</p>
                                                    <div class="wrapper">
                                                        <div class="product-desc">
                                                            {{ $products[2*$i+$j]->description }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-5">
                                                            <a href="/product/{{ $products[2*$i+$j]->id }}" class="detail">Detail</a>
                                                        </div>
                                                        <div class="col-5">
                                                            <button class="edit-product-button" type="button" data-toggle="modal" data-target="#edit{{ $products[2*$i+$j]->id }}">Edit</button>
                                                        </div>

                                                    </div>

                                                    <!-- <button class="to-cart">Add to cart</button> -->

                                                </div>
                                                <div class="product-image">
                                                    <img src="{{ asset('products') }}/{{ $products[2*$i+$j]->main_img }}">
                                                </div>

                                                <span class="overlay-cost">{{ $products[2*$i+$j]->price }}€</span>

                                                @if($products[2*$i+$j]->discount > 0)
                                                    <span class="overlay-discount">-{{ $products[2*$i+$j]->discount * 100 }}%<br>
                                                    {{ number_format($products[2*$i+$j]->price - $products[2*$i+$j]->price * $products[2*$i+$j]->discount, 2, '.', ',' ) }}€</span>

                                                @endif



                                            </div>
                                        </div>
                                        @endif
                                    @endfor
                                </div>
                            @endfor

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--https://getbootstrap.com/docs/5.0/components/pagination/-->
<div class="container">
    <div class="row d-flex justify-content-center">
        <ul class="pagination justify-content-center">

            {{-- first page active --}}
            @if($currentPage == 0)
                <li class="page-item active">
                    <a class="page-link" href="/product_list/{{ $currentPage }}
                    {{ isset($search) ? '?search='.$search : '' }}
                    {{ isset($filter_range_price_min) ? '?filter-range-price-min='.$filter_range_price_min : '' }}
                    {{ isset($filter_range_price_max) ? '&filter-range-price-max='.$filter_range_price_max : '' }}
                    {{ isset($product_list_order_by) ? '&product-list-order-by='.$product_list_order_by : '' }}
                    @if(isset($category_filter))
                        @foreach($category_filter as $filter)
                            '&category[]=' {{ $filter }}
                        @endforeach
                    @endif
                    @if(isset($series_filter))
                        @foreach($series_filter as $filter)
                            '&series[]=' {{ $filter }}
                        @endforeach
                    @endif
                    ">{{ $currentPage +1 }}</a></li>

                @if($pageCount > 2)
                    <li class="page-item mx-4">...</li>
                @endif

                @if($pageCount > 1)
                    <li class="page-item">
                        <a class="page-link" href="/product_list/{{ $pageCount-1 }}
                        {{ isset($search) ? '?search='.$search : '' }}
                        {{ isset($filter_range_price_min) ? '?filter-range-price-min='.$filter_range_price_min : '' }}
                        {{ isset($filter_range_price_max) ? '&filter-range-price-max='.$filter_range_price_max : '' }}
                        {{ isset($product_list_order_by) ? '&product-list-order-by='.$product_list_order_by : '' }}
                        @if(isset($category_filter))
                            @foreach($category_filter as $filter)
                                '&category[]=' {{ $filter }}
                            @endforeach
                        @endif
                        @if(isset($series_filter))
                            @foreach($series_filter as $filter)
                                '&series[]=' {{ $filter }}
                            @endforeach
                        @endif
                        ">{{ $pageCount }}</a></li>

                    <li class="page-item">
                        <a class="page-link" href="/product_list/{{ $currentPage +1 }}
                        {{ isset($search) ? '?search='.$search : '' }}
                        {{ isset($filter_range_price_min) ? '?filter-range-price-min='.$filter_range_price_min : '' }}
                        {{ isset($filter_range_price_max) ? '&filter-range-price-max='.$filter_range_price_max : '' }}
                        {{ isset($product_list_order_by) ? '&product-list-order-by='.$product_list_order_by : '' }}
                        @if(isset($category_filter))
                            @foreach($category_filter as $filter)
                                '&category[]=' {{ $filter }}
                            @endforeach
                        @endif
                        @if(isset($series_filter))
                            @foreach($series_filter as $filter)
                                '&series[]=' {{ $filter }}
                            @endforeach
                        @endif" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                @endif

            {{-- middle page active --}}
{{--            @elseif()--}}



            {{-- last page active --}}
            @elseif($currentPage == $pageCount -1 && $pageCount > 1)
                <li class="page-item">
                    <a class="page-link" href="/product_list/{{ $currentPage -1 }}
                    {{ isset($search) ? '?search='.$search : '' }}
                    {{ isset($filter_range_price_min) ? '?filter-range-price-min='.$filter_range_price_min : '' }}
                        {{ isset($filter_range_price_max) ? '&filter-range-price-max='.$filter_range_price_max : '' }}
                        {{ isset($product_list_order_by) ? '&product-list-order-by='.$product_list_order_by : '' }}
                        @if(isset($category_filter))
                            @foreach($category_filter as $filter)
                                '&category[]=' {{ $filter }}
                            @endforeach
                        @endif
                        @if(isset($series_filter))
                            @foreach($series_filter as $filter)
                                '&series[]=' {{ $filter }}
                            @endforeach
                        @endif" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <li class="page-item"><a class="page-link" href="/product_list/0
                    {{ isset($search) ? '?search='.$search : '' }}
                    {{ isset($filter_range_price_min) ? '?filter-range-price-min='.$filter_range_price_min : '' }}
                            {{ isset($filter_range_price_max) ? '&filter-range-price-max='.$filter_range_price_max : '' }}
                            {{ isset($product_list_order_by) ? '&product-list-order-by='.$product_list_order_by : '' }}
                            @if(isset($category_filter))
                                @foreach($category_filter as $filter)
                                    '&category[]=' {{ $filter }}
                                @endforeach
                            @endif
                            @if(isset($series_filter))
                                @foreach($series_filter as $filter)
                                    '&series[]=' {{ $filter }}
                                @endforeach
                            @endif">1</a></li>

                @if($pageCount > 2)
                    <li class="page-item mx-4">...</li>
                @endif

                @if($pageCount > 1)
                    <li class="page-item active"><a class="page-link" href="/product_list/{{ $pageCount-1 }}
                        {{ isset($search) ? '?search='.$search : '' }}
                        {{ isset($filter_range_price_min) ? '?filter-range-price-min='.$filter_range_price_min : '' }}
                            {{ isset($filter_range_price_max) ? '&filter-range-price-max='.$filter_range_price_max : '' }}
                            {{ isset($product_list_order_by) ? '&product-list-order-by='.$product_list_order_by : '' }}
                            @if(isset($category_filter))
                                @foreach($category_filter as $filter)
                                    '&category[]=' {{ $filter }}
                                @endforeach
                            @endif
                            @if(isset($series_filter))
                                @foreach($series_filter as $filter)
                                    '&series[]=' {{ $filter }}
                                @endforeach
                            @endif">{{ $pageCount }}</a></li>

                @endif

            @endif
        </ul>
    </div>
</div>
@endsection




</body>
</html>
