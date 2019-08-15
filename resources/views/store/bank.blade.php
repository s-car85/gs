@extends('layout')

@section('title', 'Banka')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center flex-wrap flex-lg-nowrap no-gutters">

               <div class="col-sm-12 col-lg-6 col-xl-4">

                    <div class="col-md-12">
                        <div class="pt-5">
                            <div class="pb-3">
                                <h1 class="text-center">
                                   Molimo sačekajte, bitćete poslati na sajt banke.
                                </h1>
                            </div>
                        </div>
                    </div>

                </div>
                <form action="https://bib.eway2pay.com/fim/est3Dgate" method="POST">
                    <input type="hidden" name="failUrl" value="{!! $failurl !!}"/>
                    <input type="hidden" name="currency" value="{!! $currency !!}">
                    <input type="hidden" name="trantype" value="{!! $trantype !!}">
                    <input type="hidden" name="okUrl" value="{!! $okurl !!}">
                    <input type="hidden" name="amount" value="{!! $amount !!}">
                    <input type="hidden" name="oid" value="{!! $oid !!}">
                    <input type="hidden" name="clientid" value="{!! $clientid !!}">
                    <input type="hidden" name="storetype" value="{!! $storetype !!}">
                    <input type="hidden" name="lang" value="{!! $lang !!}">
                    <input type="hidden" name="hashAlgorithm" value="{!! $hashalgorithm !!}">
                    <input type="hidden" name="rnd" value="{!! $rnd !!}">
                    <input type="hidden" name="encoding" value="{!! $encoding !!}">
                    <input type="hidden" name="hash" value="{!! $hash !!}">

                    <input id="send" type="submit" value="ok" class="d-none">
                </form>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('#send').click();

        })();
    </script>
@endsection