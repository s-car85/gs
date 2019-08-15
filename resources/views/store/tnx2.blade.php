@extends('layout')

@section('title', 'Hvala na kupovini')

@section('content')
    <section>
        <div class="container d-flex justify-content-center no-gutters">
            <div class="col-sm-12 col-md-10 col-lg-8 col-xl-5">
                <div class="pt-5">
                    <div class="pb-3">
                        <h1 class="text-center">
                           Hvala na kupovini!
                        </h1>
                      <p class="text-center">
                            Pratite status Vaše porudžbenice na <br> <strong><a href="{{ url('/status-porudzbenica') }}"
                                                                                class="strongblue">Status porudžbenica</a>,</strong>
                            <br>
                            ako imate nekih pitanja pišite nam na <a href="mailto:info@gradskisifonjer.rs">info@gradskisifonjer.rs</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection