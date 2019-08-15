@extends('layout')

@section('title', 'Neuspešna transakcija')

@section('content')
   <div class="d-flex justify-content-center flex-wrap flex-lg-nowrap no-gutters">
        <div class="col-sm-12 col-lg-6 col-xl-4">

            <div class="col-md-12">
                <div class="pt-5">
                    <div class="pb-3">
                        <h1 class="text-center">
                           Neuspešna transakcija
                        </h1>
                        <p class="text-center pt-4">
                            Plaćanje nije uspešno, vaš račun nije zadužen,
                             najčešći uzrok je pogrešno unet broj kartice, datum isteka ili sigurnosni kod,
                             pokušaje ponovo, u slučaju uzastopnih greški pozovite vašu banku.
                        </p>
                        <p class="text-center pt-4">
                            Ukoliko imate problema prilikom plaćanja preko kartice,
                            kontaktirajte nas ili nam pišite na <a href="mailto:info@gradskisifonjer.rs"  class="strongblue">info@gradskisifonjer.rs</a>.
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
