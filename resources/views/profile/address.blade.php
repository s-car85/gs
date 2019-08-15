@extends('layout')

@section('title', 'Izmena podataka')

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
        <div class="container">

            @include('profile._topuserinfo')

            <div class="row products-outer">

                @include('profile._usernav')

                <div class="userpanelwrap">

                    <div class="profile-section profile-user-details col-xs-12">

                        <h3>OSNOVNI PODACI</h3>
                        <p>Ukoliko želite da izmenite Vaše podatke to možete učiniti ispod.</p>

                        @if($errors->any())
                            <ul class="alert-danger list-unstyled">
                                @foreach($errors->all() as $error)
                                    <li>* {{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($user, ['method' =>  'put', 'id'=>'profileData']) !!}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name" class="control-label">Ime*</label>
                                <input id="name" type="text" class="form-control" name="name"
                                       value="{!! isset( $user->name)? $user->name: '' !!}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="surname" class="control-label">Prezime*</label>
                                <input id="surname" type="text" class="form-control" name="surname"
                                       value="{!! isset($user->surname)? $user->surname: '' !!}"
                                       required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="address" class="control-label">Ulica i broj*</label>
                                <input id="address" type="text" class="form-control" name="address"
                                       value="{!! isset($user->address)? $user->address: '' !!}"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="city" class="control-label">Grad / Mesto*</label>
                                <input id="city" type="text" class="form-control" name="city"
                                       value="{!! isset($user->city)? $user->city: '' !!}"
                                       required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="zip" class="control-label">Poštanski broj*</label>
                                <input id="zip" type="text" class="form-control" name="zip"
                                       value="{!! isset($user->zip)? $user->zip: '' !!}"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone" class="control-label">Broj telefona*</label>
                                <input id="phone" type="text" class="form-control" name="phone"
                                       value="{!! isset($user->phone)? $user->phone: '' !!}"
                                       required>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="main-btn">
                                Sačuvaj podatke
                            </button>
                        </div>

                        {{ Form::close() }}



                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script>
        $('.sub-menu ul').hide();
        $(".sub-menu a").click(function () {
            $(this).parent(".sub-menu").children("ul").slideToggle("100");
            $(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
        });

        $(function () {

            jQuery.validator.addMethod("notEqual", function (value, element, param) {
                return this.optional(element) || value != param;
            }, "Molimo izaberite drugu vrednost");

            // configure your validation
            $("#profileData").validate({
                rules: {
                    name: {
                        minlength: 2,
                        maxlength: 100,
                        required: true
                    },
                    surname: {
                        minlength: 2,
                        maxlength: 100, required: true
                    },
                    address: {
                        minlength: 2,
                        maxlength: 400, required: true
                    },
                    city: {
                        minlength: 2,
                        maxlength: 100, required: true
                    },
                    zip: {required: true},
                    phone: {required: true},
                },
                messages: {
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
                    address: {
                        required: "Unesite Vašu ulica i broj.",
                        minlength: jQuery.format("Unesite bar {0} karaktera."),
                        maxlength: jQuery.format("Maksimalan broj karaktera je {0}.")
                    },
                    city: {
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
                },
                errorPlacement: function (error, element) {

                    if (element.attr("type") == "radio") {
                        error.insertAfter("#payment-section");
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function (form) {
                    $(".main-btn").prop('disabled', true);
                    form.submit();
                }
            });


        });
    </script>
@endsection