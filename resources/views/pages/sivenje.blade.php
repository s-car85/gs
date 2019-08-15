@extends('layout')

@section('title', 'Šivenje po meri')

@section('style')
    <link href="{{ asset('libs/lightbox2/dist/css/lightbox.css') }}" rel="stylesheet">
@endsection


@section('content')

    <section class="about-section">
        <div style="background-image:url({{ asset('img/white-back.jpg') }});" class="background-holder2"></div>
        <div class="container">
            <div class="text-center">
                <h2>ŠIVENJE PO MERI</h2>
                <p class="pt-3 pb-3">
                    Imate sopstvene zamisli, želje i ideje?
                    Hoćete da budete posebni, po svemu drugačiji? <br class="d-none d-xl-block">Pozovite nas da zajedno šijemo po ukusu i meri!
                </p>
                <div class="text-center">
                    <a href="#" class="main-btn" data-remodal-target="pitaj" title="Pitaj stilistu">ZAPOČNI</a>
                </div>
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