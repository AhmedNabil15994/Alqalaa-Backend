<!DOCTYPE html>
<html lang="{{locale()}}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Creative Tim">
    <title>@yield('title', '--') || {{ setting('app_name',locale()) }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ setting('favicon') ? url(setting('favicon')) : '' }}" />
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css"
          rel="stylesheet">
    <link href="{{asset('frontend/vendor/nucleo/css/nucleo.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="{{asset('frontend/css/argon.css?v=1.1.0')}}" rel="stylesheet">
    <link type="text/css" href="{{asset('inspina/js/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
    @yield('style')
</head>
{{--UPLOAD--}}
<body>