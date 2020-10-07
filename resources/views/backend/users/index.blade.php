@php /** @var \Illuminate\Contracts\Pagination\LengthAwarePaginator $users */ @endphp
@php /** @var \App\Models\User $user */ @endphp

<x-layout-backend title="Пользователи">
    <div class="d-flex justify-content-between my-1">
        <h2>Пользователи системы</h2>
        <a href="{{ route('backend.users.create') }}" class="btn btn-success">Создать</a>
    </div>
    <div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>ФИО</th>
                <th>Должность</th>
                <th>Адрес email</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users->items() as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->position }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            {{ $users->links() }}
        </div>
    </div>
</x-layout-backend>

