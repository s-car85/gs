@extends('layout')

@section('title', 'Plaćanje')

@section('style')
    <style>
        label.error {
            width: 100%;
            margin-top: .25rem;
            font-size: 80%;
            color: #e3342f;
            padding-bottom: 0;
        }

        .addReadMore.showlesscontent .SecSec,
        .addReadMore.showlesscontent .readLess {
            display: none;
        }

        .addReadMore.showmorecontent .readMore {
            display: none;
        }

        .addReadMore .readMore,
        .addReadMore .readLess {
            font-weight: bold;
            margin-left: 2px;
            color: #222;
            cursor: pointer;
            text-transform: uppercase;
        }

        .addReadMoreWrapTxt.showmorecontent .SecSec,
        .addReadMoreWrapTxt.showmorecontent .readLess {
            display: block;
        }
    </style>
@endsection

@section('content')
    <section class="products-section">
        <div class="">

            <div class="chekcout-page">
                <div class="col-md-12">
                    <h3>PLAĆANJE</h3>
                </div>

                {{ Form::open(array('route' => 'payment', 'method' => 'POST', 'id' => 'checkout-form', 'novalidate')) }}
                    <div class="d-flex flex-wrap">

                        <div class="col-lg-6 pt-5 chcols">

                            @if($errors->any())
                                <ul class="alert-danger list-unstyled">
                                    @foreach($errors->all() as $error)
                                        <li>* {{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            <div class="checkout-container">
                                <div class="checkout-title">
                                    <div class="checkout-heading d-flex align-items-center d-flex align-items-center">
                                        <div class="counter">1</div>
                                        <span>Vaš Email</span></div>
                                </div>
                                <div class="checkout-content">
                                    <div class="form-group">
                                        <label for="email" class="control-label">Email*</label>
                                        <input id="email" type="text" class="form-control" name="email" {{ auth()->check() ? 'readonly' : '' }}
                                               value="{!! isset( Auth::user()->email) ? Auth::user()->email: '' !!}"
                                               required>
                                        <span class="input-exp">Na ovu e-mail adresu ćete primati potvrde i obaveštenja.</span>
                                    </div>
                                    @if(!auth()->check())
                                    <div>
                                        <p>Već imate nalog? <a data-remodal-target="prijava" href="#"
                                                               title="Prijavi se"><span
                                                        class="white-space">Prijavi se</span></a></p>
                                    </div>
                                    @endif
                                </div>

                            </div>

                            <div class="checkout-container">
                                <div class="checkout-title">
                                    <div class="checkout-heading d-flex align-items-center">
                                        <div class="counter">2</div>
                                        <span>Adresa isporuke</span></div>
                                </div>
                                <div class="checkout-content">

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="name" class="control-label">Ime*</label>
                                            <input id="name" type="text" class="form-control" name="name"
                                                   value="{!! isset( Auth::user()->name)? Auth::user()->name: '' !!}"
                                                   required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="surname" class="control-label">Prezime*</label>
                                            <input id="surname" type="text" class="form-control" name="surname"
                                                   value="{!! isset(Auth::user()->surname)? Auth::user()->surname: '' !!}"
                                                   required>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="street" class="control-label">Ulica i broj*</label>
                                            <input id="street" type="text" class="form-control" name="street"
                                                   value="{!! isset(Auth::user()->address)? Auth::user()->address: '' !!}"
                                                   required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="place" class="control-label">Grad / Mesto*</label>
                                            <input id="place" type="text" class="form-control" name="place"
                                                   value="{!! isset(Auth::user()->address)? Auth::user()->city: '' !!}"
                                                   required>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="zip" class="control-label">Poštanski broj*</label>
                                            <input id="zip" type="text" class="form-control" name="zip"
                                                   value="{!! isset(Auth::user()->zip)? Auth::user()->zip: '' !!}"
                                                   required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="phone" class="control-label">Broj telefona*</label>
                                            <input id="phone" type="text" class="form-control" name="phone"
                                                   value="{!! isset(Auth::user()->phone)? Auth::user()->phone: '' !!}"
                                                   required>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="checkout-container">
                                <div class="checkout-title">
                                    <div class="checkout-heading d-flex align-items-center ">
                                        <div class="counter">3</div>
                                        <span>Dodatne informacije</span></div>
                                </div>
                                <div class="checkout-content">
                                    <p>Unesite komentar ukoliko imate posebnu napomenu vezano za ovu porudžbinu</p>
                                    <div class="form-group">
                                        <label for="note"
                                               class="control-label">Napomena</label>
                                        <textarea name="note" id="note" style="height: 150px; resize: none;" cols="100"
                                                  rows="100"
                                                  class="form-control"> {!! isset($profile->note)? $profile->note: '' !!}</textarea>
                                    </div>
                                </div>

                            </div>


                            <div class="checkout-container">
                                <div class="checkout-title">
                                    <div class="checkout-heading d-flex align-items-center">
                                        <div class="counter">4</div>
                                        <span>Način plaćanja</span></div>
                                </div>
                                <div class="checkout-content" id="payment-section">
                                    <p>Izaberite način plaćanja</p>
                                    <div class="mswitch">
                                        <label>
                                            <input type="radio" name="type"
                                                   value="0">
                                            <span>Platna kartica</span>
                                        </label>
                                    </div>
                                    <span class="input-exp">
                                <div class="addReadMore showlesscontent">
                                    Sva plaćanja se vrše u zvaničnoj srpskoj valuti – dinar (RSD). Klijentu će biti naplaćen iznos sa platne kartice u dinarima i to putem konverzije cene izražene u stranoj valuti u srpski dinar po važećem kursu Narodne banke Srbije. Prilikom naplate sa Klijentove platne kartice, isti iznos se konvertuje u lokalnu valutu prema važećem kursu banke izdavaoca platne kartice Klijenta. Kao rezultat ove konverzije postoji mogućnost male razlike od prvobitne cene istaknute na web stranici Šifonjera.
                                </div>
                                </span>
                                    <div class="mswitch">
                                        <label>
                                            <input type="radio" name="type"
                                                   value="1">
                                            <span>Nalog za uplatu</span>
                                        </label>
                                    </div>
                                    <span class="input-exp">
                                <div class="addReadMore showlesscontent">
                                    Plaćanje se vrši  nalogom za uplatu  koji pošaljemo na Vašu email adresu.
                                    Poziv na broj je obavezan, a to je broj Vaše porudžbine, nakon evidentirane uplate Vaša porudžbina
                                    će biti poslata kurirskom službom na Vašu kućnu adresu.
                                </div>
                            </span>
                                </div>
                            </div>

                            <div class="checkout-container">
                                <div class="checkout-title">
                                    <div class="checkout-heading d-flex align-items-center">
                                        <div class="counter">5</div>
                                        <span>Potvrda kupovine</span></div>
                                </div>
                                <div class="checkout-content">

                                    <table class="table cart-table-summary">
                                        <tfoot>
                                        <tr>
                                            <td>Troškovi dostave:</td>
                                            <td class="text-right checkbox-price"><span>{{ number_format(0, 2) }} RSD</span></td>
                                        </tr>
                                        <tr>
                                            <td>Ukupno:</td>
                                            <td class="text-right checkbox-price">
                                                <span>{!! number_format(Cart::getTotal(), 2) !!} RSD</span></td>
                                        </tr>
                                        <tr class="cart-summary">
                                            <td>Ukupno za plaćanje:</td>
                                            <td class="text-right checkbox-price">
                                                <span>{!! number_format(Cart::getTotal(), 2) !!} RSD</span></td>
                                        </tr>
                                        </tfoot>
                                    </table>

                                    <div class="cart-privacy-policy">
                                        <p>Klikom na dugme, slažeš se sa <a target="_blank"
                                                                            href="{{ url('uslovi-koriscenja') }}"
                                                                            title="Uslovi korišćenja">Uslovima
                                                korišćenja.</a></p>
                                    </div>
                                    <div class="mt-4">
                                        <input type="hidden" name="amount" value="{!! Cart::getTotal() !!}">
                                        <button type="button" id="payment" title="Potvrdi kupovinu" class="main-btn-block"
                                               >POTVRDI
                                        </button>
                                    </div>

                                </div>

                            </div>
                        </div>


                        <div class="col-lg-6 chcols">
                            <div class="sticky-top pt-5">
                                <div class="checkout-container">
                                    <div class="checkout-title">
                                        <div class="checkout-heading d-flex align-items-center">
                                            <span>Pregled korpe</span></div>
                                    </div>
                                    {{-- CART ITEMS  --}}
                                    <div class="cart-detail">
                                        @foreach(Cart::getContent() as $item)
                                            <div class="cart-item">
                                                <div class="cart-img">
                                                    <img src="{{ url('upload').'/'.json_decode($item->attributes->images, true)[0]['cart'] }}"
                                                         alt=""/>
                                                </div>
                                                <div class="cart-price"><span>{{ number_format($item->price, 2) }} RSD</span></div>

                                                <div class="cart-qty">
                                                    <div class="d-flex">
                                                        <span>kol.</span>
                                                        <form action="">
                                                            <div class="form-group mb-0 ml-auto">
                                                                <span class="fq" >
                                                                {{ $item->quantity }}
                                                                </span>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="cart-remove">
                                                    {{ Form::open(array('route' => ['removeCart', $item->id], 'method' => 'post')) }}
                                                    <button type="submit" class="btn btn-sm" title="Obriši artikal">
                                                        <span>Obriši</span></button>
                                                    {{ Form::close() }}
                                                </div>
                                                <div class="cart-info">
                                                    <div class="cart-name">{{ $item->name }}</div>
                                                    @foreach($item->attributes as $key=>$value)
                                                        @if($key == 'images')
                                                            @continue
                                                        @endif
                                                        @if($key == 'product_id')
                                                            @continue
                                                        @endif
                                                        <div class="cart-color">{{ $key }} {{ $value }}</div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                        {{-- CART TOAL --}}
                                        <div class="cart-total">
                                            <div>
                                                <div class="cart-shipping">
                                                    <div class="cart-total-label">Dostava</div>
                                                    <div class="cart-total-amount"><span class="money">{{ number_format(0, 2) }} RSD</span>
                                                    </div>
                                                </div>
                                                <div class="cart-subtotal">
                                                    <div class="cart-total-label">Ukupno</div>
                                                    <div class="cart-total-amount"><span class="money">{!! number_format(Cart::getTotal(), 2) !!} RSD</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cart-total-final">
                                                <div class="cart-total-label">Ukupno za plaćanje</div>
                                                <div class="cart-total-amount"><span class="money">{!! number_format(Cart::getTotal(), 2) !!} RSD</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                {{ Form::close() }}
            </div>

        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>

    <script>

        function AddReadMore() {
            //This limit you can set after how much characters you want to show Read More.
            var carLmt = 250;
            // Text to show when text is collapsed
            var readMoreTxt = " ... Prikaži više";
            // Text to show when text is expanded
            var readLessTxt = " Prikaži manje";


            //Traverse all selectors with this class and manupulate HTML part to show Read More
            $(".addReadMore").each(function () {
                if ($(this).find(".firstSec").length)
                    return;

                var allstr = $(this).text();
                if (allstr.length > carLmt) {
                    var firstSet = allstr.substring(0, carLmt);
                    var secdHalf = allstr.substring(carLmt, allstr.length);
                    var strtoadd = firstSet + "<span class='SecSec'>" + secdHalf + "</span><span class='readMore'  title='Klikni da vidiš ceo text'>" + readMoreTxt + "</span><span class='readLess' title='Klikni da vidiš manje text'>" + readLessTxt + "</span>";
                    $(this).html(strtoadd);
                }

            });
            //Read More and Read Less Click Event binding
            $(document).on("click", ".readMore,.readLess", function () {
                $(this).closest(".addReadMore").toggleClass("showlesscontent showmorecontent");
            });

            $(document).on("click", "#payment", function () {
                $('#checkout-form').submit();
            });
        }

        $(function () {
            //Calling function after Page Load
            AddReadMore();
        });

    </script>
    <script>
        $(function () {

            jQuery.validator.addMethod("notEqual", function (value, element, param) {
                return this.optional(element) || value != param;
            }, "Molimo izaberite drugu vrednost");

            // configure your validation
            $("#checkout-form").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    name: {
                        minlength: 2,
                        maxlength: 100,
                        required: true
                    },
                    surname: {
                        minlength: 2,
                        maxlength: 100, required: true
                    },
                    street: {
                        minlength: 2,
                        maxlength: 400, required: true
                    },
                    place: {
                        minlength: 2,
                        maxlength: 100, required: true
                    },
                    zip: {required: true},
                    phone: {required: true},
                    type: {required: true},
                },
                messages: {
                    email: {
                        required: "Unesite Vašu email adresu.",
                        email: "Unesite ispravnu email adresu.",
                    },
                    name: {
                        required: "Unesite Vaše ime.",
                        minlength: jQuery.format("Unesite bar {0} karaktera."),
                        maxlength: jQuery.format("Maksimalan broj karaktera je {0}.")
                    },
                    surname: {
                        required: "Unesite Vaše prezime.",
                        minlength: jQuery.format("Unesite bar {0} karaktera."),
                        maxlength: jQuery.format("Maksimalan broj karaktera je {0}.")
                    },
                    street: {
                        required: "Unesite Vašu ulica i broj.",
                        minlength: jQuery.format("Unesite bar {0} karaktera."),
                        maxlength: jQuery.format("Maksimalan broj karaktera je {0}.")
                    },
                    place: {
                        required: "Unesite Mesto/Grad.",
                        minlength: jQuery.format("Unesite bar {0} karaktera."),
                        maxlength: jQuery.format("Maksimalan broj karaktera je {0}.")
                    },
                    zip: {
                        required: "Unesite poštanski broj.",
                    },
                    phone: {
                        required: "Unesite kontakt telefon.",
                    },
                    type: {
                        required: "Izaberite način plaćanja",
                    },
                },
                errorPlacement: function (error, element) {

                    if (element.attr("type") == "radio") {
                        error.insertAfter("#payment-section");
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function (form) {
                    $(".main-btn-block").prop('disabled', true);
                    form.submit();
                }
            });


        });

    </script>

@endsection