<h3 class="text-center mt-3">ИТОГО {{ $sections == 1 ? 'односекционных' : 'двухсекционных' }} локомотивов
    за {{ $month }} {{ $year }}</h3>
<table class="table table-bordered">
    <thead>
    <tr>
        <th class="w-20 responsive-oblique-line position-relative">
            <div class="position-absolute" style="left: 1rem; bottom: .4rem">П</div>
            <div class="position-absolute" style="right: 1rem; top: .4rem">Т</div>
        </th>
        @foreach($depotsNames as $name)
            <td class="text-center w-20">{{ $name }}</td>
        @endforeach
        <th class="text-center w-20 font-weight-bolder">Всего по "П"</th>
    </tr>
    </thead>
    <tbody>
    @foreach($summaryMatrix as $key => $records)
        <tr>
            <td>{{ $key }}</td>
            @foreach($records as $key => $count)
                <td class="text-right {{ $key == 'total' ? 'font-weight-bolder' : '' }}">{{ $count }}</td>
            @endforeach
        </tr>
    @endforeach
    <tr>
        <td class="font-weight-bolder">Всего по "Т"</td>
        @foreach($summaryDepots as $count)
            <td class="text-right font-weight-bolder">{{ $count }}</td>
        @endforeach
    </tr>
    </tbody>
</table>
