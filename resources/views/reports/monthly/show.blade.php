<x-layout-reports title="Месячный отчет">
    <h3 class="text-center">
        План выдачи локомотивов на хозяйственные работы<br>
        на {{ $month }} {{ $year }}.
    </h3>
    <h5>
        Выдача <strong>{{ $sections == 1 ? 'односекционных' : 'двухсекционных' }}</strong> локомотивов на хозяйственные
        работы
    </h5>
    @include('reports.monthly.table')
</x-layout-reports>
