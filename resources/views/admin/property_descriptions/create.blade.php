@extends('admin.layouts.layout')  {{-- какой используем шаблон --}}

@section('title')
    @parent - {{ $title }}
@endsection

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Свойства категории</h1>
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
                <h3 class="card-title">Создание свойства у категории {{ $category->title }}</h3>
            </div>

            <form role="form" method="post" action="{{ route('property_descriptions.store', ['alias' => $category->alias]) }}">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label for="property_column">Столбец №</label>
                        <select class="form-control" id="property_column" name="property_column">
                            @foreach($free_columns as $id => $title)
                                <option value="{{ $id }}">{{ $title }}</option>
                            @endforeach
                        </select>
                        @error('property_column')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="property_title">Название свойства</label>
                        <input type="text" name="property_title" class="form-control @error('property_title') is-invalid @enderror" id="property_title" value="{{ old('property_title') }}" placeholder="Название свойства" required>
                        @error('property_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Комментарий</label>
                        <textarea name="description" id="description" class="form-control" rows="5" placeholder="Описание" value="{{ old('description') }}"></textarea>
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
