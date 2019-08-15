@extends('layout')

@section('title',  $product->name )
@section('meta-desc', strip_tags($product->note))
@section('og-title',  $product->name )
@section('og-description', strip_tags($product->note))
@section('og-image', url('upload').'/'.json_decode($product->image, true)[0]['normal'])

@section('style')
    <link href="{{ asset('libs/lightbox2/dist/css/lightbox.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('libs/easyzoom/easyzoom.css') }}">
    <style>
        .toggle{
            /*cursor: zoom-in;*/
        }
        .err{
            border: 1px solid #ff0001!important;
        }
        .b-lazy {
            -webkit-transition: opacity 500ms ease-in-out;
            -moz-transition: opacity 500ms ease-in-out;
            -o-transition: opacity 500ms ease-in-out;
            transition: opacity 500ms ease-in-out;
            max-width: 100%;
            opacity: 0;
        }
        .b-lazy.b-loaded {
            opacity: 1;
        }
    </style>
@endsection

@section('content')

<section id="page-single-product" class="products-section">
    <div class="container">

        {{--BREDCRUMB I PAGINATION--}}
        <nav class="product-nav">
            <div class="product-breadcrumb">
                <div class="d-flex align-items-center">
                    <a href="{{ url('prodavnica').'/'.str_slug($product->category->name).'/'.$product->category->id }}" class="breadcrumb-link" title="Trendi">{{ $product->category->name }}</a>
                    <span class="breadcrumb-separator"></span>
                    <span href="#" class="breadcrumb-link">{{ $product->name }}</span>
                </div>
            </div>

            <div class="product-pagination">
                <div class="d-flex align-items-center">
                    @if (isset($previous))
                        <a href="{!! $previous->id !!}" class="pagination-link-prev">prethodni</a>
                    @else
                        <a class="pagination-link-prev">prethodni</a>
                    @endif
                    <span class="nav-pagination-separator"></span>
                    @if (isset($next))
                        <a href="{{ $next->id }}" class="pagination-link-next">sledeći</a>
                    @else
                        <a class="pagination-link-next">sledeći</a>
                    @endif
                </div>
            </div>
        </nav>


        <div class="row">
            <div class="col-lg-8 pt-5">
                <div class="row thumbnails">
                    @foreach($product->productImages as $image)
                        <div class="col-12 mb-4">
                            <div >
                                <a href="{{ asset("upload/".$image->filename) }}" data-lightbox="image" data-title="{!! $product->name !!}" class="toggle" data-order="{{ $image->id }}">
                                     <img class="w-100 b-lazy"  src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset("upload/".$image->filename) }}" alt="">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4 product">
                <div class="sticky-top pt-5">
                    <h1>{{ $product->name }}</h1>
                    <h3 class="product-price">{{ number_format($product->price, 2) }} RSD
                        @if($product->old_price)
                            <del class="color-7 fw-300 fs-2">{{ number_format($product->old_price, 2) }} RSD</del>
                        @endif
                    </h3>
                    <div class="product-desc">
                        {!! $product->note !!}
                    </div>
                    {{ Form::open(array('route' => ['addCart', $product->id], 'method' => 'post', 'id' => 'submit')) }}
                    <div class="form-row mt-6 mt-4 mb-2 req">
                        @foreach($product->productAddition as $elements)
                            <div class="form-group col-md-6">
                                <label for="color" class="control-label">{{ $elements->name }}</label>
                                <select class="form-control w-75" name="{{ $elements->name }}" style="min-width: 40px; height: auto">
                                    <option>Selektuj:</option>
                                    @foreach($elements->children as $el)
                                        <option id="{{ $el->id }}" value="{{ $el->value }}">{{ $el->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="qty" class="control-label">Količina:</label>
                            <input id="qty" type="number" class="form-control w-50" name="qty" min="1" max="100"  value="1" step="1">
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="button" id="addCart" class="main-btn">Dodaj u korpu</button>
                        @if (session()->has('success')) <span> {{ session('success') }} </span> @endif
                    </div>
                    <div class="mt-4 mb-4">
                        <ul class="social-share">
                            <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ request()->url()  }}" target="_blank" title="Facebook"><i class="icon-facebook"></i></a></li>
                            <li><a href="https://twitter.com/intent/tweet?url={{ request()->url()  }}" target="_blank" title="Twitter"><i class="icon-twitter"></i></a></li>
                            <li><a href="https://pinterest.com/pin/create/bookmarklet/?url={{ request()->url()  }}" target="_blank" title="Pinterest"><i class="icon-pinterest"></i></a></li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <!--/.row-->
    </div>
    <!--/.container-->
</section>

@endsection

@section('scripts')
    <script src="{{ asset('js/blazy.min.js') }}"></script>
    <script src="{{ asset('libs/lightbox2/dist/js/lightbox.js') }}"></script>
    <script>
        lightbox.option({
            "showImageNumberLabel" : false,
            "wrapAround" : true
        })
    </script>
    <script>
        ;(function() {
            // Initialize
            var bLazy = new Blazy();
        })();
    </script>
    {{--<script src="{{ asset('libs/easyzoom/easyzoom.js') }}"></script>--}}
    <script>
        function validate(el) {
            $(':input, :selected').removeClass('err');
            var check = true;
            $(el).each(function (key, val) {
                if ($(val).attr('id') == undefined) {
                    $(this).parent().parent().find('select').addClass('err');
                    check = false;
                }
            });
            return check;
        }
        /* Social share icons popup */
        var popupSize = {
            width: 780,
            height: 550
        };

        $(document).on('click', '#addCart', function(e){
            if (validate($('#submit:input, #submit option:selected')) === true){
                $('#submit').submit();
            }
        });
        $(document).on('click', '.social-share ul > li > a', function(e){

            var
                verticalPos = Math.floor(($(window).width() - popupSize.width) / 2),
                horisontalPos = Math.floor(($(window).height() - popupSize.height) / 2);

            var popup = window.open($(this).prop('href'), 'social',
                'width='+popupSize.width+',height='+popupSize.height+
                ',left='+verticalPos+',top='+horisontalPos+
                ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');

            if (popup) {
                popup.focus();
                e.preventDefault();
            }

        });







            // $(document).ready(function () {
            //     // Setup thumbnails example
            //     if ($(window).width() > 768) {
            //          var $easyzoom = $('.easyzoom').easyZoom();
            //            var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');
            //     }
            // });

        /*<div class="row thumbnails">
            <div class="col-12 mb-4">
            <div class="easyzoom easyzoom--overlay">
            <a href=""  class="toggle" data-order="">
            <img class="w-100" src="" alt="">
            </a>
            </div>
            </div>
            </div>*/

    </script>
@endsection