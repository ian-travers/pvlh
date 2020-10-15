@php /** @var \Illuminate\Contracts\Pagination\LengthAwarePaginator $purposes */ @endphp

<x-layout-backend title="Назначения">
    <div class="d-flex justify-content-between align-items-start mb-1">
        <h2>Назначения</h2>
        <a href="{{ route('backend.purposes.create') }}" class="btn btn-success">Создать</a>
    </div>
    @if($purposes->total())
        @include('backend.purposes._table')
        <div>
            {{ $purposes->links() }}
        </div>
    @else
        <div>Нет наззначений!</div>
    @endif
</x-layout-backend>

