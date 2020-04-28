{{-- поключаем основной шаблон --}}
@extends('layouts.main')

{{-- title --}}
@section('title')
    @parent {{ $oneNews->title }}
@endsection

{{-- Основная навигация --}}
@section('nav')
    @include('nav')
@endsection

{{-- Контенти --}}
@section('content')

    <div class="col-md-12">

        @if(($oneNews && !$oneNews->private) || ($oneNews && Auth::check()))
            <h2>{{ $oneNews->title }}</h2>
            <div class="img-news"
                 style="background-image: url({{ $oneNews->image ?? asset('storage/images/default.jpg') }})"></div>
            <div class="text">{!! $oneNews->text !!}</div>
            @if($oneNews->link)
                <p><a href="{{ $oneNews->link }}" target="_blank">Читать полную версию новости</a></p>
            @endif
        @elseif(($oneNews && $oneNews->private) || ($oneNews && Auth::guest()))
            <h2>{{ $oneNews->title }}</h2>
            <p>Эта новость доступна только зарегистрировавшимся пользвователям.</p>
        @else
            <p>Такой новости не существует</p>
        @endif

    </div>

@endsection
