@php /** @var \App\Models\LocomotiveApplication $application */ @endphp

<table class="table table-bordered">
    <thead>
    <tr>
        <th class="text-center" rowspan="2" style="vertical-align: middle">#</th>
        <th>Предприятие</th>
        <th class="text-center">Дата</th>
        <th>Секционность</th>
        <th class="text-center">Количество</th>
        <th class="text-center">Кол-во часов</th>
        <th>Вид работ</th>
        <th>Депо приписки</th>
        <th class="text-center w-10" rowspan="2" style="vertical-align: middle">Согл.</th>
        <th class="text-center" rowspan="2" style="vertical-align: middle">Операции</th>
    </tr>
    <tr>
        <th class="text-center py-1" colspan="7">План выполнения работ</th>
    </tr>
    </thead>
    <tbody>
    @foreach($applications as $application)
        <tr>
            <td class="text-center" rowspan="2" style="vertical-align: middle">
                {{ (request('page')) ? (request('page') - 1) * $applications->perPage() + $loop->index + 1 : $loop->index + 1 }}
            </td>
            <td>{{ $application->customer->name }}</td>
            <td class="text-center">{{ $application->on_date->format('d.m.Y') }}</td>
            <td>{{ $application->sectionsName() }}</td>
            <td class="text-center">{{ $application->count }}</td>
            <td class="text-center">{{ $application->hours }}</td>
            <td>{{ $application->purpose->name }}</td>
            <td>{{ $application->depot->name }}</td>
            <td class="text-center" rowspan="2" style="vertical-align: middle">
                <span class="w-80 text-center badge {{ $application->approvedNODN() ? 'badge-success' : 'badge-danger' }}">НОДН</span>
                <span class="w-80 text-center badge {{ $application->approvedNODT() ? 'badge-success' : 'badge-danger' }}">НОДТ</span>
                <span class="w-80 text-center badge {{ $application->approvedNODSHP() ? 'badge-success' : 'badge-danger' }}">НОДШП</span>
            </td>
            <td class="text-center" rowspan="2" style="vertical-align: middle">
                <a
                    href="{{ route('applications.show', $application) }}"
                    class="btn btn-sm btn-primary fa fa-eye mb-1"
                    title="Посмотреть"
                ></a>
                @can('edit-app', $application)
                <a
                    href="{{ route('applications.edit', $application) }}"
                    class="btn btn-sm btn-primary fa fa-edit mb-1"
                    title="Редактировать"
                ></a>
                <form action="{{ route('applications.delete', $application) }}" method="post">
                    @csrf
                    @method('delete')
                    <button
                        type="submit"
                        onclick="return confirm('Подтверждаете удаление?')"
                        class="btn btn-danger btn-sm fa fa-trash"
                        title="Удалить"
                    ></button>
                </form>
                @else
                    <button type="button"
                            class="btn btn-primary btn-sm fa fa-edit mb-1 disabled"></button>
                    <div>
                        <button type="button"
                                class="btn btn-danger btn-sm fa fa-trash disabled"></button>
                    </div>
                @endcan
            </td>
        </tr>
        <tr>
            <td colspan="7">{{ $application->description }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
