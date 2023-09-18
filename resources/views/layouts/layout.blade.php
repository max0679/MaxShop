<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@section('title')MaxShop @show</title>

    @section('links')
        <link rel="apple-touch-icon" href="{{asset('assets/front/img/apple-icon.png')}}">
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/front/img/favicon.ico')}}">

        <link rel="stylesheet" href="{{ asset('assets/front/css/front.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    @show

</head>
<body>

    <div class="main-area width-100 @if(session()->has('regNotConfirmed') || (session()->has('logNotConfirmed'))) dark-screen @endif" id="main-area">
{{--         комментарий шаблонизатора, не виден в дебагере--}}
        @section('header') {{-- дает возможность изменить или перезаписать содержимое (@parent-наследует все содержимое)--}}
        @include('layouts.header')
        @show

        @yield('content')

        @include('layouts.footer')

    </div>

    @include('layouts.user.login')
    @include('layouts.user.create')


    @section('scripts')

        <script src="{{ asset('assets/front/js/front.js') }}"></script>
        <script src="{{ asset('assets/front/js/custom/service/main.js') }}"></script>
        <script src="{{ asset('assets/front/js/custom/ui/main.js') }}"></script>

    @show

</body>
</html>
