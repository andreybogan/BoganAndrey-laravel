{{-- поключаем основной шаблон --}}
@extends('layouts.main')

{{-- title --}}
@section('title')
    @parent Новости
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
                <a href="{{ route('admin.news.create') }}"><button type="button" class="btn btn-primary">Добавить новость</button></a>
            </div>

            <h2>Список новостей</h2>
            <hr>

            @forelse($news as $item)
                <div class="box-card">
                    <div class="card-text">
                        <p class="h5">{{ $item->title }}</p>
                        <div style="margin: 12px 0 24px 0">
                            <a href="{{ route('admin.news.edit', $item->id) }}"><button type="button" class="btn btn-success">Редактировать</button></a>
                            <a href="{{ route('admin.news.destroy', $item->id) }}"><button type="button" class="btn btn-danger">Удалить</button></a>
                            <a href="{{ route('news.show', $item->id) }}" target="_blank"><button type="button" class="btn btn-link">Посмотреть новость</button></a>
                        </div>
                    </div>
                </div>
            @empty
                <p>Нет новостей</p>
            @endforelse

            <div style="margin: 24px 0">
                {{ $news->links() }}
            </div>

        </div>


    </div>

@endsection
