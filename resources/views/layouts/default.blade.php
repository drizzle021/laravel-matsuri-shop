<!DOCTYPE HTML>
<html>
<head>
    @yield('head')
</head>
<body>
        <header>
            @include('includes.header')
        </header>
        
        @yield('content')

        <footer>
            @include('includes.footer')
        </footer>
</body>
</html>
