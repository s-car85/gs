@extends('layout')

@section('title', 'Status porudžbenica')

@section('content')


    <section class="products-section">
        <div class="container">

            @include('profile._topuserinfo')

            <div class="row products-outer d-lg-flex ">


                @include('profile._usernav')

                <div class="userpanelwrap  flex-sm-grow-1">

                    <div class="profile-section profile-user-details" >

                        <h3>VAŠE PORUDŽBINE</h3>

                        @if(count($orders) > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">BR.</th>
                                    <th scope="col">STATUS</th>
                                    <th scope="col">NAČIN UPLATE</th>
                                    <th scope="col">UPLATA</th>
                                    <th scope="col">IZNOS</th>
                                    <th scope="col">DATUM</th>
                                    <th scope="col">INFO</th>
                                </tr>
                                </thead>

                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <th scope="row"><strong>{{ $order->id }}</strong></th>
                                            <td>
                                                @if( $order->shipp == 0)
                                                U obradi
                                                @else
                                                Poslatno
                                                @endif
                                            </td>
                                            <td>
                                                @if($order->type == 0)
                                                    Platna kartica<br>
                                                @elseif($order->type == 1)
                                                    Nalog za uplatu<br>
                                                @endif
                                            </td>
                                            <td>
                                                @if($order->type == 0)
                                                    Neplaćena
                                                @elseif($order->type == 1)
                                                    Plaćena
                                                @elseif($order->type == 2)
                                                Poništena
                                                @endif
                                            </td>
                                            <td>
                                               <strong>{{ $order->amount }} RSD</strong>
                                            </td>
                                            <td>
                                              {{ $order->created_at->format('d.M.Y.') }}
                                            </td>
                                            <td>
                                                <a href="{{ url('status-porudzbenice/'.$order->id) }}" style="text-decoration: underline;">Detalji</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                            </table>
                        </div>

                             {!! $orders->render() !!}
                        @else

                            <h3>Nemate porudžbina.</h3>

                        @endif






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