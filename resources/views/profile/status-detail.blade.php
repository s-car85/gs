@extends('layout')

@section('title', 'Detalji porudžbenice')

@section('content')



    <section class="products-section">

        <div class="container">

            @include('profile._topuserinfo')

            <div class="row products-outer">

                @include('profile._usernav')

                <div class="userpanelwrap">

                    {{--BREDCRUMB I PAGINATION--}}
                    <nav class="product-nav">
                        <div class="product-breadcrumb">
                            <div class="d-flex align-items-center">
                                <a href="{{ url('status-porudzbenica') }}" class="breadcrumb-link" title="Status porudžbenica">STATUS PORUDŽBENICA</a>
                                <span class="breadcrumb-separator"></span>
                                <span href="#" class="breadcrumb-link">PORUDŽBENICA BROJ #{{ $order->id }}</span>
                            </div>
                        </div>
                    </nav>

                    <strong class="profile-section profile-user-details">

                        <h3>DETALJI PORUDŽBINE</h3>

                        <table class="table" >

                            <tbody>
                            @foreach($order->cart as $item)
                            <tr>
                                <td>
                                    <p>Naziv artikla: <strong>{{ $item->name }}</strong></p>
                                    <p>Količina: <strong>{{ $item->qty }}</strong></p>
                                    <p>Cena: <strong>{{ $item->price }} RSD</strong></p>
                                    <p>
                                        @foreach(json_decode($item->addition) as $key=>$value)
                                            @if($key == 'images')
                                                @continue
                                            @endif
                                            @if($key == 'product_id')
                                                @continue
                                            @endif
                                            {{ $key }} <strong>{{ $value }}</strong>
                                        @endforeach
                                    </p>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <th>Troškovi dostave:</th>
                                <td align="right"> <strong>0</strong> RSD</td>
                            </tr>
                            <tr>
                                <th>Ukupno za plaćanje:</th>
                                <td align="right"> <strong>{{ $order->amount }}</strong> RSD</td>
                            </tr>
                            <tr>
                                <th> Način plaćanja:</th>
                                <td align="right">
                                    @if($order->type == 0)
                                        Platna kartica<br>
                                    @elseif($order->type == 1)
                                        Nalog za uplatu<br>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th> Uplata:</th>
                                <td align="right">
                                    @if($order->type == 0)
                                        Neplaćena
                                    @elseif($order->type == 1)
                                        Plaćena
                                    @elseif($order->type == 2)
                                        Poništena
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th> Status:</th>
                                <td align="right">
                                    @if( $order->shipp == 0)
                                        U obradi
                                    @else
                                        Poslatno
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>
                                    <h3>Adresa isporuke</h3>
                                    <p>Ime:    <strong>{{ $order->name }}</strong></p>
                                    <p>Prezime: <strong>{{ $order->surname }}</strong></p>
                                    <p>Ulica i broj:  <strong>{{ $order->street }}</strong></p>
                                    <p>Grad:  <strong>{{ $order->place }}</strong></p>
                                    <p>Zip:  <strong>{{ $order->zip }}</strong></p>
                                    <p>Telefon:  <strong>{{ $order->phone }}</strong></p>
                                    <p>Dodatno: <strong>{{ $order->note }}</strong></p>
                                </td>
                            </tr>
                            @if($order->type == 1)
                            <tr>
                                <td>
                                    <h3>Nalog za uplatu:</h3>
                                    <p>Primalac: <strong>Gradski Sifonjer doo, Suvoborska 19, 11000 Beograd</strong></p>
                                    <p>Svrha uplate: <strong>Porudžbina br. {{ $order->id }}</strong></p>
                                    <p>Tekući račun: <strong>150-0000000043511-70</strong></p>
                                    <p>Poziv na broj: <strong>0000-{{ $order->user_id }}-00-{{ $order->id }}</strong></p>
                                    <p>Iznos: <strong>{{$order->amount }} RSD</strong></p>
                                    <p><strong>*Poziv na boj je obavezan</strong></p>
                                </td>
                            </tr>
                            @endif
                            </tbody>

                        </table>



                    </div>

                    <nav class="product-nav">


                        <div class="product-pagination">
                            <div class="d-flex align-items-center">
                                <a href="{{ url('status-porudzbenica') }}" class="pagination-link-prev">nazad</a>
                            </div>
                        </div>
                    </nav>


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