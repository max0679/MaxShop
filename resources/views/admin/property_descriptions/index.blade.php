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
                    <h1>Описания свойств категории</h1>
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
                <h3 class="card-title">Описания свойств категории <b>{{ $category->title }}</b></h3>
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
                <div class="mb-3">
                    <a href="{{ route('property_descriptions.create', ['alias' => $category->alias]) }}" class="btn btn-primary">Добавить свойство</a>
                    <a href="{{ route('categories.index') }}" class="btn btn-primary">Вернуться ко всем категориям</a>
                </div>

                @if (count($property_descriptions))

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Номер столбца</th>
                                    <th>Название столбца</th>
                                    <th>Описание</th>
                                    <th style="width: 40px">Действия</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach($property_descriptions as $property_description)

                                <tr>
                                    <td>{{ $property_description->id }}</td>
                                    <td>{{ $property_description->property_column }}</td>
                                    <td>{{ $property_description->property_title }}</td>
                                    <td>{{ $property_description->description }}</td>
                                    <td style="width: 150px">

                                        <a href="{{ route('property_descriptions.edit', ['alias' => $category->alias, 'id' => $property_description->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>

                                        <form action="{{ route('property_descriptions.destroy', ['alias' => $category->alias, 'id' => $property_description->id]) }}" method="post" class="float-left">
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
                    <p>У категории <b>{{ $category->title }}</b> свойств пока нет...</p>
                @endif

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                {{ $property_descriptions->onEachSide(4)->links('vendor.pagination.bootstrap-4') }}
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>

@endsection
