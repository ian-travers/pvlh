@php /** @var \App\Models\User $user */ @endphp

<x-layout-backend title="Редактирование пользователя">
    <div><h2>Редактирование пользователя</h2></div>
    <form method="post" action="{{ route('backend.users.update', $user) }}">
        @csrf
        @method('patch')
        @include('backend.users._commonFormFields')
        <button class="btn btn-primary" type="submit">Сохранить</button>
    </form>
</x-layout-backend>
