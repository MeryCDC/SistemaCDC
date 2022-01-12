<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link href="{{ asset('icons/mdi/css/materialdesignicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('icons/mdi/css/materialdesignicons.min.css.map') }}" rel="stylesheet">
    <title>{{ config('app.name', 'Laravel') }}</title> 
</head>

<body>
    <div class="container-scroller">
        @yield('content')
    </div>
<script src="{{ asset('js/jquery.min.js') }}"></script>
</body>
</html>

