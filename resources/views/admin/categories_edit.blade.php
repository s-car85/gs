@section('css')
    <style type="text/css">

    </style>

@stop
@extends('admin.layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Categories </h1>
    </div>

    <div class="col-xl-12 ">
        <div class="col-xl-6 float-lg-left">
            <div class="card mb-4 py-3 border-bottom-warning">
                <div class="card-body">
                    <h4>Edit category</h4>
                    {{ Form::open(array('url' => 'ci-admin/categories/'.$category->id, 'method' => 'put')) }}
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            {{ Form::label('name', 'Categories Name') }}
                            {{ Form::text('name', $category->name, ['class' => 'form-control']) }}
                            {{ Form::label('description', 'Description') }}
                            {{ Form::textarea('description', $category->description, ['class' => 'form-control', 'rows' => 5]) }}
                        </div>
                        @include('admin.layouts.tmp.select_tree')
                        <div class="form-group col-md-8">
                            @include('admin.layouts.tmp.alert')
                        </div>
                        <div class="form-group col-md-2">
                            <button type="submit" class="btn btn-warning btn-icon-split float-right">
                                <span class="icon text-white-50">
                                <i class="fas fa-check"></i>
                                </span>
                                <span class="text">Save</span>
                            </button>
                        </div>
                        <div class="form-group col-md-2">
                            <a href="{{ url('ci-admin/categories/'.$category->belong) }}" class="btn btn-primary btn-icon-split float-right">
                                <span class="icon text-white-50">
                                <i class="fas fa-check"></i>
                                </span>
                                <span class="text">Cancel</span>
                            </a>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')

    <script type="text/javascript">

    </script>
@stop