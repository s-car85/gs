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
            <div class="card mb-4 py-3 border-bottom-primary">
                <div class="card-body">
                    <h4>Add new category</h4>
                    {{ Form::open(array('url' => 'ci-admin/categories', 'method' => 'post')) }}
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            {{ Form::label('name', 'Categories Name') }}
                            {{ Form::text('name', '', ['class' => 'form-control']) }}
                            {{ Form::label('description', 'Description') }}
                            {{ Form::textarea('description', '', ['class' => 'form-control', 'rows' => 5]) }}
                        </div>
                        @include('admin.layouts.tmp.select_tree')
                        <div class="form-group col-md-10">
                            @include('admin.layouts.tmp.alert')
                        </div>
                        <div class="form-group col-md-2">
                            {{ Form::hidden('belong', $b['belong']) }}
                            <button type="submit" class="btn btn-success btn-icon-split float-right">
                                <span class="icon text-white-50">
                                <i class="fas fa-check"></i>
                                </span>
                                <span class="text">Save</span>
                            </button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        @include('admin.layouts.tmp.total_category')

    </div>
    <div class="col-xl-12 float-lg-left">
        <ul class="list-group list-group-sortable-handles cat col-xl-12" id="cat">
            @foreach($data as $category)
                @if(isset($category->children))
                    <li class="list-group-item" draggable="true" id="{{ $category->id }}">
                        <span class="f"></span>
                        {{ $category->name }}
                        <div class="float-lg-right">
                            <a href="#" class="btn btn-info btn-circle btn-sm handle">
                                <i class="fas fa-arrows-alt"></i>
                            </a>
                            <div class="btn-group">
                                {{ Form::open(array('url' => 'ci-admin/categories/visible/'.$category->id, 'method' => 'put')) }}
                                <button type="submit" class="btn btn-primary btn-circle btn-sm">
                                    <i class="fas {{$category->visible === 1? 'fa-eye': 'fa-eye-slash'}}"></i>
                                </button>
                                {{ Form::close() }}
                            </div>
                            <a href="{{ url('ci-admin/categories/'.$category->id.'/edit/') }}"
                               class="btn btn-warning btn-circle btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <div class="btn-group">
                                {{ Form::open(array('url' => 'ci-admin/categories/'.$category->id, 'method' => 'delete')) }}
                                <button type="submit" class="btn btn-danger btn-circle btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                                {{ Form::close() }}
                            </div>
                        </div>
                        <hr class="sidebar-divider">
                        <ul class="children">
                            @foreach($category->children as $cat)
                                <li class="list-group-item" id="{{ $cat->id }}">
                                    <span class="f"></span>
                                    {{ $cat->name }}
                                    <div class="float-lg-right">
                                        <a href="#" class="btn btn-info btn-circle btn-sm handle">
                                            <i class="fas fa-arrows-alt"></i>
                                        </a>
                                        <div class="btn-group">
                                            {{ Form::open(array('url' => 'ci-admin/categories/visible/'.$cat->id, 'method' => 'put')) }}
                                            <button type="submit" class="btn btn-primary btn-circle btn-sm">
                                                <i class="fas {{$cat->visible === 1? 'fa-eye': 'fa-eye-slash'}}"></i>
                                            </button>
                                            {{ Form::close() }}
                                        </div>
                                        <a href="{{ url('ci-admin/categories/'.$cat->id.'/edit/') }}"
                                           class="btn btn-warning btn-circle btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <div class="btn-group">
                                            {{ Form::open(array('url' => 'ci-admin/categories/'.$cat->id, 'method' => 'delete')) }}
                                            <button type="submit" class="btn btn-danger btn-circle btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            {{ Form::close() }}
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li class="list-group-item" draggable="true" id="{{ $category->id }}">
                        <span class="f"></span>
                        {{ $category->name }}
                        <div class="float-lg-right">
                            <a href="#" class="btn btn-info btn-circle btn-sm handle">
                                <i class="fas fa-arrows-alt"></i>
                            </a>
                            <div class="btn-group">
                                {{ Form::open(array('url' => 'ci-admin/categories/visible/'.$category->id, 'method' => 'put')) }}
                                <button type="submit" class="btn btn-primary btn-circle btn-sm">
                                    <i class="fas {{$category->visible === 1? 'fa-eye': 'fa-eye-slash'}}"></i>
                                </button>
                                {{ Form::close() }}
                            </div>
                            <a href="{{ url('ci-admin/categories/'.$category->id.'/edit/') }}"
                               class="btn btn-warning btn-circle btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <div class="btn-group">
                                {{ Form::open(array('url' => 'ci-admin/categories/'.$category->id, 'method' => 'delete')) }}
                                <button type="submit" class="btn btn-danger btn-circle btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>

@endsection
@section('js')

    <script type="text/javascript">
        $(document).ready(function () {
            $('.cat').sortable(
                {
                    handle: ".handle",
                    cursor: "move",
                    update: function () {
                        var data = $('#cat').sortable('toArray', {
                            attribute: 'id'
                        });
                        sort(data)
                    }
                }
            );

            $('.children').sortable(
                {
                    handle: ".handle",
                    cursor: "move",
                    update: function () {
                        var data = $('.children').sortable('toArray', {
                            attribute: 'id'
                        });
                        sort(data)
                    }
                }
            );
            function sort(data) {
                $.ajax({
                    data: {p: data},
                    type: 'POST',
                    dataType: "json",
                    url: APP_URL + '/ci-admin/categories/sort'
                });
            }
        });
    </script>
@stop