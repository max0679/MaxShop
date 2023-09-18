<div class="row">
    <div class="col-md-8">
        {{--                        <h2 class="d-flex fit-content text-decoration-underline">{{ $current_category->title }}</h2>--}}
        <ul class="breadcrumb">
            <li class="breadcrumb-el"><a href="{{route('home')}}">Главная</a></li>
            <li class="breadcrumb-separator"></li>
            <li class="breadcrumb-el current"><a>{{ $current_place }}</a></li>
        </ul>
    </div>
    <div class="col-md-4 pb-4">
        <div class="d-flex">
            <select class="form-control">
                <option>Featured</option>
                <option>A to Z</option>
                <option>Item</option>
            </select>
        </div>
    </div>
</div>


@php $cnt_products = 0; $count_cols = 3; @endphp

@foreach ($products as $product)

    @php $cnt_products++; @endphp

    @if ($cnt_products == 1 || $cnt_products % ($count_cols + 1) == 0)
        <div class="row">
            @endif

            <div class="col-md-4">
                <div class="card mb-4 product-wap rounded-0">
                    <a href="{{ route('single_product', ['alias' => $product->alias]) }}" class="d-block text-decoration-none" style="height:100%; width:100%">
                        <div class="card rounded-0">
                            <img class="card-img rounded-0 img-fluid" style="height:200px" src="{{ $product->getPicture() }}">
                            <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                <ul class="list-unstyled">
                                    <li><p class="btn btn-success text-white mt-4"><i class="far fa-heart"></i></p></li>
                                    <li><p class="btn btn-success text-white mt-0"><i class="far fa-eye"></i></p></li>
                                    <li><p class="btn btn-success text-white mt-0"><i class="fas fa-cart-plus"></i></p></li>
                                </ul>
                            </div>
                        </div>
                        <div class=""> <!-- card-body -->
                            {{--                                        <a href="{{ route('single_product', ['alias' => $product->alias]) }}">--}}
                            <h4 class="text-center mt-3 mb-3"> {{$product->title}} </h4>
                            <div class="description text-center mb-2">
                                {!! $product->description !!}
                            </div>
                            {{--                                        </a>--}}
                            <div class="d-flex">
                                            <span class="ml-2 stars" style="font-size: 5px;">
                                                <i class="text-warning fa fa-star"></i>
                                                <i class="text-warning fa fa-star"></i>
                                                <i class="text-warning fa fa-star"></i>
                                                <i class="text-muted fa fa-star"></i>
                                                <i class="text-muted fa fa-star"></i>
                                            </span>
                                <span style="font-size: 15px; margin-left: auto">
                                                {{ $product->stockStatus->title }}
                                            </span>
                                <span class="ml-1 mr-1" style="">|</span>
                                <span class="mr-2" style="font-size: 15px">
                                                {{$product->count}} шт.
                                            </span>
                            </div>

                            <p class="font-italic font-weight-bolder mr-2" style="float:right">{{ $product->price }} р.</p>

                        </div>
                    </a>
                </div>
            </div>

            @if (($cnt_products % $count_cols == 0) || ($cnt_products == count($products) && ($cnt_products % $count_cols != 0)))
        </div>
    @endif

@endforeach
