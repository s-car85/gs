@if(!auth()->check())
{{-- PRIJAVAA --}}
<div class="remodal" data-remodal-id="prijava"
     data-remodal-options="hashTracking: false" id="login">

    <button data-remodal-action="close" class="remodal-close"></button>
    <h1>Dobrodošli u GŠ</h1>


    <div class="form">

        <form class="form-horizontal" method="POST" action="{{ route('login') }}" autocomplete="off">
            {{ csrf_field() }}

            <div class="form-group no-gutters">
                <div class="col-md-12">
                    <input id="email_l" type="email" placeholder="Email adresa" class="form-control {{ $errors->has('email') ? ' is-invalid login' : '' }} " name="email" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                         </span>
                    @endif
                </div>
            </div>

            <div class="form-group no-gutters">
                <div class="col-md-12">
                    <input id="password2" type="password" placeholder="Lozinka" class="form-control {{ $errors->has('password') ? ' has-error' : '' }} " name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group no-gutters">
                <div class="col-md-12">
                    <button type="submit" class="modal-btn">
                        Prijavi se
                    </button>
                </div>
                <div class="col-md-12  justify-content-center mt-2 modlelink">
                    <a  class="btn btn-link" data-remodal-target="reset" title="Zaboravili ste lozinku?" href="{{ route('password.request') }}">
                        Zaboravili ste password?
                    </a>
                    <a  class="btn btn-link" data-remodal-target="registracija" title=" Registruj se" href="{{ route('password.request') }}">
                        Otvori nalog
                    </a>
                </div>
            </div>
        </form>
    </div>

</div>
{{-- REGISTRACIJA --}}
<div class="remodal" data-remodal-id="registracija"
     data-remodal-options="hashTracking: false">

    <button data-remodal-action="close" class="remodal-close"></button>
    <h1>Kreiraj nalog</h1>


    <div class="form">

        <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}" autocomplete="off">
            @csrf

            <div class="form-row">

                <div class="form-group col">
                    <input id="name" type="text"
                           placeholder="Ime"
                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                           value="{{ old('name') }}" required>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group col">
                    <input id="surname" type="text"
                           placeholder="Prezime"
                           class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname"
                           value="{{ old('surname') }}" required>

                    @if ($errors->has('surname'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>


            <div class="form-group no-gutters">
                <div class="col-md-12">
                    <input  placeholder="Email adresa"
                            id="email_r" type="email"
                           class="form-control{{ $errors->has('email') ? ' is-invalid register' : '' }}" name="email"
                           value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group no-gutters">
                <div class="col-md-12">
                    <input  placeholder="Lozinka"
                            id="password" type="password"
                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                           name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group no-gutters">
                <div class="col-md-12">
                    <input placeholder="Potvrda lozinke"
                            id="password-confirm" type="password" class="form-control"
                           name="password_confirmation" required>
                </div>
            </div>

            <div class="form-group no-gutters">
                <div class="col-md-12">
                    <button type="submit" class="modal-btn">
                        Kreiraj nalog
                    </button>
                </div>
                <div class="col-md-12  justify-content-center mt-2 modlelink">
                    <a  class="btn btn-link" data-remodal-target="prijava" title="Prijava" href="{{ route('password.request') }}">
                        Već imate nalog? Prijavite se
                    </a>
                </div>
            </div>
        </form>
    </div>

</div>
{{--RESET PASSWORD--}}
<div class="remodal" data-remodal-id="reset"
     data-remodal-options="hashTracking: false">

    <button data-remodal-action="close" class="remodal-close"></button>
    <h1>Resetovanje lozinke</h1>


    <div class="form">

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group no-gutters">
                <div class="col-md-12">
                    <input id="email2" placeholder="Email adresa" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                    @endif
                </div>
            </div>

            <div class="form-group no-gutters">
                <div class="col-md-12">
                    <button type="submit" class="modal-btn">
                       Pošalji reset link
                    </button>
                </div>
                <div class="col-md-12  justify-content-center mt-2 modlelink">
                    <a  class="btn btn-link" data-remodal-target="prijava" title=" Registruj se" href="{{ route('login') }}">
                        Vrati se na prijavu
                    </a>
                </div>
            </div>
        </form>
    </div>

</div>
@endif
{{--ZAPOCNI SIVENJE--}}
<div class="remodal" data-remodal-id="pitaj"
     data-remodal-options="hashTracking: false">

    <button data-remodal-action="close" class="remodal-close"></button>
    <h1>Pitaj stilistu</h1>
    <p class="pb-2">Ukoliko imate bilo koja pitanja za naše stiliste,
        možete nam poslati poruku, a mi ćemo Vam odgovoriti.</p>

    <div class="form">

         @if($errors->any())
            <ul class="alert-danger list-unstyled">
                @foreach($errors->all() as $error)
                    <li>* {{ $error }}</li>
                @endforeach
            </ul>
        @endif

         <form class="form-horizontal" method="POST" action="{{ url('kontakt') }}">
            @csrf

            <div class="form-row">
                <div class="form-group col">
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required placeholder="Ime">
                </div>

                <div class="form-group col">
                    <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required placeholder="Prezime">
                </div>
            </div>

            <div class="form-group no-gutters">
                <div class="col-md-12">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Email adresa">
                </div>
            </div>

            <div class="form-group no-gutters">
                <div class="col-md-12">
                <input id="subject" type="text" class="form-control" name="subject" value="{{ old('subject') }}" required placeholder="Tema">
                </div>
            </div>

            <div class="form-group no-gutters">
                <div class="col-md-12">
                    <textarea id="message"  class="form-textarea"  name="message" rows="7" cols="40" required placeholder="Poruka"></textarea>
                </div>
            </div>

            <div class="form-group no-gutters">
                <button type="submit" class="modal-btn">
                    Pošalji
                </button>
            </div>
        </form>
    </div>

</div>
