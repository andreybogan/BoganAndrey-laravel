{{-- поключаем основной шаблон --}}
@extends('layouts.main')

{{-- title --}}
@section('title')
    Админка | добавление RSS ресурсов
@endsection

{{-- Основная навигация --}}
@section('nav')
    @include('admin.nav')
@endsection

@section('content')
    <div class="col-md-8">
        <div style="margin: 0 0 24px 0">
            <a href="{{ route('admin.resource.index') }}">
                <button type="button" class="btn btn-link">Вернуться к списку RSS ресурсов</button>
            </a>
        </div>

        <div class="card">
            <div class="card-header">@if($resource->id) Изменение @else Добавление @endif RSS ресурсов</div>

            <div class="card-body">
                <form method="POST"
                      action="@if(!$resource->id){{ route('admin.resource.store') }}@else{{ route('admin.resource.update', $resource) }}@endif"
                      enctype="multipart/form-data">
                    @csrf
                    @if($resource->id) @method('PUT') @endif

                    <div class="form-group row">
                        <label for="title" class="col-md-3 col-form-label text-md-right">Название</label>

                        <div class="col-md-9">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                   name="title" value="{{ empty(old()) ? $resource->title : old('title') }}" autocomplete="title"
                                   autofocus>

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="url" class="col-md-3 col-form-label text-md-right">URL адрес</label>

                        <div class="col-md-9">
                            <input id="url" type="text" class="form-control @error('url') is-invalid @enderror"
                                   name="url" value="{{ empty(old()) ? $resource->url : old('url') }}" autocomplete="url"
                                   autofocus>

                            @error('url')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-3">
                            <button type="submit" class="btn btn-primary">
                                @if($resource->id){{__('Изменить')}}@else{{__('Добавить')}}@endif RSS ресурс
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
