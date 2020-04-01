{{-- поключаем основной шаблон --}}
@extends('layouts.main')

{{-- title --}}
@section('title')
    @parent Главная страница
@endsection

{{-- Основная навигация --}}
@section('nav')
    @include('nav')
@endsection

{{-- Контенти --}}

@section('content')
    <div class="col-md-12">
        <h2>Добро пожаловать на главную страницу!</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid corporis earum eveniet expedita explicabo
            id illo magni nisi nostrum, odit quia quisquam tempore voluptate voluptates.</p>
    </div>
@endsection
