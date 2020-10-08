@php /** @var \App\Models\User $user */ @endphp

<table class="table table-bordered">
    <thead>
    <tr>
        <th class="w-5 text-center">ID</th>
        <th>ФИО</th>
        <th>Должность</th>
        <th>Адрес email</th>
        <th>Верификация</th>
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
            <td>{{ $user->email_verified_at->diffForHumans() }}</td>
            <td class="text-center"></td>
        </tr>
    @endforeach
    </tbody>
</table>

