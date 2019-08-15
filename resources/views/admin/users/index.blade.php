@extends('admin.layouts.app')


@section('content')

    <div class="box box-primary">
        <div class="box-body">
            <h4><i class="fa fa-fw fa-info-circle"></i>Users </h4>
            <table class="table table-striped table-bordered dt-responsive" id="users-table" cellspacing="0" width="100%"  role="grid">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Email</th>
                        <th>Created</th>
                        <th>Delete</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                paging: true,
                lengthChange: false,
                responsive: true,
                ordering: true,
                info: true,
                autoWidth: false,
                ajax: '{!! url('ci-admin/usersData') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'surname', name: 'surname'},
                    {data: 'email', name: 'email'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
            });

        });
    </script>
@endsection
