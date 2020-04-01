{{-- поключаем основной шаблон --}}
@extends('layouts.main')

{{-- title --}}
@section('title')
    Админка | главная страница
@endsection

{{-- Основная навигация --}}
@section('nav')
    @include('admin.nav')
@endsection

{{-- Контенти --}}
@section('content')
    <div class="col-md-12">
        <h2>Интерфейс управления!</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid corporis earum eveniet expedita explicabo
            id illo magni nisi nostrum, odit quia quisquam tempore voluptate voluptates.</p>
    </div>
@endsection
