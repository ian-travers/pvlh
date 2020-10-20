<x-layout-backend title="Новое депо">
    <div><h2>Создание нового депо приписки</h2></div>
    <form method="post" action="{{ route('backend.depots.store') }}">
        @csrf
        @include('backend.depots._commonFormFields')
        <button class="btn btn-primary" type="submit">Сохранить</button>
    </form>
</x-layout-backend>
