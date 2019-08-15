@extends('layout')

@section('title', 'Veličine')

@section('content')

    <section>
        <div class="container d-flex justify-content-center no-gutters">
            <div class="col-sm-12 col-md-10 col-lg-8 col-xl-8">

                    <div class="justify-content-center d-flex">
                        <div class="col-sm-12 col-md-10 col-lg-8 col-xl-8">
                            <h1 class="text-center">Veličine</h1>
                            <h3>Size & Fit Information</h3>
                            <ul>
                                <li>
                                    <p>Please notice that this is a guide only and that
                                        measurements may vary according to the style.</p>
                                </li>
                                <li>
                                    <p>If you have any question regarding the size, please
                                        chat with us.</p>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <p>
                        <img src="{{ asset('img/size.jpg') }}" alt="Veličine" class="img-fluid">
                    </p>

            </div>
        </div>
    </section>
@endsection