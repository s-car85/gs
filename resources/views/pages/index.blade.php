@extends('layout')

@section('title', 'Modna kuća')
@section('og-title', 'Modna kuća')

@section('style')
    <link href="{{ asset('libs/lightbox2/dist/css/lightbox.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div  class="align-items-center background-section">
        <div style="background-image:url({{ asset('img/home-back.jpg') }});" class="background-holder "></div>
        <div class="text-center background-logo d-flex justify-content-center flex-column align-items-center">
            <div class="back-cont">
                {{--<div class="banner-logo">--}}
                   {{-- @include("partials.svg.logo-white", ['class' => 'logo'])--}}
                {{--</div>--}}
                <span class="banner-top">&nbsp;Ovo je</span>  <div class="clearfix"></div>
                <span class="banner-heading">Gradski</span> <div class="clearfix"></div>
                <span class="thin-heading">&nbsp;Šifonjer</span>
                {{--@if(!auth()->check())--}}
                    {{--<div class="text-center background-btn">--}}
                        {{--<a  data-remodal-target="prijava" href="#" title="Prijavi se" class="main-btn2">ZAPOČNI</a>--}}
                    {{--</div>--}}
                {{--@else--}}
                 {{--<div class="text-center background-btn">--}}
                    {{--<a  href="{{ url('/gs-kutija') }}" title="Započni" class="main-btn2">ZAPOČNI</a>--}}
                {{--</div>--}}
                {{--@endif--}}
            </div>
        </div>
    </div>

    <section class="about-section">
        <div style="background-image:url({{ asset('img/white-back.jpg') }}); background-repeat: repeat;" class="background-holder2"></div>
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-center">
                <div class="services">
                    <a href="{{ url('gs-kutija') }}" title="GŠ kutija">
                        <div class="svg-icon">
                            @include('partials.svg.gift')
                        </div>
                        <div class="service-desc">
                           GŠ KUTIJA
                        </div>
                    </a>
                </div>
                <div class="services">
                    <a href="{{ url('sivenje-po-meri') }}" title="Šivenje po meri">
                        <div class="svg-icon">
                            @include('partials.svg.scissors')
                        </div>
                        <div class="service-desc">
                            ŠIVENJE PO MERI
                        </div>
                    </a>
                </div>
                <div class="services">
                    <a href="{{ url('prodavnica') }}" title="Internet prodavnica">
                        <div class="svg-icon">
                            @include('partials.svg.globe')
                        </div>
                        <div class="service-desc">
                            INTERNET PRODAVNICA
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>




    <section class="about-section2">
        <div style="background-image:url({{ asset('img/braon-back.jpg') }});" class="background-holder2"></div>
        <div class="container">
            <div class="text-center">
                <h2>O NAMA</h2>
                <p>
                    Naša prodavnica je prefinjena riznica retkih komada odeće renomiranih dizajnera. <br class="d-none d-xl-block">Po prvi put na ovim prostorima ujedinjena kreativna sila vam poručuje, Neka tvoj stil bude tvoj!
                </p>
                <p>
                    U slučaju da zbog poslovnih obaveza i brzog životnog tempa u gradu nemate vremena da se posvetite svom izgledu, <br class="d-none d-xl-block"> deo našeg stručnog modnog tima će se pobrinuti da zakoračite sigurno na svaki vama bitan predstojeći dogadj jer mi smo GRADSKI ŠIFONJER!
                </p>
            </div>
        </div>
    </section>

    <section>
        <div class="text-center">
            <p>instagram: <a href="https://www.instagram.com/gradskisifonjer_store/" title="Instagram"
                              target="_blank">@gradskisifonjer_store</a></p>
        </div>
    </section>


    @include('partials._gallery')





@endsection

@section('scripts')
    <script src="{{ asset('libs/lightbox2/dist/js/lightbox.js') }}"></script>
    <script>
        lightbox.option({
            "showImageNumberLabel" : false,
            "wrapAround" : true
        })
    </script>
@endsection