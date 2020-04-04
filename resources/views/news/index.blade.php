{{-- поключаем основной шаблон --}}
@extends('layouts.main')

{{-- title --}}
@section('title')
    @parent Новости
@endsection

{{-- Основная навигация --}}
@section('nav')
    @include('nav')
@endsection

{{-- Контенти --}}
@section('content')

    <div class="col-md-12">

        <div>

            <h2>Категории новостей</h2>

            @foreach($categories as $item)
                <a href="{{ route('news.category.view', $item['url']) }}">
                    <button type="button" class="btn btn-dark">{{ $item['title'] }}</button>
                </a>
            @endforeach

        </div>

        <div style="margin-top: 24px;">

            <h2>Последние новости</h2>

            @forelse($news as $item)
                <p class="h5">{{ $item['title'] }}</p>
                @if(!$item['isPrivate'])
                    <a href="{{ route('news.view', $item['id']) }}">Подробнее...</a>
                @else
                    <span style="font-size: small; color: #a9a9a9; font-style: italic;">Новость доступна только для зарегистрированных пользователей</span>
                @endif
                <hr>
            @empty
                <p>Нет новостей</p>
            @endforelse

        </div>


    </div>

@endsection
