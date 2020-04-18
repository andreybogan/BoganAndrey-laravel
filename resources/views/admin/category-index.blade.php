{{-- поключаем основной шаблон --}}
@extends('layouts.main')

{{-- title --}}
@section('title')
    @parent Админка | Управление категориями
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
                <a href="{{ route('admin.category.create') }}">
                    <button type="button" class="btn btn-primary">Добавить категорию</button>
                </a>
            </div>

            <h2>Список категорий</h2>
            <hr>

            @forelse($categories as $item)
                <div class="box-card">
                    <div class="card-text">
                        <p class="h5">{{ $item->title }}</p>
                        <div style="margin: 12px 0 24px 0">
                            <form action="{{ route('admin.category.destroy', $item) }}" method="post">
                                <a href="{{ route('admin.category.edit', $item) }}">
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
                <p>Нет новостей</p>
            @endforelse

            <div style="margin: 24px 0">
                {{ $categories->links() }}
            </div>

        </div>


    </div>

@endsection
