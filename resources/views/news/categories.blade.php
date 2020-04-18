{{-- поключаем основной шаблон --}}
@extends('layouts.main')

{{-- title --}}
@section('title')
    @parent Категории новостей
@endsection

{{-- Основная навигация --}}
@section('nav')
    @include('nav')
@endsection

{{-- Контенти --}}
@section('content')

    <div class="col-md-12">

        <h2>Категории новостей</h2>

        @forelse ($categories as $item)
            <li><a href="{{ route('news.category.view', $item) }}">{{ $item->title }}</a></li>
        @empty
            <p>Нет категорий</p>
        @endforelse

    </div>

@endsection
