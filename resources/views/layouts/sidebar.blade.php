@section('sidebar')

    <h1 class="h2 pb-1">Категории</h1>

    @if (count($categories))

        <ul class="mtree bubba">

            <li class="all-products"><a href="{{ route('all_products') }}" class="all-products">Все товары</a> </li>

            @foreach($categories as $category)

                {{-- products_count - см. AppServiceProvider withCount('products') --}}
                <li @if (!$category->products_count)) class="empty-category" @endif>
                    <a href="#" @if (!$category->products_count) class="disabled" @endif>{{ $category->title }}
                        <span class="count=products">@if ($category->products_count) ( {{ $category->products_count }} ) @endif</span>
                    </a>

                    @if (count($category->products))

                        <ul>

                            <li class="all-category-products"><a href=" {{ route('single_category', $category->alias) }} "> Все товары </a></li>

                            @foreach($category->products as $product)

                                <li><a href=" {{ route('single_product', $product->alias) }} "> {{$product->title}} </a></li>

                            @endforeach

                        </ul>

                    @endif

                </li>

            @endforeach

        </ul>

    @endif

@show
