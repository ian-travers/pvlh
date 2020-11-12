@php
    foreach ($data as $customer) {
        $records[] = count($customer);
    }

    $max = max($records);

    $depotsCount = array_key_exists('depots_total', $data) ? count($data['depots_total']) : 0;
@endphp
{{--All locomotive applications of a day --}}
@for($i = 0; $i < $max - 1; $i++)
    <tr>
        <td class="text-center">{{ $day }}</td>
        @for($y = 0; $y < count($customersNames); $y++)
            @if(array_key_exists($i, $data[$customersNames[$y]]))
                <td class="text-right">
                    {{ $data[$customersNames[$y]][$i]->count }}
                </td>
                <td class="text-right">
                    {{ $data[$customersNames[$y]][$i]->hours }}
                </td>
                <td>
                    {{ $data[$customersNames[$y]][$i]->depot }}
                </td>
                <td>
                    {{ $data[$customersNames[$y]][$i]->purpose }}
                </td>
            @else
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            @endif
        @endfor
    </tr>
@endfor

{{--A day total groupped by depot--}}
@if($depotsCount)
    <tr>
        <td rowspan="{{ $depotsCount + 1}}" style="vertical-align: middle" class="text-center"><strong>{{ $day }}</strong>
        </td>
    </tr>
    @foreach($data['depots_total'] as $t)
        <tr>
            <td class="text-right"><strong>{{ $t->count }}</strong></td>
            <td class="text-right"><strong>{{ $t->hours }}</strong></td>
            <td><strong>{{ $t->depot }}</strong></td>
        </tr>
    @endforeach
@endif
