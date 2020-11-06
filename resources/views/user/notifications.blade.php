@php /** @var \Illuminate\Contracts\Pagination\LengthAwarePaginator $notifications */ @endphp

<x-layout-app title="Уведомления">
    <h2>Ваши уведомления</h2>
    @if($notifications->total())
        @include('user._notificationsTable')
        <div>
            {{ $notifications->links() }}
        </div>
    @else
        <div>Нет уведомлений!</div>
    @endif
</x-layout-app>

