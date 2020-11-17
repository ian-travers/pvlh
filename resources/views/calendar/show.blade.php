<x-layout-app title="Календарь">
    <div class="d-flex justify-content-center align-items-start mt-3 mb-2">
        <a href="#">
            <button class="btn bnt-sm btn-outline-secondary fas fa-chevron-left"></button>
        </a>
        <h3 class="mx-4">{{ $monthAsText }} {{ $yearAsText }}</h3>
        <a href="#">
            <button class="btn bnt-sm btn-outline-secondary fas fa-chevron-right"></button>
        </a>
    </div>

    <div class="overflow-auto">
        <table class="table table-bordered">
            @foreach(array_chunk($dates, 7) as $chunk)
                <tbody>
                <tr>
                    @foreach($chunk as $date)
                        <td
                            class="text-center {{ $date->format('Y-m-d') == $now->format('Y-m-d') ? 'h4 text-primary' : '' }} {{ $date->format('m') !== $currentMonth->format('m') ? 'bg-light text-muted small' : '' }}"
                            style="width: calc(100%/7)"
                        >
                            {{ $date->format('d') }}
                        </td>
                    @endforeach
                </tr>
                <tr>
                    @foreach($chunk as $date)
                        <td
                            class="{{ $date->format('m') !== $currentMonth->format('m') ? 'bg-light text-muted small' : '' }}"
                        >
                            Data of this day
                        </td>
                    @endforeach
                </tr>
                </tbody>
            @endforeach
        </table>
    </div>
</x-layout-app>
