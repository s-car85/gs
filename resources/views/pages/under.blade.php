<!doctype html>
<html class="no-js" lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title','Tvoj partner u ličnom stilu') - Gradski šifonjer</title>
    <meta name="description" content="@yield('meta-desc','')">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Open Graph -->
    <meta content="website" property="og:type" />
    <meta property="og:title" content="@yield('og-title', 'Gradski šifonjer')">
    <meta property="og:type" content="product">
    <meta property="og:url" content="{{ Request::url() }}">
    <meta property="og:description" content="@yield('og-description', '')">
    <meta property="og:image" content="@yield('og-image', asset('img/fb-share.jpg'))">
    <meta property="og:image:type" content="image/jpg">
    <meta property="og:image:width" content="500">
    <meta property="og:image:height" content="300">

    {{--<!-- Place favicon.ico in the root directory -->--}}
    <link rel="apple-touch-icon" sizes="57x57" href="{{  asset('fav/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{  asset('fav/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{  asset('fav/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{  asset('fav/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{  asset('fav/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{  asset('fav/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{  asset('fav/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{  asset('fav/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{  asset('fav/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{  asset('fav/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{  asset('fav/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{  asset('fav/favicon-16x16.png') }}">
    <link rel="manifest" href="{{  asset('fav/manifest.json') }}">

    <!-- Theme color-->
    {{--<meta name="msapplication-TileColor" content="#02a9b1">--}}
    <meta name="msapplication-TileImage" content="{{  asset('fav/ms-icon-144x144.png') }}">
    {{--<meta name="theme-color" content="#311e59">--}}

    <!-- Custom Theme files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- font-awesome icons -->
    <link href="{{  asset('css/font-awesome.css') }}" rel="stylesheet">
    <!-- //font-awesome icons -->
    <!--fonts-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&amp;subset=latin-ext" rel="stylesheet">
    <!-- Google Analytics -->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-116903045-1', 'auto');
        ga('send', 'pageview');
    </script>
    <!-- End Google Analytics -->

    @yield('style')

    <style>

        h1{
            font-weight: 300;
            color: #fff;
            font-size: 5.5rem;
        }
        main {
            z-index: 100;
        }
        .masthead {
            height: 100vh;
            min-height: 500px;
            background-image: url('img/0.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .banner-dot {
            height: 100vh;
            min-height: 500px;
            background: url('img/dott.png')repeat 0px 0px;
            background-size: 2px;
            -webkit-background-size: 2px;
            -moz-background-size: 2px;
            -o-background-size: 2px;
            -ms-background-size: 2px;
        }
        .logo{
            padding-top: 20px;
            padding-bottom: 20px;
        }
        /*
         * Cover
         */
        .cover {
            padding: 0 1.5rem;
        }
        .cover .btn-lg {
            padding: .75rem 1.25rem;
            font-weight: 700;
        }


        /*
         * Footer
         */
        .mastfoot {
            color: rgba(255, 255, 255, .5);
        }

        /*-- social-icons --*/
        .agileinfo-social-grids{
            z-index: 999;
        }
        .agileinfo-social-grids ul {
            padding: 0;
            margin: 0;
        }
        .agileinfo-social-grids ul li {
            display: inline-block;
            margin: .5em 0.5em;
        }
        .agileinfo-social-grids ul li a {
            color: #FFFFFF;
            text-align: center;
        }
        .agileinfo-social-grids ul li a i.fa.fa-facebook,
        .agileinfo-social-grids ul li a i.fa.fa-instagram,
        .agileinfo-social-grids ul li a i.fa.fa-pinterest{
            height: 38px;
            width: 38px;
            border: 1px solid rgba(255, 255, 255, 0.28);
            line-height: 36px;
            background: none;
            color: #FFFFFF;
            transition: 0.5s all;
            -webkit-transition: 0.5s all;
            -moz-transition: 0.5s all;
            -o-transition: 0.5s all;
            -ms-transition: 0.5s all;
        }
        .agileinfo-social-grids ul li a i.fa.fa-facebook:hover {
            border: solid 1px #3b5998;
            background:#3b5998;
            color: #FFFFFF;
        }
        .agileinfo-social-grids ul li a i.fa.fa-instagram:hover{
            border: solid 1px #bc2a8d;
            background:#bc2a8d;
            color: #FFFFFF;
        }
        .agileinfo-social-grids ul li a i.fa.fa-pinterest:hover{
            border: solid 1px rgb(230, 0, 35);
            background:rgb(230, 0, 35);
            color: #FFFFFF;
        }
        /*-- //social-icons --*/

        @media (min-width: 48em) {
            .masthead-brand {
                float: left;
            }
            .nav-masthead {
                float: right;
            }
        }

        @media (max-width: 760px) {
            h1{
                font-size: 46px;
            }

        }


    </style>

</head>
<body>


<body>
<div class="masthead">
    <div class="banner-dot">
        <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
            <header class="mb-auto"></header>
            <main role="main" class="inner cover ">
                <div class="py-xl-5 d-flex justify-content-center">
                    <h1 class="main-header text-center">Sajt u izradi</h1>
                </div>
                <div class="logo py-xl-3 d-flex justify-content-center">
                    <img src="{{ asset('img/gs-logo.png') }}" alt="Gs Logo" class="img-fluid logo" >
                </div>
            </main>
            <footer class="mt-auto">
                <div class="agileinfo-social-grids d-flex justify-content-center">
                    <ul>
                        <li><a href="https://www.facebook.com/sifonjer1/" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="https://www.instagram.com/gradskisifonjer_store/" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="https://www.pinterest.com/gradskisifonjer/" target="_blank" title="Pinterest"><i class="fa fa-pinterest"></i></a></li>
                    </ul>
                </div>
                <p class="py-3 text-center" style="color: #fff;">
                    © 2019 Gradski šifonjer - Sva prava zadržana.
                </p>
            </footer>
        </div>
    </div>
</div>
</body>

@yield('scripts')
</body>
</html>
