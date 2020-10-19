<x-layout-backend title="Новый заказчик">
    <div><h2>Создание нового заказчика</h2></div>
    <form method="post" action="{{ route('backend.customers.store') }}">
        @csrf
        @include('backend.customers._commonFormFields')
        <button class="btn btn-primary" type="submit">Сохранить</button>
    </form>
</x-layout-backend>
