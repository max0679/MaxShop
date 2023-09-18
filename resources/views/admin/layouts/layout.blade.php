<!DOCTYPE html>
<html lang="en">
<head>

    @section('headers')
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    @show

    <title>@section('title')Админка@show</title>

    @section('styles')
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="{{ asset('assets/admin/css/admin.css') }}">
    @show

</head>
<body class="hold-transition sidebar-mini">

    <div class="wrapper">

        {{-- комментарий шаблонизатора, не виден в дебагере --}}
        @section('header') {{-- дает возможность изменить или перезаписать содержимое (@parent-наследует все содержимое) --}}
            @include('admin.layouts.header')
        @show

        @include('admin.layouts.sidebar')

        <div class="content-wrapper">

            <div class="mt-2 ml-2 mr-2">
                <div class="row">
                    <div class="col-12">

{{--                        @if ($errors->any())--}}
{{--                            <div class="alert alert-danger">--}}
{{--                                <ul class="list-unstyled">--}}
{{--                                    @foreach ($errors->all() as $error)--}}
{{--                                        <li>{{ $error }}</li>--}}
{{--                                    @endforeach--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        @endif--}}

                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session()->has('alert'))
                            <div class="alert alert-danger">
                                {{ session('alert') }}
                            </div>
                        @endif

                    </div>
                </div>
            </div>

            @yield('content')

        </div>

        @include('admin.layouts.footer')

    </div>


    @section('scripts')
        <script src="{{ asset('assets/admin/js/admin.js') }}"></script>
        <script src="{{ asset('assets/admin/js/custom/ui/main.js') }}"></script>
    @show
</body>
</html>
