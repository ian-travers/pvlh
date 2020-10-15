<x-layout-backend title="Новое назначение">
    <div><h2>Создание нового назначения</h2></div>
    <form method="post" action="{{ route('backend.purposes.store') }}">
        @csrf
        @include('backend.purposes._commonFormFields')
        <button class="btn btn-primary" type="submit">Сохранить</button>
    </form>
</x-layout-backend>
