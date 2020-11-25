<x-layout-app title="Календарь">
    <div class="d-flex justify-content-center align-items-start mt-3 mb-2">
        <a href="{{ $previousLink }}">
            <button class="btn bnt-sm btn-outline-secondary fas fa-chevron-left" title="Предыдущий месяц"></button>
        </a>
        <h3 class="mx-4">{{ $monthAsText }} {{ $yearAsText }}</h3>
        <a href="{{ $nextLink }}">
            <button class="btn bnt-sm btn-outline-secondary fas fa-chevron-right" title="Следующий месяц"></button>
        </a>
    </div>

    <div class="overflow-auto">
        <table class="table table-bordered">
            <tr>
                <td class="text-center py-0" style="width: calc(100%/7)">Понедельник</td>
                <td class="text-center py-0" style="width: calc(100%/7)">Вторник</td>
                <td class="text-center py-0" style="width: calc(100%/7)">Среда</td>
                <td class="text-center py-0" style="width: calc(100%/7)">Четверг</td>
                <td class="text-center py-0" style="width: calc(100%/7)">Пятница</td>
                <td class="text-center py-0" style="width: calc(100%/7)">Суббота</td>
                <td class="text-center py-0" style="width: calc(100%/7)">Воскресенье</td>
            </tr>
            @foreach(array_chunk($dates, 7) as $chunk)
                <tbody>
                <tr>

                    @foreach($chunk as $date)
                        <td
                            class="text-center py-1 {{ $date->format('Y-m-d') == $now->format('Y-m-d') ? 'current-day' : '' }} {{ $date->format('m') !== $currentMonth->format('m') ? 'bg-light text-muted small' : '' }}">
                            {{ $date->format('d') }}
                        </td>
                    @endforeach
                </tr>
                <tr>
                    @foreach($chunk as $date)
                        @php $thisDay = $date->format('Y-m-d H:i:s') @endphp
                        <td
                            class="{{ $date->format('Y-m-d') == $now->format('Y-m-d') ? 'current-day' : '' }} {{ $date->format('m') !== $currentMonth->format('m') ? 'bg-light text-muted small' : '' }}"
                        >
                            @foreach($locApps as $locApp)
                                @if($locApp->on_date == $thisDay)
                                    <a class="calendar-link" href="{{ route('applications.show', $locApp->id) }}">
                                        <div class="border rounded mx-n1 mb-1 px-1">
                                            <div class="text-center">{{ $locApp->customer }}</div>
                                            <div class="text-center">
                                                <span class="small">{{ $locApp->depot }}</span>
                                                <span class="badge badge-pill badge-info">{{ $locApp->sections }}</span>
                                            </div>
                                            <div class="text-center small">
                                                <span class="badge badge-pill {{ $locApp->is_nodn ? 'badge-success' : 'badge-danger'}}">Н</span>
                                                <span class="badge badge-pill {{ $locApp->is_nodt ? 'badge-success' : 'badge-danger'}}">Т</span>
                                                <span class="badge badge-pill {{ $locApp->is_nodshp ? 'badge-success' : 'badge-danger'}}">ШП</span>
                                            </div>
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        </td>
                    @endforeach
                </tr>
                </tbody>
            @endforeach
        </table>
    </div>
</x-layout-app>
