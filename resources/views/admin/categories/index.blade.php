@extends('admin.layouts.layout')  {{-- какой используем шаблон --}}

@section('title')
    @parent - {{ $title }}
@endsection

@section('content')

    <!-- Content Header (Page header) -->
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
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Управление категориями</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Добавить категорию</a>

                @if (count($categories))

                    <tr class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Наименование</th>
                                    <th>Alias</th>
                                    <th>Описание</th>
                                    <th style="width: 40px">Действия</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->title }}
                                        <span class="float-right">
                                            <img src="{{ $category->getPicture() }}" class="mr-2" style="width:100px; height:50px; border: 1px solid black">
                                            <span> <a href="{{ route('property_descriptions', ['alias' => $category->alias]) }}" class="btn btn-primary mr-2"> Свойства категории </a></span>
                                            <span> <a href="{{ route('products.index', ['category_id' => $category->id]) }}" class="btn btn-primary"> Перейти к продуктам </a></span>
                                        </span>
                                    </td>
                                    <td>{{ $category->alias }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td style="width: 150px">

                                        <a href="{{ route('categories.edit', ['id' => $category->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>

                                        @php
                                            $mas_params = ['id' => $category->id];
                                            if (isset($_GET['page'])) {
                                                $mas_params += ['page' => $_GET['page']];
                                            }
                                        @endphp

                                        <form action="{{ route('categories.destroy', $mas_params) }}" method="post" class="float-left">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Подтвердите удаление')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                @else
                    <p>Категорий пока нет...</p>
                @endif

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                {{ $categories->onEachSide(4)->links('vendor.pagination.bootstrap-4') }}
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>

@endsection
