{{-- поключаем основной шаблон --}}
@extends('layouts.main')

{{-- title --}}
@section('title')
    @parent {{ $oneNews['title'] }}
@endsection

{{-- Основная навигация --}}
@section('nav')
    @include('nav')
@endsection

{{-- Контенти --}}
@section('content')

    <div class="col-md-12">

        @if($oneNews && !$oneNews['isPrivate'])
            <h2>{{ $oneNews['title'] }}</h2>
            <p>{!! $oneNews['text'] !!}</p>
        @elseif($oneNews && $oneNews['isPrivate'])
            <h2>{{ $oneNews['title'] }}</h2>
            <p>Эта новость доступна только зарегистрировавшимся пользвователям.</p>
        @else
            <p>Такой новости не существует</p>
        @endif

    </div>

@endsection
