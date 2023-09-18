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
                    <h1>Произвоидели</h1>
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
                <h3 class="card-title">Управление производителями</h3>

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
                <a href="{{ route('manufacturers.create') }}" class="btn btn-primary mb-3">Добавить производителя</a>

                @if (count($manufacturers))

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Страна</th>
                                    <th>Наименование</th>
                                    <th>Описание</th>
                                    <th style="width: 40px">Действия</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach($manufacturers as $manufacturer)
                                <tr>
                                    <td>{{ $manufacturer->id }}</td>
                                    <td>{{ $manufacturer->country->title }}</td>
                                    <td>{{ $manufacturer->title }}
                                        <span> <a href="{{ route('products.index', ['manufacturer_id' => $manufacturer->id]) }}" class="btn btn-primary float-right"> Перейти к продуктам </a></span>
                                    </td>
                                    <td>{{ $manufacturer->description }}</td>
                                    <td>
                                        <a href="{{ route('manufacturers.edit', ['id' => $manufacturer->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>

                                        <form action="{{ route('manufacturers.destroy', ['id' => $manufacturer->id]) }}" method="post" class="float-left">
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
                    <p>Производителей пока нет...</p>
                @endif

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                {{ $manufacturers->onEachSide(4)->links('vendor.pagination.bootstrap-4') }}
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>

@endsection
