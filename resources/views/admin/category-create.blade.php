{{-- поключаем основной шаблон --}}
@extends('layouts.main')

{{-- title --}}
@section('title')
    Админка | добавление Категории
@endsection

{{-- Основная навигация --}}
@section('nav')
    @include('admin.nav')
@endsection

@section('content')
    <div class="col-md-8">
        <div style="margin: 0 0 24px 0">
            <a href="{{ route('admin.category.index') }}">
                <button type="button" class="btn btn-link">Вернуться к списку категорий</button>
            </a>
        </div>

        <div class="card">
            <div class="card-header">@if($category->id) Изменение @else Добавление @endif категории</div>

            <div class="card-body">
                <form method="POST"
                      action="@if(!$category->id){{ route('admin.category.store') }}@else{{ route('admin.category.update', $category) }}@endif"
                      enctype="multipart/form-data">
                    @csrf
                    @if($category->id) @method('PUT') @endif

                    <div class="form-group row">
                        <label for="title" class="col-md-3 col-form-label text-md-right">Название</label>

                        <div class="col-md-9">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                   name="title" value="{{ empty(old()) ? $category->title : old('title') }}" autocomplete="title"
                                   autofocus>

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-3">
                            <button type="submit" class="btn btn-primary">
                                @if($category->id){{__('Изменить')}}@else{{__('Добавить')}}@endif категорию
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
