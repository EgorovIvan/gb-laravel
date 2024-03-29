<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link @if(request()->routeIs('admin.index')) active @endif" aria-current="page" href="{{ route('admin.index') }}">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Главная
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->routeIs('admin.categories.*')) active @endif" href="{{ route('admin.categories.index') }}">
                    <span data-feather="file" class="align-text-bottom"></span>
                    Категории
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->routeIs('admin.news.*')) active @endif" href="{{ route('admin.news.index') }}">
                    <span data-feather="file" class="align-text-bottom"></span>
                    Новости
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->routeIs('admin.data-sources.*')) active @endif" href="{{ route('admin.data-sources.index') }}">
                    <span data-feather="file" class="align-text-bottom"></span>
                    Источники
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->routeIs('admin.users.*')) active @endif" href="{{ route('admin.users.index') }}">
                    <span data-feather="file" class="align-text-bottom"></span>
                    Профили
                </a>
            </li>
        </ul>
    </div>
</nav>
