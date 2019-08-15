<h2>Detalji porudžbine broj: {{ $order->id }}</h2>

<table class="table" >
    <tbody>
    @foreach($order->cart as $item)
        <tr>
            <td align="left">
                Naziv artikla: <strong>{{ $item->name }}</strong><br>
                Količina: <strong>{{ $item->qty }}</strong><br>
                Cena: <strong>{{ $item->price }} RSD</strong> <br>

                    @foreach(json_decode($item->addition) as $key=>$value)
                        @if($key == 'images')
                            @continue
                        @endif
                        @if($key == 'product_id')
                            @continue
                        @endif
                            {{ $key }} <strong>{{ $value }}</strong>
                    @endforeach

            </td>
        </tr>
        <hr>
    @endforeach
    <tr>
        <th align="left">Troškovi dostave:</th>
        <td align="right"> <strong>0</strong> RSD</td>
    </tr>
    <tr>
        <th align="left">Ukupno za plaćanje:</th>
        <td align="right"> <strong>{{ $order->amount }}</strong> RSD</td>
    </tr>
    <tr>
        <th align="left"> Način plaćanja:</th>
        <td align="right">
            @if($order->type == 0)
                Platna kartica<br>
            @elseif($order->type == 1)
                Nalog za uplatu<br>
            @endif
        </td>
    </tr>
    <tr>
        <th align="left"> Uplata:</th>
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
        <th align="left"> Status:</th>
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

Datum i vreme porudžbine:  <strong>{{ $order->created_at->format('d.m.Y. H:i') }}</strong><br>


<h3>Korisnički Podaci</h3>
Ime: <strong> {{$order->name  }}</strong> <br>
Prezime: <strong>{{$order->surname }}</strong> <br>
Ulica:  <strong>{{$order->street }}</strong> <br>
Grad:  <strong>{{$order->place }}</strong> <br>
Zip:  <strong>{{$order->zip }}</strong> <br>
Telefon:  <strong>{{$order->phone }}</strong> <br>
Dodatno: <strong>{{$order->note }}</strong> <br>


@if($order->type == 1)
<h3>Detalji naloga za uplatu:</h3>
Primalac: <strong>Gradski Sifonjer doo, Suvoborska 19, 11000 Beograd</strong><br>
Svrha uplate: <strong>{{ $order->order_name }}</strong><br>
Tekući račun: <strong>150-0000000043511-70</strong><br>
Poziv na broj: <strong>0000-{{ $order->user_id }}-00-{{ $order->id }}</strong><br>
Iznos: <strong>{{$order->amount }} RSD</strong><br>
<strong>*Poziv na boj je obavezan</strong><br>
@elseif($order->type == 2)
<h3>Detalji vaučera:</h3>
Vaučer: <strong>{{ $order->code }}</strong> <br>
@endif
<br>
Molimo da ne odgovarate na ovaj email već ukoliko imate neka pitanja, <br>
kontaktirajte nas na naš email <a href="mailto:info@gradskisifonjer.rs">info@gradskisifonjer.rs</a>.