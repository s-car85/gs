@extends('layout')

@section('title', 'Uspešno ste poručili')

@section('content')
    <section>
        <div class="container d-flex justify-content-center no-gutters">
            <div class="col-sm-12 col-md-10 col-lg-8 col-xl-5">
                <div class="pt-5">
                    <div class="pb-3">
                        <h1 class="text-center">
                            Uspešno ste poručili!
                        </h1>
                        <p class="text-center pt-4">
                            Na vašu e-mail adresu poslata je uplatnica
                            čija uputstva treba da pratite prilokom plaćanja.
                            Nakon evidentirane uplate, porudžbina će biti poslata na Vašu adresu u roku od 7 radnih dana. <br>
                        </p>
                        <p class="text-center">
                            Pratite status Vaše porudžbenice na <br> <strong><a href="{{ url('/status-porudzbenica') }}"
                                                                                class="strongblue">Status porudžbenica</a>,</strong>
                            ako imate nekih pitanja pišite nam na <a href="mailto:info@gradskisifonjer.rs"
                                                                     class="strongblue">info@gradskisifonjer.rs</a>.
                            <br>
                            Hvala što koristite usluge <strong>Gradskog Šifonjera</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection