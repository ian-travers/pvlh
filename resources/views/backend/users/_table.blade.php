@php /** @var \App\Models\User $user */ @endphp

<table class="table table-bordered">
    <thead>
    <tr>
        <th class="w-5 text-center">ID</th>
        <th>ФИО</th>
        <th>Должность</th>
        <th>Адрес email</th>
        <th class="text-center">Уведомления</th>
        <th class="text-center">Верификация</th>
        <th class="text-center">Операции</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users->items() as $user)
        <tr>
            <td class="text-center">{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->position }}</td>
            <td>{{ $user->email }}</td>
            <td class="text-center">
                <button
                    type="button"
                    class="btn btn-sm">
                    <span
                        class="fab fa-chrome {{ $user->hasBrowserNotifications() ? 'text-success' : 'text-secondary' }}"
                    ></span>
                </button>
                <button
                    type="button"
                    class="btn btn-sm">
                    <span
                        class="fa fa-at {{ $user->hasEmailNotifications() ? 'text-success' : 'text-secondary' }}"
                    ></span>
                </button>
            </td>
            <td class="text-center">{{ $user->email_verified_at ? $user->email_verified_at->diffForHumans() : '' }}</td>
            <td class="text-center">
                <a
                    href="{{ route('backend.users.edit', $user) }}"
                    class="btn btn-sm btn-primary fa fa-user-edit"
                    title="Редактировать">
                </a>
                <button
                    type="button"
                    class="btn btn-sm btn-primary fa fa-user-check"
                    title="Верифицировать">
                </button>
                <button
                    type="button"
                    class="btn btn-sm btn-primary fa fa-unlock-alt"
                    title="Сменить пароль">
                </button>
                <button
                    type="button"
                    class="btn btn-sm btn-danger fa fa-trash-alt"
                    title="Удалить">
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

