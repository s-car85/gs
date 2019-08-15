@extends('layout')

@section('title', 'Vaša korpa')

@section('content')
    <section id="page-cart" class="products-section">
        <div class="container no-gutters mt-2 mb-5">
            <div class="col-md-12">
                <h4 class="text-uppercase">Vaša korpa</h4>
            </div>
            @if(Cart::getTotal() > 0)
            <div class="col-md-12 no-gutters">

                <div class="col-12 border-bottom pt-4">
                    <div class="row no-gutters">
                        <div class="col-7 cart-mar">
                            <h6 class="text-uppercase">artikal</h6>
                        </div>
                        <div class="col-1 cart-mar text-center">
                            <h6 class="text-uppercase text-center">kol.</h6>
                        </div>
                        <div class="col text-right">
                            <h6 class="text-uppercase">cena</h6>
                        </div>
                    </div>
                </div>

                @foreach(Cart::getContent() as $item)
                    <div class="col-12 py-4 border-bottom">
                        <div class="row align-items-center no-gutters">
                            <div class="col-7 cart-mar align-items-center d-flex">
                                <div class="cart-mar">
                                    {{ Form::open(array('route' => ['removeCart', $item->id], 'method' => 'post')) }}
                                        <button type="submit" class="btn btn-sm remove-cart-item" title="Obriši artikal"><span>×</span></button>
                                    {{ Form::close() }}
                                </div>
                                <div class="align-items-center ">
                                    <div class="text-center cart-mar">
                                        <img src="{{ url('upload').'/'.json_decode($item->attributes->images, true)[0]['cart'] }}" alt="" width="70">
                                    </div>
                                </div>
                                <div class="align-items-center">
                                    <a  href="{{ url('proizvod').'/'.str_slug($item->name).'/'.$item->attributes->product_id }}">
                                        <h5 class="fs--1 fs-sm-0 fw-600">{{ $item->name }}</h5>
                                    </a>
                                    @foreach($item->attributes as $key=>$value)
                                        @if($key == 'images')
                                            @continue
                                        @endif
                                        @if($key == 'product_id')
                                            @continue
                                        @endif
                                        <div class="cart-variant"><span class="variant-name">{{ $key }}</span> {{ $value }}</div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-1 cart-mar text-center">
                                <form action="">
                                    <div class="form-group mb-0">
                                        <input type="number" class="form-control form-cart" name="qty" min="1" max="100"
                                               value="{{ $item->quantity }}" step="1" disabled>
                                    </div>
                                </form>
                            </div>
                            <div class="col text-right">
                                <h5 class="fs-0 price">{{ number_format($item->price, 2) }} RSD</h5>
                        </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <div class="row justify-content-end text-right mt-4">

                <div class="col-md-8 col-lg-6">
                    <div class="row justify-content-end mt-2">
                        <div class="col-6">
                            <h5 class="fw-700 bci">Troškovi dostave: </h5>
                        </div>
                        <div class="col-4">
                            <h5 class="fw-700 price bci">{{ number_format(0,2) }} RSD</h5>
                        </div>
                    </div>
                    <div class="row justify-content-end mt-2">
                        <div class="col-6">
                            <h5 class="fw-700 bci">Ukupno: </h5>
                        </div>
                        <div class="col-4">
                            <h5 class="fw-700 price bci">{!! number_format(Cart::getTotal(), 2) !!} RSD</h5>
                        </div>
                    </div>
                    <div class="row justify-content-end mt-4">
                        <div class="col-12 col-sm-8">
                            <a class="main-btn" href="{{ url('/placanje') }}">Nastavi na kasu</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--/.row-->
                @else
            <h2>Prazna!</h2>
                @endif
        </div>
        <!--/.container-->
    </section>
@endsection