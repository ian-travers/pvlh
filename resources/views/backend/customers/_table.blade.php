@php /** @var \App\Models\Customer $customer */ @endphp

<table class="table table-bordered">
    <thead>
    <tr>
        <th class="w-5 text-center">ID</th>
        <th>Название организации</th>
        <th class="w-10 text-center">Операции</th>
    </tr>
    </thead>
    <tbody>
    @foreach($customers as $customer)
        <tr>
            <td class="text-center">{{ $customer->id }}</td>
            <td>{{ $customer->name }}</td>
            <td class="text-center">
                <a
                    href="{{ route('backend.customers.edit', $customer) }}"
                    class="btn btn-sm btn-primary fa fa-edit mr-2"
                    title="Редактировать"
                ></a>
                @if($customer->isDeletable())
                    <form class="d-inline" action="{{ route('backend.customers.delete', $customer) }}" method="post">
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
