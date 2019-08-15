@section('css')
    <style type="text/css">

    </style>

@stop
@extends('admin.layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Products</h1>
    </div>

    @if(isset($ids['id']))
        {{ $ids['id'] }}
    @else

        <!-- The Modal -->
        <div class="modal" id="Modal" style="z-index: 99999999999999;">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Select Category:</h4>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        {!! Form::select('categories', $select, null, ['class'=>'form-control']) !!}
                    </div>


                </div>
            </div>
        </div>
    @endif

@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#Modal').modal({backdrop: 'static', keyboard: false});
            $("select[name='categories']").on('change', function () {
                var id = $(this).val(); // get selected value
                if (id) {
                    window.location = "{{ url('/') }}/ci-admin/products/"+id+"/edit";
                }
                return false;
            });
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