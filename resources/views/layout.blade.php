<!doctype html>
<html class="no-js" lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title','') - Gradski Šifonjer</title>
    <meta name="description" content="@yield('meta-desc','Domaći dizajneri - Haljine - Kupaći kostimi - Stajling - Šivenje po meri - Haljine za trudnice - Haljine za punije - Dizajnerske haljine - Svečane haljine' )">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Open Graph -->
    <meta content="website" property="og:type" />
    <meta property="og:title" content="@yield('og-title', 'Modna kuća') - Gradski šifonjer">
    <meta property="og:type" content="product">
    <meta property="og:url" content="{{ Request::url() }}">
    <meta property="og:description" content="@yield('og-description', 'Domaći dizajneri - Haljine - Kupaći kostimi - Stajling - Šivenje po meri - Haljine za trudnice - Haljine za punije - Dizajnerske haljine - Svečane haljine')">
    <meta property="og:image" content="@yield('og-image', asset('img/fb-share.png'))">
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
    <link rel="icon" type="image/png" sizes="32x32" href="{{  asset('fav/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{  asset('fav/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{  asset('fav/favicon-16x16.png') }}">
    <link rel="manifest" href="{{  asset('fav/manifest.json') }}">

    <!-- Theme color-->
    <meta name="msapplication-TileColor" content="#000">
    <meta name="msapplication-TileImage" content="{{  asset('fav/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#fff">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&amp;subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700&amp;subset=latin-ext" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- All Css -->
    <link rel="stylesheet" href="{{  asset('css/all-min.css') }}">

 <link rel="stylesheet" href="{{  asset('css/toastr.css') }}">
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

</head>
<body>

@include('partials.header')

@yield('content')

@include('partials._footer')

@include('partials._modal')


<div  id="topcontrol" title="Vrati se na početak" style="z-index:1000;position: fixed; bottom: 20px; right: 20px; opacity: 1; cursor: pointer;">
    <div class="to_the_top">
        <div class="fas fa-arrow-up"></div>
        <div class="clearfix"></div>
    </div>
</div>

<!--All jquery -->
<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!--All js -->
{{--<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>--}}
<script src="{{ asset('js/all-min.js') }}"></script>

<!-- start-smooth-scrolling -->
<script>
    // $(document).ready(function ($) {
    //     $(".scroll").click(function (event) {
    //         event.preventDefault();
    //
    //         $('html,body').animate({
    //             scrollTop: $(this.hash).offset().top
    //         }, 1000);
    //     });
    // });

    $(document).ready(function () {
        $().UItoTop({
            containerID: 'topcontrol', // fading element id
            containerHoverID: 'topcontrol', // fading element hover id
            scrollSpeed: 600,
            easingType: 'easeOutQuart'
        });


        @if(request()->get('login'))
        if( {{ request()->get('login') == 1 }} ){
             $('[data-remodal-id=prijava]').remodal().open();
            return;
        }
        @endif


        if($('#email_l:hidden').hasClass('is-invalid') == true){
            $('[data-remodal-id=prijava]').remodal().open();
            return;
        }
        if($('#password:hidden').hasClass('is-invalid') == true){
            $('[data-remodal-id=registracija]').remodal().open();
            return;
        }
    });

    // Hide Cookie Bar on click
    // $("#close-cookie-bar").click(function(){
    //     $('#cookie-container').slideUp("slow");
    //     Cookies.set('cookie-topbar', 0, { expires: 5000 });
    // });
    //
    // // Checking Cookie - if complete hide survey else show survey
    // $(document).ready(function(){
    //     $('#cookie-container').hide();
    //     if (Cookies.get('cookie-topbar') == 0) {
    //         $('#cookie-container').hide();
    //     } else {
    //         $('#cookie-container').show();
    //     }
    // });
</script>

@include('partials._toastr')
@yield('scripts')
</body>
</html>