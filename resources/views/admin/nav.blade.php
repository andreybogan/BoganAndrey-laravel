<li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('home') }}">Главная страница</a>
</li>
<li class="nav-item {{ request()->routeIs('admin.index') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.index') }}">Админка</a>
</li>

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Меню</a>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="{{ route('admin.news.create') }}">Добавить новость</a>
        <a class="dropdown-item" href="{{ route('admin.downloadJsonCategory') }}">Скачать JSON файл категорий</a>
    </div>
</li>
