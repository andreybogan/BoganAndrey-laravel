{{-- поключаем основной шаблон --}}
@extends('layouts.main')

{{-- title --}}
@section('title')
    Админка | добавление новости
@endsection

{{-- Основная навигация --}}
@section('nav')
    @include('admin.nav')
@endsection

@section('content')
<div class="col-md-8">
    <div class="card">
        <div class="card-header">Добавление новости</div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.news.create') }}">
                @csrf

                <div class="form-group row">
                    <label for="title" class="col-md-3 col-form-label text-md-right">Название</label>

                    <div class="col-md-9">
                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                               name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                        @error('title')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="category"
                           class="col-md-3 col-form-label text-md-right">Категория новости</label>

                    <div class="col-md-9">
                        <select id="category" class="form-control @error('category') is-invalid @enderror"
                        name="category_id" required autocomplete="category">
                            <option>Выберите категорию</option>
                            @foreach($categories as $item)
                            <option value="{{ $item['id'] }}" @if($item['id'] == old('category_id')) selected @endif>{{ $item['title'] }}</option>
                                @endforeach
                        </select>

                        @error('category')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="text" class="col-md-3 col-form-label text-md-right">Содержание новости</label>

                    <div class="col-md-9">
                        <textarea id="text" class="form-control @error('text') is-invalid @enderror" name="text" rows="5" required
                                  autocomplete="text">{{ old('text') }}</textarea>

                        @error('text')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-9 offset-md-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="private" value="1"
                                   id="private" {{ old('private') ? 'checked' : '' }} @if(old('private') == 1) checked @endif>

                            <label class="form-check-label" for="private">
                                приватная новость
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-3">
                        <button type="submit" class="btn btn-primary">
                            Добавить новость
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
