<footer>
    <div class="footer-inner">
        <div class="container">
            <div class="d-flex flex-wrap">
                
                <div class="footer-links">
                    <div class="footer-heading">O Nama</div>
                    <a href="{{ url('uslovi-koriscenja') }}" class="flink" title="Uslovi Korišćenja">Uslovi Korišćenja</a>
                    {{--<a href="{{ url('politika-privatnosti') }}" class="flink" title="Politika Privatnosti">Politika Privatnosti</a>--}}
                    <a href="{{ url('kontakt') }}" class="flink" title="Kontakt">Kontakt</a>
                </div>
                <div class="footer-links">
                    <div class="footer-heading">Usluge</div>
                    <a href="{{ url('gs-kutija') }}" class="flink" title="GŠ Kutija">GŠ Kutija</a>
                    <a href="{{ url('sivenje-po-meri') }}" class="flink" title="Šivenje po meri">Šivenje po meri</a>
                    <a href="{{ url('prodavnica') }}" class="flink" title="Internet Prodavnica">Internet Prodavnica</a>
                    {{--<a href="{{ url('dostava-povracaj') }}" class="flink" title="Dostava + Povraćaj">Dostava + Povraćaj</a>--}}
                    {{--<a href="{{ url('velicine') }}" class="flink" title="Veličine">Veličine</a>--}}
                </div>
                <div class="footer-links">
                    <div class="footer-heading">Mreže</div>
                    <a href="{{ url('https://www.facebook.com/sifonjer1/') }}" class="flink" target="_blank" title="Facebook">Facebook</a>
                    <a href="{{ url('https://www.instagram.com/gradskisifonjer_store/') }}" class="flink" target="_blank" title="Insagram">Insagram</a>
                    <a href="{{ url('https://www.pinterest.com/gradskisifonjer/') }}" class="flink" target="_blank" title="Pinterest">Pinterest</a>
                </div>


                <div class="d-sm-flex flex-fill d-block">
                    <div class="footer-register">
                        @if(!auth()->check())
                        <h3>registruj se</h3>
                        <form method="POST" action="{{ route('register') }}" >
                            @csrf
                            <div class="form-group">
                                        <input type="text"
                           placeholder="Ime"
                           class="form-control fi {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                           value="{{ old('name') }}" required>
                            </div>
                            <div class="form-group">
                                             <input id="surname" type="text"
                           placeholder="Prezime"
                           class="form-control fi{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname"
                           value="{{ old('surname') }}" required>
                            </div>
                            <div class="form-group">
                                       <input  placeholder="Email adresa"
                             type="email"
                           class="form-control fi {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                           value="{{ old('email') }}" required>
                            </div>
                            <div class="form-group">
                                    <input  placeholder="Lozinka"
                            type="password"
                           class="form-control fi {{ $errors->has('password') ? ' is-invalid' : '' }}"
                           name="password" required>
                            </div>
                            <div class="form-group">
                                         <input placeholder="Potvrda lozinke"
                            type="password" class="form-control fi"
                           name="password_confirmation" required>
                            </div>
                            <div class="form-group">
                                <div class="mt-4"><button type="submit" class="main-btn">Kreiraj nalog</button></div>
                            </div>
                        </form>
                        @endif
                    </div>
                    <div class="mla">
                        <div class="footer-links fr">
                            <div class="footer-heading">Kontakt Adresa</div>
                            <p class="ftext">Ul. Suvoborka br. 19, Senjak</p>
                            <p class="ftext">11000 Beograd, Srbija</p>
                            <p class="ftext"><span class="d-inline">Email: <a href="mailto:info@gradskisifonjer.rs" title="Email adresa">info@gradskisifonjer.rs</a></span></p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="text-center payment-card">


                <div class="item">
                    <div class="img-wrapper">
                        <a href="https://www.maestrocard.com/gateway/index.html" target="_blank" title="Maestro">
                            <img src="{{ asset('img/kartice/ms_acc_opt_70_1x.png') }}" class="img-responsive" alt="Maestro" nopin = "nopin">
                        </a>
                    </div>
                </div>


                <div class="item">
                    <div class="img-wrapper">
                        <a href="https://www.mastercard.us/en-us.html" target="_blank" title="Master">
                            <img src="{{ asset('img/kartice/mc_acc_opt_70_1x.png') }}" class="img-responsive" alt="Master" nopin = "nopin">
                        </a>
                    </div>
                </div>


                <div class="item">
                    <div class="img-wrapper">
                        <a href="https://www.americanexpress.com/" target="_blank" title="Amex">
                            <img src="{{ asset('img/kartice/Logotip-American-Express.png') }}" class="img-responsive" alt="Amex" nopin = "nopin">
                        </a>
                    </div>
                </div>


                <div class="item">
                    <div class="img-wrapper">
                        <a href="https://rs.visa.com/" target="_blank" title="Visa">
                            <img src="{{ asset('img/kartice/visa_pos_fc.png') }}" class="img-responsive" alt="Visa" nopin = "nopin">
                        </a>
                    </div>
                </div>


                <div class="item">
                    <div class="img-wrapper">
                        <a href="https://www.bancaintesa.rs" target="_blank" title="Bankaintesa">
                            <img src="{{ asset('img/kartice/bancaIntesa.png') }}" class="img-responsive" alt="Bankaintesa" nopin = "nopin">
                        </a>
                    </div>
                </div>


                <div class="item">
                    <div class="img-wrapper">
                        <a href="https://www.mastercard.com/rs/consumer/credit-cards.html" target="_blank" title="Master Card secured">
                            <img src="{{ asset('img/kartice/masterCardSC.png') }}" class="img-responsive" alt="Master Card secured" nopin = "nopin">
                        </a>
                    </div>
                </div>


                <div class="item">
                    <div class="img-wrapper">
                        <a href="https://rs.visa.com/pay-with-visa/security-and-assistance/protected-everywhere.html" target="_blank" title="Verifited by Visa">
                            <img src="{{ asset('img/kartice/verifiedbyvisa.png') }}" class="img-responsive" alt="Verifited by Visa" nopin = "nopin">
                        </a>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <p class="copy">
                    © 2019 Gradski šifonjer - Sva prava zadržana.
                </p>
            </div>
        </div>
    </div>

</footer>