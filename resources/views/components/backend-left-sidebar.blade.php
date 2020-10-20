<div class="card">
    <div class="card-header text-white bg-primary">
        <h4>Разделы системы</h4>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item {{ $controller == 'PurposesController' ? 'active-nav-item' : '' }}">
            <a href="{{ route('backend.purposes') }}">Назначения</a>
        </li>
        <li class="list-group-item {{ $controller == 'CustomersController' ? 'active-nav-item' : '' }}">
            <a href="{{ route('backend.customers') }}">Заказчики</a>
        </li>
        <li class="list-group-item {{ $controller == 'DepotsController' ? 'active-nav-item' : '' }}">
            <a href="{{ route('backend.depots') }}">Депо приписки</a>
        </li>
        <li class="list-group-item {{ $controller == 'UsersController' ? 'active-nav-item' : '' }}">
            <a href="{{ route('backend.users') }}">Пользователи</a>
        </li>
    </ul>
</div>
@if($controller != 'DashboardController')
    <div class="card mt-3">
        <div class="card-header text-dark bg-light">
            <h4>Помощь по разделу</h4>
        </div>
        <div class="card-body">
            @if($controller == 'PurposesController')
                Этот раздел предназначен для создания, редактирования и удаления так называемых
                <strong>назначений</strong>,
                для которых планируется использование локомотива.
                <br>
                Для создания нового назначения&nbsp;&mdash; кнопка
                <div class="text-center mt-1">
                    <button type="button" class="btn btn-success">Создать</button>
                </div>
                <br>
                Для редактирования или удаления назначения предназначены кнопки в колонке "Операции":
                <div class="text-center mt-1">
                    <button class="btn btn-sm btn-primary fa fa-edit mr-2" title="Редактировать"></button>
                    <button class="btn btn-sm btn-danger fa fa-trash-alt" title="Удалить"></button>
                </div>
            @elseif($controller == 'CustomersController')
                Этот раздел предназначен для создания, редактирования и, возможно, удаления организаций, формирующих заявки на локомотивы.
                <br>
                Для создания нового заказчика&nbsp;&mdash; кнопка
                <div class="text-center mt-1">
                    <button type="button" class="btn btn-success">Создать</button>
                </div>
                <br>
                Для редактирования или, возможно, удаления заказчика предназначены кнопки в колонке "Операции":
                <div class="text-center mt-1">
                    <button class="btn btn-sm btn-primary fa fa-edit mr-2" title="Редактировать"></button>
                    <button class="btn btn-sm btn-danger fa fa-trash-alt" title="Удалить"></button>
                </div>
            @elseif($controller == 'DepotsController')
                Этот раздел предназначен для создания, редактирования и, возможно, удаления депо приписки локомотивов.
                <br>
                Для создания нового депо приписки&nbsp;&mdash; кнопка
                <div class="text-center mt-1">
                    <button type="button" class="btn btn-success">Создать</button>
                </div>
                <br>
                Для редактирования или, возможно, удаления депо приписки предназначены кнопки в колонке "Операции":
                <div class="text-center mt-1">
                    <button class="btn btn-sm btn-primary fa fa-edit mr-2" title="Редактировать"></button>
                    <button class="btn btn-sm btn-danger fa fa-trash-alt" title="Удалить"></button>
                </div>
            @elseif($controller == 'UsersController')
                Управление пользователями системы. Можно создавать новых пользователей. Кнопка:
                <div class="text-center mt-1">
                    <button class="btn btn-success">Создать</button>
                </div>
                К колонке "Операции" можно выполнить следующие действия:
                <div>
                    <button class="btn btn-sm btn-primary fa fa-user-edit" title="Редактировать"></button>&nbsp;&mdash;
                    редактировать ФИО, должность, адрес email.
                </div>
                <div>
                    <button class="btn btn-sm btn-primary fa fa-user-check" title="Верифицировать"></button>&nbsp;&mdash;
                    верифицировать, т.е. подтвердить правильность адреса email. Может пригодиться для получения
                    уведомлений.
                </div>
                <div>
                    <button class="btn btn-sm btn-primary fa fa-unlock-alt" title="Сменить пароль"></button>&nbsp;&mdash;
                    смена пароля пользователя.
                </div>
                <div>
                    <button class="btn btn-sm btn-danger fa fa-trash-alt" title="Удалить"></button>&nbsp;&mdash;
                    удаление пользователя.
                </div>
                <div class="mt-1">
                    В колонке "Уведомления" можно управлять настройками уведомлений для верифицированных пользователей.
                    Уведомления бывают 2-х видов:<br>
                    <button class="btn p-1 fab fa-chrome text-success"></button>
                    - в браузере<br>
                    <button class="btn p-1 fa fa-at text-secondary"></button>
                    - по электронной почте.
                    Зеленый цвет означает, что уведомления включены. Серый - выключены. Клик по значку переключает
                    состояние.
                </div>
            @endif
        </div>
    </div>
@endif

