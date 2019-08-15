@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
          media="screen">
    <style>
        .gallery {
            display: inline-block;
            margin-top: 20px;
        }

        .close-icon {
            border-radius: 50%;
            position: absolute;
            right: 5px;
            top: -10px;
            padding: 5px 8px;
        }

        .form-image-upload {
            background: #e8e8e8 none repeat scroll 0 0;
            padding: 15px;
            margin-bottom: 18px;
        }
    </style>
@stop
@extends('admin.layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gallery </h1>
    </div>
    <h3>Image Gallery</h3>
    {{ Form::open(array('url' => 'ci-admin/gallery', 'method' => 'post', 'class' => 'form-image-upload', 'files' => true)) }}

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif


    <div class="row">
        <div class="col-md-5">
            <strong>Title:</strong>
            <input type="text" name="title" class="form-control" placeholder="Title">
        </div>
        <div class="col-md-5">
            <strong>Image:</strong>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="col-md-2">
            <br/>
            <button type="submit" class="btn btn-success">Upload</button>
            <input type="hidden" name="belong" id="belong" value="{{ Request::segment(3) }}">
        </div>
    </div>

    {{ Form::close() }}


    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary  mb-1">Total images</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ($images->count())? $images->count(): '0' }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-images fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


        <div id="gallery" style="max-width: 1000px;">
            @if($images->count())
                @foreach($images as $image)
                    <div class="card col-12 col-sm-4 col-md-3 col-lg-2  float-left  box-shadow float-lg-left" data-id="{{ $image->id }}" style="margin-bottom: 10px; margin-right: 10px;">
                        <a class="thumbnail fancybox" rel="ligthbox" href="{{asset('/upload/'. $image->image)}}"
                             style="padding-bottom: 100%;overflow: hidden;height: 0;display: block;" >
                            <img class="card-img-top img-fluid" alt="{{ $image->title }}"
                                 style="margin-top: 11px; display: block;"
                                 src="{{asset('/upload/'. $image->image)}}" data-holder-rendered="true">
                        </a>
                        <div class="card-body">
                            <p class="card-text"> Poz.:<strong>{{ $image->sort + 1 }}</strong> | {{ $image->title }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    {{ Form::open(array('url' => 'ci-admin/gallery/'.$image->id, 'method' => 'delete')) }}
                                    <button type="submit" class="btn btn-danger btn-circle btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    {{ Form::close() }}
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>

@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $(".fancybox").fancybox({
                openEffect: "none",
                closeEffect: "none"
            });
            $('#gallery').sortable(
                {
                    update: function () {
                        var data = $('#gallery').sortable('toArray', {
                            attribute: 'data-id'
                        });

                        $.ajax({
                            data: {p: data},
                            type: 'POST',
                            dataType: "json",
                            url: APP_URL + '/ci-admin/gallery/sort',
                        });

                        window.location.reload(true);
                    }
                }
            );
        });
    </script>
@stop