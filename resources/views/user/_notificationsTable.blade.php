@php /** @var \Illuminate\Notifications\DatabaseNotification $notifications */ @endphp

<table class="table table-bordered table-sm">
    <thead>
    <tr>
        <th class="text-center w-50">Содержание уведомления</th>
        <th class="text-center">Создано</th>
        <th class="text-center">Прочитано</th>
        <th class="text-center">Операции</th>
    </tr>
    </thead>
    <tbody>
    @foreach($notifications as $notification)
        <tr>
            <td>
                @foreach($notification->data as $key => $value)
                    @if($key != 'link')
                        <span>{{ $value }}</span>
                    @endif
                @endforeach
                <a href="{{ $notification->data['link'] ?? '#' }}" target="_blank">
                    <span class="fas fa-external-link-alt"></span>
                </a>
            </td>
            <td class="text-center">{{ $notification->created_at->format('d.m.y H:i') }}</td>
            <td class="text-center">{{ optional($notification->read_at)->format('d.m.y H:i') }}</td>
            <td>
                <div class="d-flex justify-content-center align-items-end">
                    <form
                        class="form-inline mr-2"
                        action="{{ route('notifications.toggle-read', $notification) }}"
                        method="post"
                    >
                        @csrf
                        @method('put')
                        <button
                            type="submit"
                            class="btn btn-sm btn-primary fas {{ $notification->read_at ? 'fa-eye-slash' : 'fa-eye' }}"
                            title="{{ $notification->read() ? 'Снять отметку о прочтении' : 'Пометить как прочитанное' }}"
                        ></button>
                    </form>
                    <form
                        class="d-inline"
                        action="{{ route('notifications.destroy', $notification) }}"
                        method="post"
                    >
                        @csrf
                        @method('put')
                        <button
                            type="submit"
                            onclick="return confirm('Подтверждаете удаление?')"
                            class="btn btn-danger btn-sm fa fa-trash"
                            title="Удалить"
                        ></button>
                    </form>
                </div>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

