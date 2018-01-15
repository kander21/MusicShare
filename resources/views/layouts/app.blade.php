<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
            #app{
                min-height:100%;
                position:relative;
            }
            footer{
                opacity: 1;
                background-color: rgba(0,0,0,0.6)
                 bottom: 0;
                 left: 0;
                 right: 0;
                 height: 35px;
                 text-align: center;
                 color: #CCC;
                 position:relative;
                 width:100%; 
             }
             
             footer p {
                 padding: 10.5px;
                 margin: 0px;
                 line-height: 100%;
             }
    </style>
</head>
<body>
    <div id="app">
        @include('inc.navbar');
        <div class="container">
            @include('inc.messages')
            @yield('content')
        </div>
    </div>

    <footer>
            <p style="color:#0a93a6">© 2018<a style="color:#0a93a6; text-decoration:none;" href="#"> Music Share</a>, All rights reserved 2017-2018.</p>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
         CKEDITOR.replace( 'article-ckeditor' );
    </script>
</body>
</html>