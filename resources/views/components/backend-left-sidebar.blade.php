<div class="card">
    <div class="card-header text-white bg-primary">
        Администрирование
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item {{ $controller == 'PurposesController' ? 'active-nav-item' : '' }}">
            <a href="{{ route('backend.purposes') }}">Назначения</a>
        </li>
        <li class="list-group-item {{ $controller == 'UsersController' ? 'active-nav-item' : '' }}">
            <a href="{{ route('backend.users') }}">Пользователи</a>
        </li>
    </ul>
</div>
