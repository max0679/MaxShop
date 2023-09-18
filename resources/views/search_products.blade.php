@extends('layouts.layout')

@section('title')
    @parent - результаты поиска
@endsection

@section('content')

    <div class="container py-1">

        @include('layouts.messages.messages')

        <div class="row mt-5 mb-5">
            <h2>Результаты поиска по запросу "{{ $search }}"</h2>
        </div>

        <div class="row">

            <div class="col-lg-3">

                @include('layouts.sidebar')

            </div>

            <div class="col-lg-9 mb-5">

                @include('layouts.products.products_gallery', ['products' => $products, 'current_place' => 'найденные товары'])

            </div>

        </div>
        <div class="row text-center">
            {{ $products->appends($get_params_mass)->onEachSide(4)->links('vendor.pagination.bootstrap-4-center') }}
        </div>
    </div>

@endsection


@section('scripts')
    @parent
    <script src="{{ asset('assets/front/js/custom/ui/search_products.js') }}"></script>

@endsection


