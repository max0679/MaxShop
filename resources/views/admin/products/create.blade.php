@extends('admin.layouts.layout')  {{-- какой используем шаблон --}}

@section('title')
    @parent - {{ $title }}
@endsection

@section('headers')
    @parent
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Товары</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Создание товаров</h3>
            </div>

            <form role="form" method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Наименование</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title') }}" placeholder="Наименование" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="category_id">Категория</label>
                        <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                            @if (!array_key_exists('category_id', $get_params_mass)) <option selected disabled>Выберите категорию</option> @endif

                            @foreach($categories as $id => $title)
                                <option value="{{ $id }}" @if (array_key_exists('category_id', $get_params_mass) && $id == $get_params_mass['category_id']) selected @endif>{{ $title }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="manufacturer_id">Производитель</label>
                        <select class="form-control" id="manufacturer_id" name="manufacturer_id">
                            @foreach($manufacturers as $id => $title)
                                <option value="{{ $id }}" @if (array_key_exists('manufacturer_id', $get_params_mass) && $id == $get_params_mass['manufacturer_id']) selected @endif>{{ $title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="price">Цена</label>
                        <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" id="price" value="{{ old('price') }}" placeholder="Цена" required>
                        @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="count">Количество</label>
                        <input type="text" name="count" class="form-control @error('count') is-invalid @enderror" id="count" value="{{ old('count') }}" placeholder="Количество" required>
                        @error('count')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status_id">Статус</label>
                        <select class="form-control" id="status_id" name="status_id">
                            @foreach($stock_statuses as $id => $title)
                                <option value="{{ $id }}">{{ $title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="data-page" hidden data-page="create"></div>

                    <div id="category_properties">

                        @if($category_properties)

                            @foreach($category_properties as $property_column => $property_title)

                                <div class="form-group">
                                    <label for="{{ $property_column }}">{{ $property_title }}</label>
                                    <input type="text" name="{{ $property_column }}" class="form-control @error("property_column") is-invalid @enderror" value="{{ old("property_column") }}" placeholder="{{ $property_title }}">
                                    @error("property_column")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            @endforeach

                        @endif

                    </div>



                    <div class="form-group">
                        <label for="description">Описание</label>
                        <textarea name="description" id="description" class="form-control" rows="5" placeholder="Описание" value="{{ old('description') }}"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="picture">Изображение</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="picture" id="picture" class="custom-file-input">
                                <label class="custom-file-label" for="picture">Выберите файл</label>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->


                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>

        </div>


    </section>

@endsection


@section('scripts')
    @parent
    <script src="{{ asset('assets/admin/plugins/ckeditor5/build/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/ckfinder/ckfinder.js') }}"></script>
    <script src="{{ asset('assets/admin/js/custom/for_ckfinder.js') }}"></script>
    <script src="{{ asset('assets/admin/js/upload_file.js') }}"></script> {{-- пишется путь картинки при загрузке --}}
    <script src="{{ asset('assets/admin/js/custom/ui/products.js') }}"></script>

@endsection
