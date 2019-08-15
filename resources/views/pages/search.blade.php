@extends('layout')

@section('title', 'Pretraga')

@section('content')

    <section id="search-section">
        <div class="container no-gutters">
            <div class="col-sm-12">
                <div class="search-page-input"
                     id="search'input">
                    <div class="spinner-wrapper" hidden="hidden" style="display: none;"></div>
                     {!! Form::open(['url'=>'pretraga','method'=>'GET']) !!}
                        <input placeholder="Pretraga…" type="search" name="q" value="{{isset($term) ? $term : ''}}"  id="search">
                     {!! Form::close() !!}
                </div>
            </div>
            <div class="clearfix"></div>

        @if($products->count())

              <h3>Rezultati tražene pretrage ({{$products->total()}})</h3>
           @foreach($products as $product)

            <div class="search-item">
                <a href="{{ url('proizvod').'/'.str_slug($product->name).'/'.$product->id }}" title="{{ $product->name }}" class="no-gutters">
                    <div class="col-12 py-3 border-bottom  border-top">
                        <div class=" align-items-center d-flex no-gutters">
                            <div class="col-auto align-items-center">
                                <div class="text-center cart-mar">
                                    <img src="{{ url('upload').'/'.json_decode($product->image, true)[0]['normal'] }}"  alt="{{ $product->name }}" width="100">
                                </div>
                            </div>
                            <div class="col">
                                <div class="search-title">
                                    <h5 class="fs--1 fs-sm-0 fw-600">{{ $product->name }}</h5>
                                </div>
                                <div class="search-content">
                                    <span>
                                            @foreach($product->productAddition as $elements)
                                            <div class="form-group col-md-6">
                                                <span>{{ $elements->name }}</span>
                                                @foreach($elements->children as $el)
                                                    {{ $loop->first ? '' : ', ' }}
                                                    {{ $el->name }}
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            @endforeach

             {!! $products->render() !!}
        @else

            <h3>Nema rezultata tražene pretrage.</h3>

        @endif



        </div>
    </section>
@endsection