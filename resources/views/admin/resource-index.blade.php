{{-- поключаем основной шаблон --}}
@extends('layouts.main')

{{-- title --}}
@section('title')
    @parent Админка | Управление RSS ресурсами
@endsection

{{-- Основная навигация --}}
@section('nav')
    @include('admin.nav')
@endsection

{{-- Контенти --}}
@section('content')

    <div class="col-md-12">

        <div style="margin-top: 24px;">

            <div style="margin: 24px 0">

                <a href="{{ route('admin.resource.create') }}">
                    <button type="button" class="btn btn-primary">Добавить RSS ресурс</button>
                </a>

                <a href="{{ route('admin.parser') }}">
                    <button type="button" class="btn btn-primary">Спарсить новости</button>
                </a>

            </div>

            <h2>Список RSS ресурсов</h2>
            <hr>

            @forelse($resources as $item)
                <div class="box-card">
                    <div class="card-text">
                        <p class="h5">{{ $item->title }}</p>
                        <p>{{ $item->url }}</p>
                        <div style="margin: 12px 0 24px 0">
                            <form action="{{ route('admin.resource.destroy', $item) }}" method="post">
                                <a href="{{ route('admin.resource.edit', $item) }}">
                                    <button type="button" class="btn btn-success">Редактировать</button>
                                </a>
                                <button type="submit" class="btn btn-danger">Удалить</button>
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p>RSS ресурсов</p>
            @endforelse

            <div style="margin: 24px 0">
                {{ $resources->links() }}
            </div>

        </div>


    </div>

@endsection
