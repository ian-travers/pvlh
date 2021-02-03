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
                        @php $thisDay = $date->format('Y-m-d') @endphp
                        <td
                            class="{{ $date->format('Y-m-d') == $now->format('Y-m-d') ? 'current-day' : '' }} {{ $date->format('m') !== $currentMonth->format('m') ? 'bg-light text-muted small' : '' }}"
                        >
                            @foreach($locApps as $locApp)
                                @if(substr($locApp->on_date, 0, 10) == $thisDay)
                                    <a class="calendar-link" href="{{ route('applications.show', $locApp->id) }}">
                                        <div class="border rounded mx-n1 mb-1 px-1">
                                            <div class="text-center">{{ $locApp->customer }}</div>
                                            <div class="text-center">
                                                <span class="small">{{ $locApp->depot }}</span>
                                                @if($locApp->sections == 2)
                                                <svg
                                                    width="16" height="16" viewBox="0 0 1200 1280"
                                                >
                                                    <g transform="translate(0.000000,1119.000000) scale(0.100000,-0.100000)"
                                                       fill="#000000" stroke="none">
                                                        <path d="M5840 10710 l0 -480 255 0 255 0 0 -1450 0 -1450 -1860 0 -1860 0 0
549 0 549 53 30 c71 40 152 129 187 204 42 90 52 175 48 416 -3 187 -5 213
-21 229 -17 17 -61 18 -711 21 -690 2 -693 2 -719 -19 l-27 -20 0 -233 c0
-128 5 -258 10 -287 24 -131 126 -265 243 -322 l57 -28 0 -543 0 -544 -242 -5
c-275 -5 -314 -11 -463 -82 -212 -99 -352 -261 -404 -466 l-17 -69 -32 45
c-63 89 -135 114 -332 115 -117 0 -130 -9 -130 -98 -1 -64 -2 -68 -33 -87 -19
-12 -44 -44 -62 -79 l-30 -60 0 -241 0 -241 30 -60 c18 -35 43 -67 62 -79 29
-18 32 -25 33 -68 0 -87 1 -87 158 -87 178 0 203 7 275 81 l57 58 0 -1102 c0
-1010 3 -1169 25 -1238 6 -18 -3 -19 -299 -19 l-306 0 0 -595 0 -595 629 0
629 0 -45 -67 c-98 -146 -172 -325 -215 -514 -20 -89 -23 -131 -23 -299 0
-168 3 -210 23 -299 65 -289 197 -534 397 -736 502 -509 1280 -589 1877 -193
121 81 324 282 400 398 106 162 189 353 221 512 l13 63 545 3 544 2 12 -62
c47 -240 191 -511 376 -705 216 -226 479 -371 785 -435 88 -18 139 -22 287
-22 199 0 308 17 480 76 476 160 863 597 965 1086 l13 62 542 0 543 0 17 -77
c58 -260 196 -511 390 -708 501 -509 1280 -589 1877 -193 121 80 324 282 400
398 116 176 199 379 234 570 24 130 24 390 0 520 -33 184 -115 390 -215 543
l-51 77 380 0 380 0 0 595 c0 588 0 595 -20 595 -20 0 -20 7 -20 3340 l0 3340
195 0 195 0 0 480 0 480 -3480 0 -3480 0 0 -480z m5050 -2100 l0 -1030 -1657
2 -1658 3 -3 1028 -2 1027 1660 0 1660 0 0 -1030z m-5597 -6262 c-4 -7 -24
-38 -44 -68 -146 -220 -239 -536 -239 -814 l0 -51 -519 0 -518 0 -6 121 c-14
275 -96 532 -238 750 l-49 74 811 0 c646 0 809 -3 802 -12z m3970 -55 c-145
-217 -228 -472 -240 -738 l-6 -140 -521 2 -521 3 -7 132 c-7 152 -26 260 -69
390 -34 105 -107 256 -167 346 -23 35 -42 65 -42 68 0 2 364 4 809 4 l809 0
-45 -67z"/>
                                                    </g>
                                                </svg>
                                                @endif
                                                <svg style="transform: scale(-1,1)"
                                                    width="16" height="16" viewBox="0 0 1200 1280"
                                                >
                                                    <g transform="translate(0.000000,1119.000000) scale(0.100000,-0.100000)"
                                                       fill="#000000" stroke="none">
                                                        <path d="M5840 10710 l0 -480 255 0 255 0 0 -1450 0 -1450 -1860 0 -1860 0 0
549 0 549 53 30 c71 40 152 129 187 204 42 90 52 175 48 416 -3 187 -5 213
-21 229 -17 17 -61 18 -711 21 -690 2 -693 2 -719 -19 l-27 -20 0 -233 c0
-128 5 -258 10 -287 24 -131 126 -265 243 -322 l57 -28 0 -543 0 -544 -242 -5
c-275 -5 -314 -11 -463 -82 -212 -99 -352 -261 -404 -466 l-17 -69 -32 45
c-63 89 -135 114 -332 115 -117 0 -130 -9 -130 -98 -1 -64 -2 -68 -33 -87 -19
-12 -44 -44 -62 -79 l-30 -60 0 -241 0 -241 30 -60 c18 -35 43 -67 62 -79 29
-18 32 -25 33 -68 0 -87 1 -87 158 -87 178 0 203 7 275 81 l57 58 0 -1102 c0
-1010 3 -1169 25 -1238 6 -18 -3 -19 -299 -19 l-306 0 0 -595 0 -595 629 0
629 0 -45 -67 c-98 -146 -172 -325 -215 -514 -20 -89 -23 -131 -23 -299 0
-168 3 -210 23 -299 65 -289 197 -534 397 -736 502 -509 1280 -589 1877 -193
121 81 324 282 400 398 106 162 189 353 221 512 l13 63 545 3 544 2 12 -62
c47 -240 191 -511 376 -705 216 -226 479 -371 785 -435 88 -18 139 -22 287
-22 199 0 308 17 480 76 476 160 863 597 965 1086 l13 62 542 0 543 0 17 -77
c58 -260 196 -511 390 -708 501 -509 1280 -589 1877 -193 121 80 324 282 400
398 116 176 199 379 234 570 24 130 24 390 0 520 -33 184 -115 390 -215 543
l-51 77 380 0 380 0 0 595 c0 588 0 595 -20 595 -20 0 -20 7 -20 3340 l0 3340
195 0 195 0 0 480 0 480 -3480 0 -3480 0 0 -480z m5050 -2100 l0 -1030 -1657
2 -1658 3 -3 1028 -2 1027 1660 0 1660 0 0 -1030z m-5597 -6262 c-4 -7 -24
-38 -44 -68 -146 -220 -239 -536 -239 -814 l0 -51 -519 0 -518 0 -6 121 c-14
275 -96 532 -238 750 l-49 74 811 0 c646 0 809 -3 802 -12z m3970 -55 c-145
-217 -228 -472 -240 -738 l-6 -140 -521 2 -521 3 -7 132 c-7 152 -26 260 -69
390 -34 105 -107 256 -167 346 -23 35 -42 65 -42 68 0 2 364 4 809 4 l809 0
-45 -67z"/>
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="text-center small">
                                                <span
                                                    class="badge badge-pill {{ $locApp->is_nodn ? 'badge-success' : 'badge-danger'}}">Н</span>
                                                <span
                                                    class="badge badge-pill {{ $locApp->is_nodt ? 'badge-success' : 'badge-danger'}}">Т</span>
                                                <span
                                                    class="badge badge-pill {{ $locApp->is_nodshp ? 'badge-success' : 'badge-danger'}}">ШП</span>
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
