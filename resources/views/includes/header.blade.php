
    
    
    
    <nav class="navbar navbar-expand-md navbar-white bg-white">
        <div class="container">
            <a class="navbar-brand d-none d-lg-block" href="{{url('/')}}">
                <img src="{{asset('img/logoAsset 1@4x.png')}}" alt="Logo">
            </a>

            <a class="navbar-brand d-block d-lg-none" href="{{url('/')}}">
                <img class="small-logo" src="{{asset('img/logoAssetSmall 1@4x.png')}}" alt="Logo">
            </a>


            <ul class="navbar-nav d-none d-lg-block">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('products', ['page'=>1])}}">PRODUCTS</a>
                </li>
            </ul>

            <div class="flex-grow-1"></div>

            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto d-lg-none">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('products',['page'=>1])}}">PRODUCTS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('cart')}}">CART</a>
                    </li>
                    <li class="nav-item">
                        @auth
                                    <a 
                                        class="nav-link"
                                        href="{{route('account',['user'=>Auth::user()->id])}}">
                                        ACCOUNT
                                    </a>
                        @else
                                    <a 
                                        class="nav-link"
                                        href="{{ route('login') }}">
                                        ACCOUNT
                                    </a>
                        @endauth
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">CONTACT</a>
                    </li>

                </ul>
            </div>


            <ul class="navbar-nav d-none d-lg-block">
                <li class="nav-item">
                    <a class="nav-link" href="/cart">CART</a>
                </li>
                <li class="nav-item">
                    @auth
                                <a 
                                    class="nav-link"
                                    href="{{route('account',['user'=>Auth::user()->id])}}">
                                    ACCOUNT
                                </a>
                        @else
                                    <a 
                                        class="nav-link"
                                        href="{{ route('login') }}">
                                        ACCOUNT
                                    </a>
                        @endauth
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">CONTACT</a>
                </li>

            </ul>
        </div>
    </nav>