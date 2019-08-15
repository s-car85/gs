@extends('admin.layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.0/css/rowReorder.dataTables.min.css">
@section('content')

    <div class="box box-primary">
        <div class="box-body">
            <h4><i class="fa fa-fw fa-info-circle"></i>Products</h4>
            <div class="col-md-4">
                Category:
                <select id="table-filter" name="category_id" class="form-control">
                    <option value="-1">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <br>
                <form action="" method="GET" id="fp">
                    <button type="submit" class="btn btn-primary btn-sm" id="np" disabled>New Product <i
                                class="fab fa-product-hunt"></i></button>
                </form>

                <input type="hidden" id="belong" value="{{ $id }}">
            </div>
            <br>
            <table class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%"
                   id="products-table" role="grid">
                <thead>
                <tr>
                    <th>sort</th>
                    <th>category_id</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Qua</th>
                    <th>Price</th>
                    <th>Old price</th>
                    <th>#</th>
                    <th>#</th>
                    <th>#</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script src="//cdn.datatables.net/rowreorder/1.2.0/js/dataTables.rowReorder.min.js"></script>
    <script>
        $(function () {

        // Processing plugin
		jQuery.fn.dataTable.Api.register( 'processing()', function ( show ) {
			return this.iterator( 'table', function ( ctx ) {
				ctx.oApi._fnProcessingDisplay( ctx, show );
			} );
		} );
            $('#table-filter').change();
            var v;
            var belong = $('#belong').val();
            $('#table-filter').on('change', function () {
                v = this.value;
                t.column(1).search(v).draw();
                if (v > 0) {
                    $('#fp').attr('action', APP_URL + '/ci-admin/products/create-prooduct/' + v);
                    $('#np').prop("disabled", false);
                } else {
                    $('#np').prop("disabled", true);
                }
            });

            var t = $('#products-table').DataTable({
                processing: true,
                serverSide: true,
                paging: false,
                lengthChange: false,
                ordering: true,
                info: true,
                responsive: true,
                autoWidth: false,
                ajax: APP_URL + '/ci-admin/productsData/' + belong,
                rowReorder: {
                    dataSrc: 'sort',
                    update: false,
                },
                columns: [
                    {data: 'sort', name: 'sort', className: 'reorder', orderable: false, searchable: false },
                    {data: 'category_id', name: 'category_id'},
                    {data: 'img', name: 'img', 'width': '20px', orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'qua', name: 'qua'},
                    {data: 'price', name: 'price'},
                    {data: 'old_price', name: 'old_price'},
                    {data: 'action2', name: 'action2', 'width': '20px', orderable: false, searchable: false},
                    {data: 'action0', name: 'action', 'width': '20px', orderable: false, searchable: false},
                    {data: 'action1', name: 'action1', 'width': '20px', orderable: false, searchable: false}
                ],
                "columnDefs": [
                    {
                        "targets": [1],
                        "visible": false
                    },

                ]
            });
            // Apply the search
            t.columns().every(function () {
                t.column(1).search($('#table-filter').val()).draw();
            });
            $('#products-table tbody').on('click', '[class^="delete"]', function () {
                var ok = confirm("Do you want to delete this product?");
                var id = this.id;
                if (ok) {
                    $.ajax({
                            method: 'DELETE',
                            url: APP_URL + '/ci-admin/products/' + id,
                            dataType: 'json',
                            success: function (d) {
                                t.ajax.reload();
                            }

                        }
                    );
                }
            });

            // visible
            $('#products-table tbody').on('click', '.visible', function () {
                var id = this.id;
                $.ajax({
                        method: 'put',
                        url: APP_URL + '/ci-admin/products/visible/' + id,
                        dataType: 'json',
                        success: function (d) {
                            t.ajax.reload();
                        }

                    }
                );
            });

            t.on('row-reorder', function (e, diff, edit) {

                t.processing( true );

                var myArray = [];

                for (var i = 0, ien = diff.length; i < ien; i++) {
                    var rowData = t.row(diff[i].node).data();
                    myArray.push({
                        id: rowData.id,			// record id from datatable
                        sort: diff[i].newPosition,		// new position
                    });
                }

                var jsonString = JSON.stringify(myArray);

                $.ajax({
                    url: '{!! route('products.order' ) !!}',
                    type: 'POST',
                    data: jsonString,
                    dataType: 'json',
                    success: function (json) {
                        $('#products-table').DataTable().ajax.reload(); // now refresh datatable
                    }
                });
            });

        });
    </script>
@endsection
