@php /** @var \Illuminate\Contracts\Pagination\LengthAwarePaginator $applications */ @endphp

<x-layout-app title="Заявки на локомотивы">
    <div class="d-flex justify-content-between align-items-start mb-1">
        <h2>Заявки на локомотивы</h2>
        <a href="{{ route('applications.create') }}" class="btn btn-success">Создать</a>
    </div>
    @if($applications->total())
        @include('locomotive-applications._table')
        <div>
            {{ $applications->links() }}
        </div>
    @else
        <div>Нет заявок!</div>
    @endif
</x-layout-app>
