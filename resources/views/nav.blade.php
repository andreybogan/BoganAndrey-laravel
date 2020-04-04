<li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('home') }}">Главная страница</a>
</li>
<li class="nav-item {{ request()->routeIs('news.index') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('news.index') }}">Новости</a>
</li>
<li class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('about') }}">О проекте</a>
</li>
<li class="nav-item {{ request()->routeIs('admin.index') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.index') }}">Админка</a>
</li>
