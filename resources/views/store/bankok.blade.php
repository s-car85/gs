@extends('layout')

@section('title', 'Uspešna transakcija')

@section('content')
      <div class="d-flex justify-content-center">
        <div class="col-sm-12 col-lg-12 col-xl-5 pt-5">

                <div class="pt-5">
                    <div class="pb-3">
                        <h1 class="text-center">
                           Uspešna transakcija
                        </h1>
                         <p class="text-center pt-4">
                            Uspešno ste poručili box Gradskog Šifonjera!
                            Nakon evidentirane uplate, naši stilisti kreću u potragu za stilskim kombinacijama,
                            a vaša porudžbina će dospeti na odabranu adresu za najdalje 7 radnih dana. <br>
                        </p>
                        <p class="text-center pb-4">
                                Vaša transakcija je prihvaćena, račun Vaše platne kartice će biti zadužen. U pratećem tekstu možete videti sve detalje ove transakcije.
                        </p>

                    <table class="table">

                        <tbody>
                            <tr>
                                <td>
                                    <h3>Detalji transakcije</h3>
                                    <p>Podaci o korisniku: <strong>{{ $user->name }} {{ $user->surname }} , <br> {{ $user->profile->street }} {{ $user->profile->zip }} - {{ $user->profile->place }}, {{ $user->email }}</strong></p>
                                    <p>Podaci o porudžbini: <strong>Uplata na korisnički nalog </strong></p>
                                    <p>Metoda plaćanja : <strong>Intesa </strong></p>
                                    <p>Datum uplate : <strong>{{ $order['banka']['EXTRA_TRXDATE'] }} </strong></p>
                                    <p>Referenca : <strong>{{ $order['banka']['HostRefNum'] }} </strong></p>
                                    <p>Status : <strong>{{ $order['banka']['Response'] }} </strong></p>
                                    <p>Iznos : <strong>{{ $order['banka']['amount'] }} </strong></p>
                                    <p>AuthCode: <strong>{{ $order['banka']['AuthCode'] }} </strong></p>
                                    <p>TransId: <strong>{{ $order['banka']['TransId'] }} </strong></p>
                                    <p>ProcReturnCode: <strong>{{ $order['banka']['ProcReturnCode'] }} </strong></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h3>Detalji porudžbenice:</h3>
                                    <p>Naziv:    <strong>{{$order->order_name  }}</strong></p>
                                    <p>Iznos: <strong>{{$order->amount }} RSD</strong></p>
                                    <p>Datum: <strong>{{ $order->created_at->format('d.m.Y. H:i') }}</strong></p>
                                    <p>Način plaćanja: <strong>Platna kartica</strong></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h3>Adresa isporuke</h3>
                                    <p>Ime:    <strong>{{$order->name  }}</strong></p>
                                    <p>Prezime: <strong>{{$order->surname }}</strong></p>
                                    <p>Ulica:  <strong>{{$order->street }}</strong></p>
                                    <p>Grad:  <strong>{{$order->place }}</strong></p>
                                    <p>Zip:  <strong>{{$order->zip }}</strong></p>
                                    <p>Telefon:  <strong>{{$order->phone }}</strong></p>
                                    <p>Dodatno: <strong>{{$order->note }}</strong></p>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                          <p class="text-center pb-4">Sve cene su sa uračunatim PDV-om i nema dodatnih ili skrivenih troškova.</p>

                          <p class="text-center">
                            Ako imate nekih pitanja pišite nam na <a href="mailto:info@gradskisifonjer.rs" class="strongblue">info@gradskisifonjer.rs</a>.
                            <br>
                                Hvala što koristite usluge <strong>Gradskog Šifonjera</strong>
                        </p>
                    </div>
                </div>

        </div>

    </div>
@endsection
