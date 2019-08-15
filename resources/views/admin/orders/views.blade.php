<button type="button" class="btn btn-sm btn-primary float-lg-left" data-toggle="modal" data-target="#order-{{ $orders->id }}"><i class="fas fa-eye"></i></button>
<!-- Modal -->
<div class="modal fade" id="order-{{ $orders->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999999999999">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order: {{ $orders->id }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table" >
                    <h3>Detalji porudžbenice:</h3>
                    <tbody>
                    @foreach($orders->cart as $item)
                        <tr>
                            <td>
                                <p>Naziv artikla: <strong><a href="{{ url('proizvod').'/'.str_slug($item->name).'/'.$item->product_id }}" target="_blank">{{ $item->name }}</a></strong></p>
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
                        <td align="right"> <strong>{{ $orders->amount }}</strong> RSD</td>
                    </tr>
                    <tr>
                        <th> Način plaćanja:</th>
                        <td align="right">
                            @if($orders->type == 0)
                                Platna kartica<br>
                            @elseif($orders->type == 1)
                                Nalog za uplatu<br>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th> Uplata:</th>
                        <td align="right">
                            @if($orders->type == 0)
                                Neplaćena
                            @elseif($orders->type == 1)
                                Plaćena
                            @elseif($orders->type == 2)
                                Poništena
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th> Status:</th>
                        <td align="right">
                            @if( $orders->shipp == 0)
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
                            <p>Ime:    <strong>{{ $orders->name }}</strong></p>
                            <p>Prezime: <strong>{{ $orders->surname }}</strong></p>
                            <p>Ulica i broj:  <strong>{{ $orders->street }}</strong></p>
                            <p>Grad:  <strong>{{ $orders->place }}</strong></p>
                            <p>Zip:  <strong>{{ $orders->zip }}</strong></p>
                            <p>Telefon:  <strong>{{ $orders->phone }}</strong></p>
                            <p>Dodatno: <strong>{{ $orders->note }}</strong></p>
                        </td>
                    </tr>
                    @if($orders->type == 1)
                        <tr>
                            <td>
                                <h3>Nalog za uplatu:</h3>
                                <p>Primalac: <strong>Gradski Sifonjer doo, Suvoborska 19, 11000 Beograd</strong></p>
                                <p>Svrha uplate: <strong>Porudžbina br. {{ $orders->id }}</strong></p>
                                <p>Tekući račun: <strong>150-0000000043511-70</strong></p>
                                <p>Poziv na broj: <strong>0000-{{ $orders->user_id }}-00-{{ $orders->id }}</strong></p>
                                <p>Iznos: <strong>{{$orders->amount }} RSD</strong></p>
                                <p><strong>*Poziv na boj je obavezan</strong></p>
                            </td>
                        </tr>
                    @endif
                    </tbody>

                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>