{{-- поключаем основной шаблон --}}
@extends('layouts.main')

{{-- title --}}
@section('title')
    @parent Админка | Управление пользователями
@endsection

{{-- Основная навигация --}}
@section('nav')
    @include('admin.nav')
@endsection

{{-- Контенти --}}
@section('content')

    <div class="col-md-12">

        <div style="margin-top: 24px;">

            <h2>Список пользователей</h2>
            <hr>

            @forelse($users as $item)
                <div class="box-card">
                    <div class="card-text">
                        <p class="h5">{{ $item->name }} ({{ $item->email }})</p>
                        <div style="margin: 12px 0 24px 0">
                            @if($item->is_admin)
                                <a href="{{ route('admin.user.toggleAdmin', $item) }}">
                                    <button type="button" class="btn btn-primary">Удалить из админов</button>
                                </a>
                            @else
                                <a href="{{ route('admin.user.toggleAdmin', $item) }}">
                                    <button type="button" class="btn btn-secondary">Сделать админом</button>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <p>Нет пользователей</p>
            @endforelse

            <div style="margin: 24px 0">
                {{ $users->links() }}
            </div>

        </div>

    </div>

@endsection
