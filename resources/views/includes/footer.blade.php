<div class="container">
    <div class="row">
        <div class="col-12 col-md-2">
            <ul>
                <li>ACCOUNT</li>
                @auth
                @else 
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li> 
                @endauth
                
                <li><a href="/shopping_cart">Shopping Cart</a></li>
            </ul>
        </div>
        <div class="col-12 col-md-2">
            <ul>
                <li>Products</li>
                <li><a href="{{route('products',['page'=>0])}}">On-Sale Items</a></li>
                <li><a href="{{route('products',['page'=>0])}}">Manga</a></li>
                <li><a href="{{route('products',['page'=>0])}}">Figures</a></li>
            </ul>
        </div>
        <div class="col-12 col-md-2">
            <ul>
                <li>HELP</li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">About Us</a></li>
            </ul>
        </div>
        <div class="col-1 offset-3 d-md-block d-none">
              <img src="{{asset('img/logoAssetSmall 1@4x.png')}}">
        </div>
    </div>
</div>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}
<script src="{{asset('script.js')}}"></script>
