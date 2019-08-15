@extends('admin.layouts.app')



@section('content')
    <div class="box box-primary">
        <div class="box-body">
            <h4><i class="fa fa-fw fa-info-circle"></i>Order</h4>
            <table class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%"
                   id="orders-table" role="grid">
                <thead>
                <tr>
                    <th>order id</th>
                    <th>email</th>
                    <th>name</th>
                    <th>surname</th>
                    <th>amount</th>
                    <th>type</th>
                    <th>status</th>
                    <th>send</th>
                    <th>action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $(function () {
            var table = $('#orders-table').DataTable({
                processing: true,
                serverSide: true,
                paging: true,
                lengthChange: false,
                ordering: true,
                info: true,
                responsive: true,
                autoWidth: false,
                ajax: '{!! route('ordersData') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'email', name: 'email'},
                    {data: 'name', name: 'name'},
                    {data: 'surname', name: 'surname'},
                     {
                        data: function (data, type, row) {
                            return data.amount + ' RSD';
                        }, name: 'amount'
                    },
                    {
                        data: function (data, type, row) {
                            var t = '';
                            switch (data.type) {
                                case 0:
                                    t = 'Banka';
                                    break;
                                case '1':
                                    t = 'Nalog za uplatu';
                                    break;
                            }
                            return t;
                        }, name: 'type'
                    },
                    {data: 'status', name: 'status', orderable: false, searchable: false},
                    {data: 'action0', name: 'action', orderable: false, searchable: false},
                    {
                        data: 'views',
                        render: function (data, type, row, meta) {
                            return row.views + '' + row.action1
                        }
                    }
                ],
            });
            $('#orders-table tbody').on('click', '[class^="delete"]', function () {
                var ok = confirm("Do you want to delete this order?");
                var id = this.id;
                if (ok) {
                    $.ajax({
                            method: 'DELETE',
                            url: APP_URL + '/ci-admin/orders/' + id,
                            dataType: 'json',
                            success: function (d) {
                                table.ajax.reload();
                            }

                        }
                    );
                }

            });

            // Ajax
            $('body').on('change', ':checkbox', function () {

                $(this).hide().parent().append('<i class="fa fa-refresh fa-spin"></i>');

                var token = $('input[name="_token"]').val();
                var seen = $(this).attr('name');

                if (seen == 'seen') {
                    $(this).parents('tr').toggleClass('danger').toggleClass('default');
                }
                $.ajax({
                    url: APP_URL + '/ci-admin/orders/' + this.value,
                    type: 'PUT',
                    data: seen + "=" + this.checked
                })
                    .done(function () {
                        $('.fa-spin').remove();
                        $('input[type="checkbox"]:hidden').show();
                        table.ajax.reload();
                    })
                    .fail(function () {
                        $('.fa-spin').remove();
                        var chk = $('input[type="checkbox"]:hidden');
                        if (seen == 'seen') {
                            chk.parents('tr').toggleClass('danger').toggleClass('default');
                        }
                        chk.show().prop('checked', chk.is(':checked') ? null : 'checked');
                        alert('Error.');
                    });
            });

            $('body').on('change', '.orderStatus', function (e) {
                console.log($(this).find(":selected").data('status'));

                var token = $('input[name="_token"]').val();
                var status = $(this).find(":selected").data('status');

                $.ajax({
                    url: APP_URL + '/ci-admin/ordersStatus/' + $(this).data('id'),
                    data: "status=" + status ,
                    type: 'PUT',
                    success: function (result) {
                        if (result) {
                            table.ajax.reload();
                        } else {
                            alert('error');
                        }
                    }
                });

                e.preventDefault();
            });

        });
    </script>
@endsection
