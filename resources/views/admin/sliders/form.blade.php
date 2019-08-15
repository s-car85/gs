@extends('admin.layouts.app')


@section('css')
<link rel="stylesheet" href="{!! asset('assets-admin/css/fileinput.min.css') !!}" type="text/css" charset="utf-8" />
@endsection

@section('content')

    <div class="box box-primary">
        <div class="box-header">
            <h3>{{$slider->exists ? 'Edit' .' '.$slider->title : 'Create slide'}}</h3>
        </div>
        <div class="form-group col-md-10">
            @include('admin.layouts.tmp.alert')
        </div>
        <div class="box-body">
               {!! Form::model($slider, [
                'files' => true,
                'id' => 'photo-form',
                'method' => $slider->exists ? 'put' : 'post',
                'route'  => $slider->exists ?
                 ['sliders.update', $slider->id]:
                 ['sliders.store']
            ]) !!}


            @if($slider->exists)
                {!! Form::hidden('photoId',  $slider->photo_id ,['id' =>'photoId']) !!}
            @else
            <div class="form-group">
                <div class="col-md-4">
                    <label for="pages">Select page:</label>
                    {!! Form::select('photoId', $pages,  null,['class' => 'form-control', 'id' => 'photo_id']) !!}
                </div>
            </div>
            @endif

            <div class="form-group">
                {!! Form::label('title', 'Title') !!}
                {!! Form::text('title', null,['class' => 'form-control']) !!}
            </div>

           <div class="form-group">
                {!! Form::label('description', 'Description') !!}
                {!! Form::text('description', null,['class' => 'form-control']) !!}
            </div>

              <div class="form-group">
                {!! Form::label('path', 'Image') !!}
                {!! Form::file('path', ['class' => 'file', 'data-preview-file-type' => 'text', 'accept' => 'image/*']) !!}
                <div id="path-messagge"></div>
              </div>
            <hr>

            {!! Form::submit($slider->exists ? 'Save': 'Create', ['class' => 'btn btn-primary btn-flat']) !!}
            <a href="{!! url('ci-admin/sliders') !!}" title="Cancel" class="btn btn-danger btn-flat">Cancel</a>

            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/additional-methods.min.js"></script>
    <script src="{!! asset('assets-admin/js/fileinput.min.js') !!}"></script>
    <script src="{!! asset('assets-admin/js/fileinput_locale_sr.js') !!}"></script>

    <script>


        // initialize fileinputs
        $("#path").fileinput({
            language: "en",
            showUpload: false,
            showCaption: false,
            allowedFileExtensions: ["jpg", "jpeg", "png", "gif"],
            previewFileType: "image",
            maxFileSize: 2000,
            browseLabel: 'Select image',
            @if($slider->exists && $slider->thumbnail_path != '')
            initialPreview: [
                '<img src="{!! asset($slider->thumbnail_path) !!}" class="file-preview-image">'
            ],
                @if($slider->path != 'sliders/photos/no-image.png')
                    initialPreviewConfig: [
                        {
                            url: "/ci-admin/image-photos",
                            extra: {
                                pos: 0,
                                _token: "{{ csrf_token() }}",
                                _method: "DELETE",
                                photo_id: "{{$slider->id}}"
                            }
                        }
                    ]
                @endif
            @endif
        });

         var $sliderVal = $('#photo-form').validate({
                validClass: "pass",
                rules: {
                    title: {
                        minlength: 2,
                        maxlength:100,
                        required: true
                    },
                    description: {
                        minlength: 2,
                        maxlength:260,
                        required: true
                    },

                },
                // messages:{
                //     title: {
                //         required: "Unesite naslov.",
                //         minlength: jQuery.validator.format("Unesite bar {0} karaktera."),
                //         maxlength: jQuery.validator.format("Maksimalan broj karaktera je {0}.")
                //     },
                //     description: {
                //         required: "Unesite opis.",
                //         minlength: jQuery.validator.format("Unesite bar {0} karaktera."),
                //         maxlength: jQuery.validator.format("Maksimalan broj karaktera je {0}.")
                //     },
                // },

                highlight: function (element) {
                    $(element).removeClass('success').addClass('error');
                    $(element).closest('.form-group').removeClass('success').addClass('has-error');
                },
                success: function (element) {
                    element.text('OK!').closest('.form-group').removeClass('has-error').addClass('has-success');
                },
                errorPlacement: function(error, element) {
                    if (element.attr('id') == 'path') {
                      error.appendTo("#path-messagge");
                    } else {
                      error.insertAfter(element);
                    }
                  },
                submitHandler: function(form) {

                    form.submit();

                }
            });
    </script>

@stop