<x-layout-backend title="Редактирование заказчика">
    <div><h2>Редактирование заказчика</h2></div>
    <form method="post" action="{{ route('backend.customers.update', $customer) }}">
        @csrf
        @method('patch')
        @include('backend.customers._commonFormFields')
        <button class="btn btn-primary" type="submit">Сохранить</button>
    </form>
</x-layout-backend>

