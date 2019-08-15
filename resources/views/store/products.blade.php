@extends('layout')

@foreach($categories as $cat)
    @if(request()->segment(2) == str_slug($cat->name))
        @section('title', ucfirst(strtolower($cat->name)))
        @section('og-title', ucfirst(strtolower($cat->name)))
        @section('meta-desc', substr($cat->description,0 , 160))
        @section('og-description', substr($cat->description,0 , 160))
    @endif
@endforeach


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

                    @if(request()->segment(2) == '')
                    <h2>INTERNET PRODAVNICA</h2>
                    @else
                        @foreach($categories as $cat)
                            @if(request()->segment(2) == str_slug($cat->name))
                                <h2>{{ $cat->name }}</h2>
                                <p>{!! nl2br($cat->description) !!}</p>
                            @endif
                        @endforeach
                    @endif

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
                                            <a class="category-link  @if(request()->segment(2) == str_slug($cat->name)) active @endif" href="{{ url('prodavnica').'/'.str_slug($cat->name).'/'.$cat->id }}">{{ $cat->name }}</a>
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
                                <div class="col-lg-4 col-md-6 col-6  mt-4 pmr0">
                                    <a class="row no-gutters" href="{{ url('proizvod').'/'.str_slug($product->name).'/'.$product->id }}">
                                        <div class="col-12 overflow-hidden radius-primary" >
                                            <div class="hoverbox">
                                                <div class="row">
                                                    <div class="col">
                                                        <img class="w-100 b-lazy"  src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="  data-src="{{ url('upload').'/'.json_decode($product->image, true)[0]['normal'] }}" alt="{{ $product->name }}" >
                                                    </div>
                                                </div>
                                                <div class="hoverbox-content hoverbox-background">
                                                    <div class="hoverbox-bg d-flex align-items-center justify-content-center h-100">
                                                        <img class="w-100 b-lazy"  src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="  data-src="{{ url('upload').'/'.json_decode($product->image, true)[0]['hover'] }}" alt="">
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
        $('.sub-menu ul').hide();
        $(".sub-menu a").click(function () {
            $(this).parent(".sub-menu").children("ul").slideToggle("100");
            $(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
        });
    </script>
    <script>
        ;(function() {
            // Initialize
            var bLazy = new Blazy();
        })();
    </script>
@endsection