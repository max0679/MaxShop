@extends('layouts.layout')

@section('title')
    @parent - {{ $current_category->title }}
@endsection

@section('content')

    @include('layouts.messages.messages')

    <div class="container py-5">
        <div class="row">

            <div class="col-lg-3">

                @include('layouts.sidebar')

            </div>

            <div class="col-lg-9 mb-5">

                @include('layouts.products.products_gallery', ['products' => $products, 'current_place' => $current_category->title])

            </div>

        </div>
        <div class="row text-center pagination">
            {{ $products->appends($get_params_mass)->onEachSide(4)->links('vendor.pagination.bootstrap-4-center') }}
        </div>
    </div>

@endsection


@section('scripts')
    @parent
    <script src="{{ asset('assets/front/js/custom/ui/single_category.js') }}"></script>

@endsection


