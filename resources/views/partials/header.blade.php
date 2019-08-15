<header class="{{ request()->segment(1) == ''  || request()->segment(1) == 'index' ? 'header-transparent' : '' }}">

    {{--HEADER TOPBAR--}}
    {{--<div class="header-top" id="cookie-container">--}}
        {{--<p class="text-center">Besplatna Dostava za celu Srbiju</p>--}}
        {{--<span class="closetop" id="close-cookie-bar" title="Zatvori"></span>--}}
    {{--</div>--}}

    {{--MOBILE NAV--}}
    <div class="mobile-nav d-block d-md-none">
        <div class="d-flex align-items-center no-gutters">
            <div class="col">
                {{--<p><a href="{{ url('/korpa') }}" title="Vaša korpa">Korpa (<span>{{ Cart::getContent()->count() }}</span>)</a></p>--}}
                <a href="{{ url('/korpa') }}" title="Vaša korpa" class="cart-link">
                        <span>
                            @include('partials.svg.cart')
                            <span class="qty">{{ Cart::getContent()->count() }}</span>
                        </span>

                </a>
            </div>
            <div class="col d-flex justify-content-center align-items-center">
                <div class="header-logo">
                    <a href="{{ url('/') }}" title="Gradski šifonjer">
                        @if(request()->segment(1) == '' || request()->segment(1) == 'index')
                            @include("partials.svg.logo-white", ['class' => 'logo'])
                        @else
                            @include("partials.svg.logo", ['class' => 'logo'])
                        @endif
                    </a>
                </div>
            </div>
            <div class="col d-flex justify-content-end align-items-center">
                <div class="mob-search">
                    <a href="{{ url('/pretraga') }}" title="Pretraga">
                        <i class="icon-search d-block d-md-none"></i>
                    </a>
                </div>
                <div class="mob-search">
                    @if(Auth::user())
                        <a  href="{{ url('/profil') }}" title="Profil"><i class="icon-user2"></i></a>
                    @else
                        <a  href="#" data-remodal-target="prijava" title="Prijavi se"><i class="icon-user2"></i></a>
                    @endif
                </div>
                <div class="mob-ham">
                    <i class="icon-menu open-mobile-nav d-block d-md-none" title="Navigacija"></i>
                </div>

            </div>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="navigation">
        <nav>
            <!-- Horizontal Nav Toggle -->
            <i class="go-back-icon icon-chevron-thin-left "></i>
            <!-- Close Icon -->
            <i class="close-menu d-block "></i>
            <!-- Menu -->
            <ul>
                <li>
                    <a href="{{ url('/') }}" title="Početna">POČETNA</a>
                </li>
                <li>
                    <a href="{{ url('gs-kutija') }}" title="GŠ kutija">GŠ KUTIJA</a>
                </li>
                <li>
                    <a href="{{ url('sivenje-po-meri') }}" title="Šivenje po meri">ŠIVENJE PO MERI</a>
                </li>
                <li>
                    <a href="{{ url('prodavnica') }}" title="Prodavnica">PRODAVNICA</a>
                </li>

                @if(Auth::user())
                     <li style="padding-top: 20px; margin-top: 30px; border-top: 1px solid #ddd;">
                        <a href="{{ url('profil') }}" title="Moj nalog">MOJ NALOG</a>
                    </li>
                    <li>
                        <a href="{{ url('logout') }}" title="Odjavi se">ODJAVA</a>
                    </li>
                @endif

            </ul>
        </nav>
    </div>


    {{--DESTKOP NAVIGATION--}}
    <div class="des-nav d-md-block d-none">
        <div class="container">

            <div class="d-flex align-items-center no-gutters ">
                <div class="col-md-5 col-lg-7 col-xl-8 d-flex justify-content-start align-items-center no-gutters">

                    <div class="header-logo">
                        <a href="{{ url('/') }}" title="Gradski šifonjer">
                            @if(request()->segment(1) == '' || request()->segment(1) == 'index')
                                 @include("partials.svg.logo-white", ['class' => 'logo'])
                            @else
                                @include("partials.svg.logo", ['class' => 'logo'])
                            @endif
                        </a>
                    </div>

                    {{--<div class="navigation mb-2  ml-auto" style="margin-right: 60px;">--}}
                        {{--<nav>--}}
                            {{--<!-- Horizontal Nav Toggle -->--}}
                            {{--<i class="go-back-icon icon-chevron-thin-left d-md-none"></i>--}}
                            {{--<!-- Close Icon -->--}}
                            {{--<i class="close-menu d-block  d-md-none"></i>--}}
                            {{--<!-- Menu -->--}}
                            {{--<ul>--}}
                                {{--<li>--}}
                                    {{--<a href="{{ url('gs-kutija') }}" title="GŠ kutija">GŠ KUTIJA</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="{{ url('sivenje-po-meri') }}" title="Šivenje po meri">ŠIVENJE PO MERI</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="{{ url('prodavnica') }}" title="Prodavnica">PRODAVNICA</a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</nav>--}}
                    {{--</div>--}}
                </div>
                <div class="col-md-7 col-lg-5 col-xl-4 d-flex justify-content-end align-items-center">
                    <div class="search-form">
                        {!! Form::open(['url'=>'pretraga','method'=>'GET', 'class' => 'form-inline']) !!}
                            <div class="form-group">

                                <input class="search-input" placeholder="PRETRAGA" type="search" name="q" value="{{isset($term) ? $term : ''}}"
                                       autocomplete="off">
                                <button class="btn btn-primary mb-2 search-submit" type="submit">
                                    @include('partials.svg.search')
                                </button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="register-link">
                        @if(Auth::user())
                            <a  href="{{ url('/profil') }}" title="Profil"><i class="icon-user2"></i></a>
                            @else
                                <a  href="#" data-remodal-target="prijava" title="Prijavi se"><i class="icon-user2"></i></a>
                        @endif
                    </div>
                    <div>
                        <a href="{{ url('/korpa') }}" title="Vaša korpa" class="cart-link">
                        <span>
                            @include('partials.svg.cart')
                            <span class="qty">{{ Cart::getContent()->count() }}</span>
                        </span>

                        </a>
                    </div>
                    <div class="mob-ham">
                        <i class="icon-menu open-mobile-nav" title="Navigacija"></i>
                    </div>
                </div>
            </div>

        </div>
    </div>
</header>




