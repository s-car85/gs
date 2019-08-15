<h2>VAŠA TRANSAKCIJA JE PRIHVAĆENA</h2>

Poštovani, <br><br>
Vaša transakcija je prihvaćena, račun Vaše platne kartice će biti zadužen. U pratećem tekstu možete videti sve detalje ove transakcije.<br>

Podaci o korisniku: <strong>{{ $order->name }} {{ $order->surname }} , {{ $order->address }} {{ $order->zip }} - {{ $order->city }}, {{ $order->email }}</strong><br>
Podaci o porudžbini: #<strong>{{ $order->id }}</strong><br>

<table class="table" >
    <tbody>
    @foreach($order->cart as $item)
        <tr>
            <td align="left">
                Naziv artikla: <strong>{{ $item->name }}</strong><br>
                Količina: <strong>{{ $item->qty }}</strong><br>
                Cena: <strong>{{ $item->price }} RSD</strong>
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


Metoda plaćanja : <strong>Intesa </strong><br>
Datum uplate : <strong>{{ $order['banka']['EXTRA_TRXDATE'] }} </strong><br>
Referenca : <strong>{{ $order['banka']['HostRefNum'] }} </strong><br>
Status : <strong>{{ $order['banka']['Response'] }} </strong><br>
Iznos : <strong>{{ $order['banka']['amount'] }} </strong><br>
AuthCode: <strong>{{ $order['banka']['AuthCode'] }} </strong><br>
TransId: <strong>{{ $order['banka']['TransId'] }} </strong><br>
ProcReturnCode: <strong>{{ $order['banka']['ProcReturnCode'] }} </strong><br>

<h3>Podaci o trgovcu:</h3>
<strong>Gradski Šifonjer doo </strong><br>
<strong>Omladinskih brigada broj 216/21, Beograd 11070</strong><br>
Matični broj: <strong>21351580, </strong><br>
PIB: <strong>110451610. </strong><br>


<br>
Sve cene su sa uračunatim PDV-om i nema dodatnih ili skrivenih troškova.

<br>
<br>
Molimo da ne odgovarate na ovaj email već ukoliko imate neka pitanja, <br>
kontaktirajte nas na naš email <a href="mailto:info@gradskisifonjer.rs">info@gradskisifonjer.rs</a>. <br><br>

Srdačan pozdrav,<br>
Gradski Šifonjer