<li class="nav-item active">
    <span class="nav-link">Админка: </span>
</li>

<li class="nav-item {{ request()->routeIs('admin.index') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.index') }}">Главная</a>
</li>

<li class="nav-item {{ request()->routeIs('admin.news.index') || request()->routeIs('admin.news.create') || request()->routeIs('admin.news.update') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.news.index') }}">Новости</a>
</li>

<li class="nav-item {{ request()->routeIs('admin.category.index') || request()->routeIs('admin.category.create') || request()->routeIs('admin.category.update') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.category.index') }}">Категории</a>
</li>

<li class="nav-item {{ request()->routeIs('admin.user.show') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.user.index') }}">Пользователи</a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.downloadJsonCategory') }}">Скачать JSON файл категорий</a>
</li>
