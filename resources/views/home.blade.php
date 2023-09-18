@extends('layouts.layout')

@section('title')
    @parent - главная
@endsection

@section('content')

{{--    @include('layouts.banners.home.main')--}}

    <!-- Start Categories of The Month -->
    <section class="container">
        <div class="row text-center pt-3">
            <div class="col-12 m-auto">
                <h1 class="h1">MaxShop | категории товаров</h1>
                <p>
                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                    deserunt mollit anim id est laborum.
                </p>
            </div>
        </div>


        @include('layouts.messages.messages')

        @if (count($categories))

            <?php
                $count_categories = 0;

                if (count($categories) >= 4) {
                    $count_cols = 4;
                }
                else {
                    $count_cols = count($categories);
                }
            ?>

            @foreach($categories as $category)

                <?php $count_categories++ ?>

                @if ($count_categories == 1 || $count_categories % ($count_cols + 1) == 0)
                    <div class="row">
                @endif

                <div class="col-12 col-md-{{ strval(12 / $count_cols) }} p-5 mt-3" style="text-align: center">
                    <a href="{{route('single_category', $category->alias)}}"><img src="{{$category->getPicture()}}" class="rounded-circle img-fluid border eq-circle"></a>
                    <h5 class="text-center mt-3 mb-3">{{ $category->title }}</h5>
                    <p class="text-center"><a class="btn btn-success" href="{{route('single_category', $category->alias)}}">Перейти</a></p>
                </div>

                @if (($count_categories % $count_cols == 0) || ($count_categories == count($categories) && ($count_categories % $count_cols != 0)))
                    </div>
                @endif

            @endforeach

        @endif

    </section>

@endsection

@section('scripts')

    @parent
    <script src="{{ asset('assets/front/js/custom/ui/home.js') }}"></script>

@endsection


