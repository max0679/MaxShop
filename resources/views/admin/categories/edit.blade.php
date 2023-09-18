@extends('admin.layouts.layout')  {{-- какой используем шаблон --}}

@section('title')
    @parent - {{ $title }}
@endsection

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Категории товаров</h1>
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
                <h3 class="card-title">Редактирование категории "{{$category->title}}" </h3>
            </div>

            <form role="form" method="post" action="{{ route('categories.update', ['id' => $category->id]) }}" enctype="multipart/form-data">

                @csrf
                @method('put')

                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Наименование</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ $category->title }}" placeholder="Наименование" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Описание</label>
                        <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="description"  value="{{ $category->description }}" placeholder="Описание">
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="picture">Изображение</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="picture" id="picture"
                                       class="custom-file-input">
                                <label class="custom-file-label" for="picture">Выберите файл</label>
                            </div>
                        </div>
                        <div class="mt-2"><img src="{{ $category->getPicture() }}" class="img-thumbnail" width="200px" alt=""></div>
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
    <script src="{{ asset('assets/admin/js/upload_file.js') }}"></script>
@endsection
