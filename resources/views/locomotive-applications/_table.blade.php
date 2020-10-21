@php /** @var \App\Models\LocomotiveApplication $application */ @endphp

<table class="table table-bordered">
    <thead>
    <tr>
        <th class="text-center" rowspan="2" style="vertical-align: middle">#</th>
        <th class="text-center">Дата</th>
        <th>Секционность</th>
        <th class="text-center">Количество</th>
        <th class="text-center">Кол-во часов</th>
        <th>Вид работ</th>
        <th>Депо приписки</th>
    </tr>
    <tr>
        <th class="text-center" colspan="6">План выполнения работ</th>
    </tr>
    </thead>
    <tbody>
    @foreach($applications as $application)
        <tr>
            <td class="text-center" rowspan="2" style="vertical-align: middle">
                {{ (request('page')) ? (request('page') - 1) * $applications->perPage() + $loop->index + 1 : $loop->index + 1 }}
            </td>
            <td class="text-center">{{ $application->on_date->format('d.m.Y') }}</td>
            <td>{{ $application->sectionsName() }}</td>
            <td class="text-center">{{ $application->count }}</td>
            <td class="text-center">{{ $application->hours }}</td>
            <td>{{ $application->purpose->name }}</td>
            <td>{{ $application->depot->name }}</td>
        </tr>
        <tr>
            <td colspan="6">{{ $application->description }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
