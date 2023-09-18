@extends('layouts.layout')

@section('title')
    @parent - {{ $product->product_title }}
@endsection

@section('content')

{{--    @include('layouts.banners.home.main')--}}

    <!-- Open Content -->
    <section class="bg-light">
        <div class="container pb-5">

            @include('layouts.messages.messages')

            <div class="row pt-4 mb-4">

                <div class="col-7 offset-5">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-el"><a href="{{route('home')}}">Главная</a></li>
                        <li class="breadcrumb-separator"></li>
                        <li class="breadcrumb-el"><a href="{{route('single_category', $product->category->alias)}}">{{ $product->category->title }}</a></li>
                        <li class="breadcrumb-separator"></li>
                        <li class="breadcrumb-el current"><a>{{ $product->title }}</a></li>
                    </ul>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-5">
                    <div class="card mb-3">
                        <img class="card-img img-fluid" src="{{ $product->getPicture() }}" alt="Card image cap" id="product-detail">
                    </div>
                    <div class="row">
                        <!--Start Controls-->
                        <div class="col-1 align-self-center">
                            <a href="#multi-item-example" role="button" data-bs-slide="prev">
                                <i class="text-dark fas fa-chevron-left"></i>
                                <span class="sr-only">Previous</span>
                            </a>
                        </div>
                        <!--End Controls-->
                        <!--Start Carousel Wrapper-->
                        <div id="multi-item-example" class="col-10 carousel slide carousel-multi-item" data-bs-ride="carousel">
                            <!--Start Slides-->
                            <div class="carousel-inner product-links-wap" role="listbox">

                                @php $iter = 0; @endphp

                                @for($i=1; $i<10; $i++)

                                    @php $iter++ @endphp
                                    @if ($iter == 1)
                                        <div class="carousel-item @if ($i==1) active @endif">
                                            <div class="row">
                                    @endif

                                    <div class="col-4">
                                        <a href="#">
                                            <img class="card-img img-fluid" src=" {{ $product->getPicture() }}" alt="Product Image 1">
                                        </a>
                                    </div>

                                    @if ($iter == 3)
                                            </div>
                                        </div>
                                        @php $iter = 0; @endphp
                                    @endif

                                @endfor

                            </div>
                            <!--End Slides-->
                        </div>
                        <!--End Carousel Wrapper-->
                        <!--Start Controls-->
                        <div class="col-1 align-self-center">
                            <a href="#multi-item-example" role="button" data-bs-slide="next">
                                <i class="text-dark fas fa-chevron-right"></i>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <!--End Controls-->
                    </div>
                </div>
                <!-- col end -->
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="h2"> {{ $product->title }}</h1>
                            <p class="h3 mb-4"> {{ $product->price }} &#8381 </p>
                            <div>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-secondary"></i>
                            </div>
                            <div class="mb-4 dop-info">
                                <span>Рейтинг {{ $product->rating }}</span>
                                <span class="dop-info-separator">|</span>
                                <span>{{ $product->count_comments }} комментариев</span>
                                <span class="dop-info-separator">|</span>
                                <span>{{ $product->count_views }} просмотров</span>
                            </div>


                            @if (count($base_properties))

                                <div class="row base-properties">

                                    @foreach($base_properties as $key => $value)

                                        <div class="col-md-5">
                                            <h6> {{ $key }} :</h6>
                                        </div>
                                        <div class="col-md-7">
                                            {{ $value }}
                                        </div>

                                    @endforeach

                                </div>

                            @endif


                            @if (count($category_properties))

                                <div class="row category-properties mb-2 mt-2">

                                @foreach($category_properties as $category_property)

                                    @php $column = $category_property->property_column; @endphp

                                        <div class="col-md-5 category-property-title">
                                            <h6>{{ $category_property->property_title }} : </h6>
                                        </div>
                                        <div class="col-md-7 category-property-value">
                                            {{ $product->$column }}
                                        </div>

                                @endforeach

                                </div>

                            @endif

                            <h6>Описание:</h6>
                            <div class="single-product product-description mb-3">{!! $product->description !!} </div>

                            <form action="" method="GET">
                                <input type="hidden" name="product-title" value="Activewear">
                                <div class="row">
                                    <div class="col-auto">
                                        <ul class="list-inline pb-3">
                                            <li class="list-inline-item">Size :
                                                <input type="hidden" name="product-size" id="product-size" value="S">
                                            </li>
                                            <li class="list-inline-item"><span class="btn btn-success btn-size">S</span></li>
                                            <li class="list-inline-item"><span class="btn btn-success btn-size">M</span></li>
                                            <li class="list-inline-item"><span class="btn btn-success btn-size">L</span></li>
                                            <li class="list-inline-item"><span class="btn btn-success btn-size">XL</span></li>
                                        </ul>
                                    </div>
                                    <div class="col-auto">
                                        <ul class="list-inline pb-3">
                                            <li class="list-inline-item text-right">
                                                Quantity
                                                <input type="hidden" name="product-quanity" id="product-quanity" value="1">
                                            </li>
                                            <li class="list-inline-item"><span class="btn btn-success" id="btn-minus">-</span></li>
                                            <li class="list-inline-item"><span class="badge bg-secondary" id="var-value">1</span></li>
                                            <li class="list-inline-item"><span class="btn btn-success" id="btn-plus">+</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row pb-3">
                                    <div class="col d-grid">
                                        <button type="submit" class="btn btn-success btn-lg" name="submit" value="buy">Buy</button>
                                    </div>
                                    <div class="col d-grid">
                                        <button type="submit" class="btn btn-success btn-lg" name="submit" value="addtocard">Add To Cart</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Close Content -->
@endsection

@section('scripts')

    @parent
    <script src="{{ asset('assets/front/js/custom/ui/single_product.js') }}"></script>


@endsection


