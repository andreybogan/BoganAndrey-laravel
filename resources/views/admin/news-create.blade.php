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
        <div style="margin: 0 0 24px 0">
            <a href="{{ route('admin.news.index') }}"><button type="button" class="btn btn-link">Вернуться к списку новостей</button></a>
        </div>

        <div class="card">
            <div class="card-header">Добавление новости</div>

            <div class="card-body">
                <form method="POST"
                      action="@if(!$news->id){{ route('admin.news.create') }}@else{{ route('admin.news.update', $news->id) }}@endif"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <label for="title" class="col-md-3 col-form-label text-md-right">Название</label>

                        <div class="col-md-9">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                   name="title" value="{{ $news->title ?? old('title') }}" required autocomplete="title"
                                   autofocus>

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
                                    <option value="{{ $item->id }}"
                                            @if(in_array($item->id, [$news->category_id, old('category_id')])) selected @endif>{{ $item->title }}</option>
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
                        <textarea id="text" class="form-control @error('text') is-invalid @enderror" name="text"
                                  rows="5" required
                                  autocomplete="text">{{ $news->text ?? old('text') }}</textarea>

                            @error('text')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="image" class="col-md-3 col-form-label text-md-right">Изображение</label>
                        <div class="col-md-9">
                            <input id="image" type="file" name="image">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-9 offset-md-3">
                            <div class="form-check">
                                <input type="checkbox" name="private" value="1" id="private"
                                       @if($news->private == 1 || old('private') == 1) checked @endif>

                                <label class="form-check-label" for="private">
                                    приватная новость
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-3">
                            <button type="submit" class="btn btn-primary">
                                @if($news->id) Изменить @else Добавить @endif новость
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
