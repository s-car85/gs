<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="_token" content="{!! csrf_token() !!}" />
    <script>
        var APP_URL = {!! json_encode(url('/')) !!};
    </script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="uplImgPro" content="{{ route('uplImgPro') }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="{{ asset("admin/css/all.css")}}" >

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{ asset("admin/css/jquery-ui.css")}}" rel="stylesheet" type="text/css" />
    <!-- Styles -->
    <link href="{{ asset('admin/css/sb-admin-2.css') }}" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />
    @yield('css')
    <style>
        .error {
            font-size: 1em;
        }
        .has-error > .error {
            color: #dc3545;
            font-size: 1em;
        }
        .has-success > .error {
            color: #28a745;
            font-size: 1rem;
        }
    </style>
</head>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

@include('admin.layouts.partials.slider')

<!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">

        @include('admin.layouts.partials.top_bar')

        <!-- Begin Page Content -->
            <div class="container-fluid">

                @yield('content')

            </div>
            <!-- /.container-fluid -->

        </div>
        @include('admin.layouts.partials.footer')
    </div>
    <!-- End of Main Content -->
</div>
@include('admin.layouts.partials.footer-script')
</body>
</html>