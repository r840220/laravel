<html>
    <head>
        <title>@yield('title')</title>


        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
        @yield('styles')
    </head>
    <body>
        @include('partials.header')
        @yield('content')
        <script src="{{URL::asset('js/jquery-3.2.1.min.js')}}"></script>
        <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
        @yield('scripts')
    </body>
</html>