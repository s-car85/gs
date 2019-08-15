@extends('layout')

@section('title', 'Prodavnica')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/owl.theme.default.min.css') }}">
    <style>
        .owl-carousel .owl-nav{
            position: absolute;
            top: 45%;
            z-index: -1;
            width: 110%;
        }
        .owl-carousel .owl-prev{
            float:left;

        }
        .owl-carousel .owl-prev span {
            font-size: 48px;
            z-index: 10;
        }
        .owl-carousel .owl-next{
            float:right;
        }
        .owl-carousel .owl-next span {
            font-size: 48px;
            z-index: 10;
        }
    </style>
@endsection

@section('content')

    {{--<section class="about-section">--}}
        {{--<div style="background-image:url({{ asset('img/white-back.jpg') }});" class="background-holder2"></div>--}}
        {{--<div class="container">--}}
            {{--<div class="text-center">--}}
                {{--<h2>--}}
                    {{--@if(request()->segment(2) == '')--}}
                        {{--INTERNET PRODAVNICA--}}
                    {{--@else--}}
                        {{--@foreach($categories as $cat)--}}
                            {{--@if(request()->segment(2) == str_slug($cat->name))--}}
                                 {{--{{ $cat->name }}--}}
                            {{--@endif--}}
                        {{--@endforeach--}}
                    {{--@endif--}}
                {{--</h2>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}

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


                    <div class="d-flex flex-wrap justify-content-center">
                        <div class="col-md-6 col-12 pmr0 mb-5">
                            <div class="owl-carousel mt-4 d-flex justify-content-center">

                                @if($sliders->count() > 0)
                                    @foreach($sliders as $slider)

                                        <div class="col-12 overflow-hidden radius-primary " >
                                            <div class="hoverbox">
                                                <div class="row">
                                                    <div class="col">
                                                        <img class="img-fluid d-block mx-auto" src="{{ asset($slider->path) }}" alt="{{ $slider->title }}" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                @endif

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $(".owl-carousel").owlCarousel( {
                nav:true,
                autoplay:true,
                autoplayTimeout:5000,
                autoHeight:true,
                autoplayHoverPause:true,
                center: true,
                items:1,
                loop:true,
                margin:10
                }
            );
        });
        $('.sub-menu ul').hide();
        $(".sub-menu a").click(function () {
            $(this).parent(".sub-menu").children("ul").slideToggle("100");
            $(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
        });
    </script>
@endsection