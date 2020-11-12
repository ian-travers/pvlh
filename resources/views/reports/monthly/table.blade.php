<table class="table table-sm table-bordered small">
    <thead>
    <tr>
        <th class="text-center" rowspan="3" style="vertical-align: middle">Дата</th>
        <th class="text-center" colspan="{{ $customersCount * 4 }}">
            Количество локомотивов, назначение (вид работ)
        </th>
    </tr>
    <tr>
        @foreach($customersNames as $name)
            <th class="text-center" colspan="4">{{ $name }}</th>
        @endforeach
    </tr>
    <tr>
        @for($i = 1; $i <= $customersCount; $i++)
            <th class="text-center">Кол.</th>
            <th class="text-center">Час.</th>
            <th class="text-center">Депо</th>
            <th class="text-center">Назначение</th>
        @endfor
    </tr>
    </thead>
    <tbody>
    @foreach($report as $day => $data)
        @include('reports.monthly._day', [$day, $data, $customersNames])
    @endforeach
    </tbody>
</table>
