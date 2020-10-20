@php /** @var \Illuminate\Contracts\Pagination\LengthAwarePaginator $depots */ @endphp

<x-layout-backend title="Депо">
    <div class="d-flex justify-content-between align-items-start mb-1">
        <h2>Депо приписки локомотивов</h2>
        <a href="{{ route('backend.depots.create') }}" class="btn btn-success">Создать</a>
    </div>
    @if($depots->total())
        @include('backend.depots._table')
        <div>
            {{ $depots->links() }}
        </div>
    @else
        <div>Нет ни одного депо приписки!</div>
    @endif
</x-layout-backend>
