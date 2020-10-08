@php /** @var \Illuminate\Contracts\Pagination\LengthAwarePaginator $users */ @endphp

<x-layout-backend title="Пользователи">
    <div class="d-flex justify-content-between my-1">
        <h2>Пользователи системы</h2>
        <a href="{{ route('backend.users.create') }}" class="btn btn-success">Создать</a>
    </div>
    <div>
        @include('backend.users._table')
        <div class="mt-3">
            {{ $users->links() }}
        </div>
    </div>
</x-layout-backend>

