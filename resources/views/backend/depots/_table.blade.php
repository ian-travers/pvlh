@php /** @var \App\Models\Customer $depot */ @endphp

<table class="table table-bordered">
    <thead>
    <tr>
        <th class="w-5 text-center">ID</th>
        <th>Название депо приписки</th>
        <th class="w-10 text-center">Операции</th>
    </tr>
    </thead>
    <tbody>
    @foreach($depots as $depot)
        <tr>
            <td class="text-center">{{ $depot->id }}</td>
            <td>{{ $depot->name }}</td>
            <td class="text-center">
                <a
                    href="{{ route('backend.depots.edit', $depot) }}"
                    class="btn btn-sm btn-primary fa fa-edit mr-2"
                    title="Редактировать"
                ></a>
                <form class="d-inline" action="{{ route('backend.depots.delete', $depot) }}" method="post">
                    @csrf
                    @method('delete')
                    <button
                        type="submit"
                        onclick="return confirm('Подтверждаете удаление?')"
                        class="btn btn-danger btn-sm fa fa-trash"
                        title="Удалить"
                    ></button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
