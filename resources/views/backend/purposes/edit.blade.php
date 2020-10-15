<x-layout-backend title="Редактирование назначения">
    <div><h2>Редактирование назначения</h2></div>
    <form method="post" action="{{ route('backend.purposes.update', $purpose) }}">
        @csrf
        @method('patch')
        @include('backend.purposes._commonFormFields')
        <button class="btn btn-primary" type="submit">Сохранить</button>
    </form>
</x-layout-backend>

