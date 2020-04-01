{{-- поключаем основной шаблон --}}
@extends('layouts.main')

{{-- title --}}
@section('title')
    @parent О проекте
@endsection

{{-- Основная навигация --}}
@section('nav')
    @include('nav')
@endsection

{{-- Контенти --}}
@section('content')
    <div class="col-md-12">
        <h2>О нашем проекте</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid corporis earum eveniet expedita explicabo
            id illo magni nisi nostrum, odit quia quisquam tempore voluptate voluptates.</p>
    </div>
@endsection
