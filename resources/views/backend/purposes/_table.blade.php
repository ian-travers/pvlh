@php /** @var \App\Models\Purpose $purpose */ @endphp

<table class="table table-bordered">
    <thead>
    <tr>
        <th class="w-5 text-center">ID</th>
        <th>Наименование</th>
        <th class="w-10 text-center">Операции</th>
    </tr>
    </thead>
    <tbody>
    @foreach($purposes as $purpose)
        <tr>
            <td class="text-center">{{ $purpose->id }}</td>
            <td>{{ $purpose->name }}</td>
            <td class="text-center">
                <a
                    href="{{ route('backend.purposes.edit', $purpose) }}"
                    class="btn btn-sm btn-primary fa fa-edit mr-2"
                    title="Редактировать"
                ></a>
                @if($purpose->isDeletable())
                    <form class="d-inline" action="{{ route('backend.purposes.delete', $purpose) }}" method="post">
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
                    <button
                        type="button"
                        class="btn btn-danger btn-sm fa fa-trash disabled"
                    ></button>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
