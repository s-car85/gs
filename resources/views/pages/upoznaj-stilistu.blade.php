@extends('layout')

@section('title', 'GŠ kutija')

@section('style')
    <style>
        .b-lazy {
            -webkit-transition: opacity 500ms ease-in-out;
            -moz-transition: opacity 500ms ease-in-out;
            -o-transition: opacity 500ms ease-in-out;
            transition: opacity 500ms ease-in-out;
            max-width: 100%;
            opacity: 0;
        }
        .b-lazy.b-loaded {
            opacity: 1;
        }
    </style>
@endsection


@section('content')

    <section class="about-section">
        <div style="background-image:url({{ asset('img/white-back.jpg') }});" class="background-holder2"></div>
        <div class="container">
            <div class="text-center">
                <h2>UPOZNAJTE PROFESIONALNOG STILISTU</h2>
                <p>Ne znate šta da obučete, žuri vam se, bliži se vama bitno dnevno ili večernje dešavanje?</p>
                <p><strong>GRADSKI ŠIFONJER je tu!</strong></p>
                 <p>Kontaktirajte nas. Mi ćemo vam na kućnu adresu dostaviti GŠ čarobnu kutiju, <br class="d-none d-xl-block">
                nepogrešivu i besprekornu kombinaciju sa svim što vam je potrebno da zablistate.     </p>
                <p> Biramo samo najbolje a prepuštamo stilisti odluku. Ili, javite nam se ranije slobodno i svratite u <br class="d-none d-xl-block">
                GRADSKI ŠIFONJER da zajedno spakujemo kutiju iznenadjenja kojom ćete obradovati vaše najmilije.     </p>
            </div>
        </div>
    </section>

    <section class="products-section">
        <div class="container">
            <div class="row products-outer">

            <div class="categories-list">

                <nav>
                    <ul>
                        <li class="sub-menu category-item">
                            <a href="javascript:void(0)" class="d-block d-md-none d-sm-flex align-items-center ">
                                <span class="w-100">Kategorije
                                      @foreach($categories as $cat)
                                          @if(request()->segment(2) == str_slug($cat->name))
                                              - {{ $cat->name }}
                                          @endif
                                      @endforeach
                                </span>
                                <i class='fa fa-caret-down right'></i>
                            </a>
                            <ul>
                                
                                @foreach($categories as $cat)
                                    <li class="category-item">
                                        <a class="category-link  @if(request()->segment(2) == str_slug($cat->name)) active @endif" href="{{ url('gs-kutija').'/'.str_slug($cat->name).'/'.$cat->id }}">{{ $cat->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="products-list product-wraper">

                <div class="d-flex flex-wrap justify-content-start">
                    @if(count($products) > 0)
                    @foreach($products as $product)
                        <div class="col-lg-4 col-md-6 col-6   mt-4 pmr0">
                            <a class="row no-gutters" href="{{ url('proizvod').'/'.str_slug($product->name).'/'.$product->id }}">
                                <div class="col-12 overflow-hidden radius-primary" >
                                    <div class="hoverbox">
                                        <div class="row">
                                            <div class="col">
                                                <img class="w-100 b-lazy"  src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ url('upload').'/'.json_decode($product->image, true)[0]['normal'] }}" alt="" >
                                            </div>
                                        </div>
                                        <div class="hoverbox-content hoverbox-background">
                                            <div class="hoverbox-bg d-flex align-items-center justify-content-center h-100">
                                                <img class="w-100 b-lazy"  src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ url('upload').'/'.json_decode($product->image, true)[0]['hover'] }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-center mt-2 product-info">
                                    <h5>{{ $product->name }}</h5>
                                    <h6 class="sale">
                                        <span class="d-inline-block">
                                            {{ number_format($product->price, 2) }} RSD
                                            @if($product->old_price)
                                                <del>{{ number_format($product->old_price, 2) }} RSD</del>
                                            @endif
                                        </span>
                                    </h6>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    @else
                        <div class="col-md-12">
                            <h3>U traženoj kategoriji trenutno nema proizvoda</h3>
                        </div>
                    @endif
                </div>

                {{ $products->render() }}
            </div>
        </div>
        </div>
    </section>
@endsection


@section('scripts')
    <script src="{{ asset('js/blazy.min.js') }}"></script>
    <script>
        ;(function() {
            // Initialize
            var bLazy = new Blazy();
        })();
    </script>
    <script>
        $('.sub-menu ul').hide();
        $(".sub-menu a").click(function () {
            $(this).parent(".sub-menu").children("ul").slideToggle("100");
            $(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
        });
    </script>
@endsection