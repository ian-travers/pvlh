<x-layout-backend title="Пользователи">
    <div class="d-flex justify-content-between align-items-start mb-1">
        <h2>Пользователи системы</h2>
        <a href="{{ route('backend.users.create') }}" class="btn btn-success">Создать</a>
    </div>
    <users-table data="{{ $data->toJson() }}"></users-table>
</x-layout-backend>
