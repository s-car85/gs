@extends('layout')

@section('title', 'Profil korisnika')

@section('content')


    <section class="products-section">
        <div class="container">

            @include('profile._topuserinfo')

            <div class="row products-outer">

                @include('profile._usernav')

                <div class="userpanelwrap">

                    <div class="col-md-12">



                        <div class="profile-section profile-user-details">

                            <h3>LIČNI PODACI</h3>

                            <dl class="dl-horizontal">
                                <dt>Ime i prezime</dt>
                                <dd class="clearfix">{{ $user->name }} {{ $user->surname }}</dd>
                                <dt>Email adresa</dt>
                                <dd class="clearfix">{{ $user->email }}</dd>
                                <dt>Broj telefona</dt>
                                <dd class="clearfix">
                                    {{ $user->phone }}
                                </dd>
                                <dt>Grad</dt>
                                <dd class="clearfix">{{ $user->city }}</dd>
                                <dt>Poštanski broj</dt>
                                <dd class="clearfix">{{ $user->zip }}</dd>
                                <dt>Ulica i broj</dt>
                                <dd class="clearfix">{{ $user->address }}</dd>
                            </dl>

                        </div>

                        <div class="pt-4 pb-4">
                            <p> Ukoliko želite da deaktivirate Vaš nalog, to možete učiniti klikom na dugme ispod.<br class="d-none d-md-block">
                                Nalog će biti obrisan nakon što dobijemo Vaš zahtev za deaktivaciju.
                            </p>
                            <div class="heading-append">
                                <a href="javascript:void(0);" class="main-btn" onclick="confirm('Da li ste sigurni želite da deaktivirate nalog korinika?')"  title="Deaktiviraj profil">Deaktiviraj nalog</a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $('.sub-menu ul').hide();
        $(".sub-menu a").click(function () {
            $(this).parent(".sub-menu").children("ul").slideToggle("100");
            $(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
        });
    </script>
@endsection