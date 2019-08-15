@section('css')
    <link href="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <style type="text/css">
        .attachment_upload {
            display: none;
        }

        .opacity-img{
            opacity: 0.5;
        }
        .img-preview {
            max-width: 186px;
            max-height: 100px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }


        .popover {
            max-width: 280px;
        }

        .form-control {
            width: 190px;
        }

        #popover_content_wrapper {
            width: 400px;
        }

        #ovq {
            overflow-y: auto;
            height: 200px;
        }

        .media-grid {

        }

        .media-grid li {
            list-style: none;
        }

        .media-grid li button {
            position: absolute;
            bottom: 1px;
            right: 0px;
        }

        .filelist li .progress {
            color: #B0BEC5;
            display: block;
            float: right;
            font-size: 10px;
            text-transform: uppercase;
        }

        .filelist li .cancel {
            color: red;
            cursor: pointer;
            display: block;
            float: right;
            font-size: 10px;
            margin: 0 0 0 10px;
            text-transform: uppercase;
        }

        .filelist li.error .file {
            color: red;
        }

        .filelist li.error .progress {
            color: red;
        }

        .filelist li.error .cancel {
            display: none;
        }

        .product_img {
            height: 457px;
            overflow-y: auto;
        }
        .clickimg{
            width: 100%;
            float: left;
            min-height: 75px;
            margin: 2px;
        }
    </style>

@stop
@extends('admin.layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Products</h1>
    </div>

    <div class="col-xl-12 ">
        @if(isset($product->id))
        {{ Form::open(array('route' => ['products.update', $product->id], 'method' => 'put', 'class' => 'submit', 'id' => 'formProduct', 'files' => true)) }}
        @else
        {{ Form::open(array('route' => 'products.store', 'method' => 'post', 'class' => 'submit', 'id' => 'formProduct', 'files' => true)) }}
        @endif
        <div class="col-xl-6 float-lg-left">
            <div class="card mb-4 py-3 border-bottom-primary">
                <div class="card-header">
                    Product
                    <div class="float-lg-right">
                        <a href="" data-toggle="modal" data-target="#SetImgModal">
                            <i class="fas fa-cogs"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        @if(isset($product->id))
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h6 class="modal-title">Category:</h6>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                    {!! Form::select('category_id', $select, $product->category_id, ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        @endif
                        <div class="form-group col-md-6">
                            {{ Form::label('name', 'Product Name') }}
                            {{ Form::text('name',isset($product->id) ? $product->name : '' ,['class' => 'form-control', 'required']) }}
                            {!! Form::label('qua', 'Qua:') !!}
                            <input type="number" class="form-control " value="{{isset($product->id) ? $product->qua : '1'}}" id="qua" name="qua" required>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group float-lg-left">
                                <div class="main-img-preview">
                                    {{ Form::label('img_1', 'Normal') }}
                                    <div class="clearfix"></div>
                                    <a class="clickimg  {{isset($product->id) ? '' : 'required'}}" id="img_1">
                                        <img class="thumbnail img-preview i1" src="{{isset($product->id) ? asset('/upload/').'/'.json_decode($product->image, true)[0]['normal'].'?'.time() : asset('/upload/img.png')}}"
                                             title="Preview image">
                                    </a>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <input id="i1" name="normal" type="file" class="attachment_upload img_1"
                                               onchange="readURL(this)">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group float-lg-left">
                                <div class="main-img-preview">
                                    {{ Form::label('img_2', 'hover') }}
                                    <div class="clearfix"></div>
                                    <a class="clickimg {{isset($product->id) ? '' : 'required'}}" id="img_2">
                                        <img class="thumbnail img-preview i2" src="{{isset($product->id) ? asset('/upload/').'/'.json_decode($product->image, true)[0]['hover'].'?'.time() : asset('/upload/img.png')}}"
                                             title="Preview image">
                                    </a>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <input id="i2" name="hover" type="file" class="attachment_upload img_2"
                                               onchange="readURL(this)">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        {{ Form::label('note', 'Description') }}
                        <textarea name="note" class="summernote">{{isset($product->id) ? $product->note : ''}}</textarea>
                    </div>

                    <div class="form-group col-md-12">
                        <div class="form-group col-md-6 float-lg-left">
                            {{ Form::label('price', 'Price:') }}
                            {{ Form::text('price', isset($product->id) ? $product->price : '', ['class' => 'form-control', 'required']) }}
                        </div>
                        <div class="form-group col-md-6 float-lg-left">
                            <div class="form-group col-md-1 float-lg-right">
                                <button tabindex="0" type="button" id="element-popover" class="btn"
                                        data-placement="left"
                                        title="Add Element" data-html="true">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            {{ Form::label('price', 'Price old:') }}
                            {{ Form::text('old_price', isset($product->id) ? $product->old_price : '', ['class' => 'form-control']) }}
                        </div>
                    </div>

                    <div class="form-group col-md-12" id="element">

                        <div id="popover_content_wrapper" style="display: none; position: absolute">
                            <div align="right">
                                <div class="form-inline">
                                    <div class="form-group col-md-9 float-lg-left">
                                        <label class="control-label"> Select type </label>
                                        <div class="">
                                            <select class="form-control col-md-12 field" data-type="select" id="set_el">
                                                <option value="0"></option>
                                                <option value="1">Select Element</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 float-lg-left">
                                        <label class="control-label">---</label>
                                        <button type="button" class="btn btn-primary" name="add" id="add">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <hr>
                                    <div class="form-group col-md-12 float-lg-right dynamic_field" id="dynamic_field">

                                    </div>
                                    <div class="form-group col-md-12 float-lg-right">
                                        <button id="save" class="btn btn-info float-lg-left">Save</button>
                                        <button id="cancel" class="btn btn-danger float-lg-right closePop">Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12" id="dynamic"></div>

                    <div class="form-group col-md-12">
                        @if(isset($product->id) && isset($product->productAddition))
                            @foreach($product->productAddition as $elements)
                                <div class="form-group col-md-6 float-lg-left" id="element-{{ $elements->id }}">
                                    <div class="col-md-6 float-lg-right">
                                        {{--<button type="submit" class="editElement btn btn-primary btn-sm" id="{{ $elements->id }}" title="Edit" data-toggle="tooltip"><i class="fas fa-edit"></i></button>--}}
                                        <button type="submit" class="deleteElement btn btn-danger btn-sm" id="{{ $elements->id }}" title="Delete" data-toggle="tooltip"><i class="fas fa-trash"></i></button>
                                    </div>
                                    <label for="color" class="control-label">{{ $elements->name }}</label>
                                    <select class="form-control w-75" name="{{ $elements->name }}" style="min-width: 40px; height: auto">
                                        <option>Selektuj:</option>
                                        @foreach($elements->children as $el)
                                            <option id="{{ $el->id }}" value="{{ $el->value }}">{{ $el->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="form-group col-md-10 float-lg-left">
                        @include('admin.layouts.tmp.alert')
                    </div>
                    <div class="form-group col-md-2 float-lg-right">
                        <textarea name="dynamic_el" id="dynamic_el" cols="30" rows="10" class="d-none"></textarea>
                        <textarea name="dynamic_obj" id="dynamic_obj" cols="30" rows="10" class="d-none"></textarea>
                        <textarea name="images_obj" id="images_obj" cols="30" rows="10" class="d-none"></textarea>

                        @if(!isset($product->id))
                            <input type="hidden" name="category_id" value="{{ $ids }}">
                            {{ Form::hidden('product_id', $ids) }}
                        @endif
                        <button type="button" id="submitClick" class="btn btn-success btn-icon-split float-right">
                                <span class="icon text-white-50">
                                <i class="fas fa-check"></i>
                                </span>
                            <span class="text">Save</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 float-lg-left">
            <div class="card mb-4 py-3 border-bottom-primary">
                <div class="card-header">
                    Product image
                    <div class="float-lg-right">
                        <a href="" data-toggle="modal" data-target="#SetImgProModal">
                            <i class="fas fa-cogs"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <button class="btn-sm btn btn-primary" id="clickUpl"><i class="fas fa-plus"></i></button>
                    <Input type="file" name="images" id="uploadImages" class="d-none" multiple>
                </div>

                <ul class="media-grid">
                </ul>
                <ul class="media-grid product_img">
                    @if(isset($product->id) && isset($product->productImages))
                        @foreach($product->productImages as $image)
                            <li class="float-lg-left col-md-2 " id="{{ $image->id }}" name="{{ $image->id }}">
                                <a href="#" class="delmg" id="img-{{ $image->id }}">
                                    <img class="img-fluid" src="{{ asset("upload/".$image->filename) }}">
                                    <span class="btn btn-danger btn-sm float-lg-left"><i class="fas fa-times"></i></span>
                                    </a>
                                </li>
                        @endforeach
                    @endif
                </ul>
                <div class="card-footer text-muted">
                    <div class="progress">Ready...</div>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>

    @include('admin.layouts.tmp.settings_element')
    @include('admin.layouts.tmp.settings_image')
    @include('admin.layouts.tmp.settings_image_product')


@endsection
@section('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="{{ asset('admin/js/products.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $('select[name="categories"]').val(@if(isset($ids['id'])){{ $ids['id'] }} @endif )
        });
    </script>
@stop
