<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('configs_uploads/blogger-backoffice-favicon.png') }}" />

    <title>@yield('title', 'Yönetim Paneli')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ URL::asset('back/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ URL::asset('back/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('back/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @yield('custom-css')
    @toastr_css
</head>
