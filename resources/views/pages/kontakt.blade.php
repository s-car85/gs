@extends('layout')

@section('title', 'Kontakt')

@section('content')
    <section>
        <div class="container d-flex justify-content-center no-gutters">
            <div class="col-sm-12 col-md-10 col-lg-8 col-xl-5">
                <div class="text-center">
                    <h2>KONTAKT</h2>
                    <p><span class="gbolder">Email:</span> <a href="mailto:info@gradskisifonjer.rs" title="Info">info@gradskisifonjer.rs</a></p>
                    <p class="pt-5"><span class="gbolder">Adresa</span> </p>
                    <p>Ul. Suvoborka br. 19, Senjak</p>
                    <p>11000 Beograd, Srbija</p>
                    <p><span class="gbolder">Telefon: <a href="tel:+381692370600" title="Telefon">+381 692370600</a></span></p>
                </div>

                <div class="my-5">
                    <div class="gmap_canvas">
                        <iframe width="100%" height="400px" frameborder="0" style="border:0"
                                src="https://maps.google.com/maps?q=Suvoborka%20br.%2019%20&t=&z=17&ie=UTF8&iwloc=&output=embed"
                                 scrolling="no" marginheight="0" marginwidth="0"></iframe>
                    </div>
                </div>

                @if($errors->any())
                    <ul class="alert-danger list-unstyled">
                        @foreach($errors->all() as $error)
                            <li>* {{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form class="form-horizontal" method="POST" action="{{ url('kontakt') }}">
                    {{ csrf_field() }}
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name" class="control-label">Ime*</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="lastname" class="control-label">Prezime*</label>
                            <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required>
                        </div>
                    </div>

                        <div class="form-group">
                            <label for="email" class="control-label">Email*</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="subject" class="control-label">Tema*</label>
                            <input id="subject" type="text" class="form-control" name="subject" value="{{ old('subject') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="message" class="control-label">Poruka*</label>
                            <textarea id="message"  class="form-textarea"  name="message" rows="7" cols="40" required></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="main-btn">
                                Pošalji
                            </button>
                        </div>


                </form>
            </div>

            </div>
        </div>
    </section>
@endsection