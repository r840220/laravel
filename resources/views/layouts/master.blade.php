<html>
    <head>
        <title>{{ request()->setting['title'] }}</title>
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/sidebar.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/footer.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}"
        @yield('styles')
    </head>
    <body>
        @include('partials.header')
        @include('partials.sidebar')
        @yield('content')
        <script src="{{URL::asset('js/jquery-3.2.1.min.js')}}"></script>
        <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
        <script src="{{URL::asset('js/main.js')}}"></script>
        @yield('scripts')

        @include('partials.footer');
        @if(Session::has('messages'))
        <p style="display:none" id="messages">
            {{ Session::get('messages') }}
        </p>
        @endif
    </body>
</html>