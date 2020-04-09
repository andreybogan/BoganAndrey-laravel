{{-- поключаем основной шаблон --}}
@extends('layouts.main')

{{-- title --}}
@section('title')
    @parent Новости | {{ $category->title }}
@endsection

{{-- Основная навигация --}}
@section('nav')
    @include('nav')
@endsection

{{-- Контенти --}}
@section('content')

    <div class="col-md-12">

        <h2>Новости в категории {{ $category->title }}</h2>
        <hr>

        @forelse($news as $item)
            <div class="box-card">
                <div class="card-img" style="background-image: url({{ $item->image ?? asset('storage/images/default.jpg') }})"></div>
                <div class="card-text">
                    <p class="h5">{{ $item->title }}</p>
                    @if(!$item->private)
                        <a href="{{ route('news.view', $item->id) }}">Подробнее...</a>
                    @else
                        <span style="font-size: small; color: #a9a9a9; font-style: italic;">Новость доступна только для зарегистрированных пользователей</span>
                    @endif
                </div>
            </div>
        @empty
            <p>Нет новостей</p>
        @endforelse

    </div>

@endsection
