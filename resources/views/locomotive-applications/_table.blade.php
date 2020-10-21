@php /** @var \App\Models\LocomotiveApplication $application */ @endphp

<table class="table table-bordered">
    <thead>
    <tr>
        <th class="text-center">Дата</th>
        <th>Секционность</th>
        <th class="text-center">Количество</th>
        <th class="text-center">Кол-во часов</th>
        <th>Вид работ</th>
        <th>Депо приписки</th>
        <th>План выполнения работ</th>
    </tr>
    </thead>
    <tbody>
    @foreach($applications as $application)
        <tr>
            <td class="text-center">{{ $application->on_date->format('d.m.Y') }}</td>
            <td>{{ $application->sections }}</td>
            <td class="text-center">{{ $application->count }}</td>
            <td class="text-center">{{ $application->hours }}</td>
            <td>{{ $application->purpose_id }}</td>
            <td>{{ $application->depot_id }}</td>
            <td>{{ $application->description }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
