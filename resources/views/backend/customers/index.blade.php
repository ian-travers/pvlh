@php /** @var \Illuminate\Contracts\Pagination\LengthAwarePaginator $customers */ @endphp

<x-layout-backend title="Заказчики">
    <div class="d-flex justify-content-between align-items-start mb-1">
        <h2>Заказчики</h2>
        <a href="{{ route('backend.customers.create') }}" class="btn btn-success">Создать</a>
    </div>
    @if($customers->total())
        @include('backend.customers._table')
        <div>
            {{ $customers->links() }}
        </div>
    @else
        <div>Нет Заказчиков!</div>
    @endif
</x-layout-backend>

