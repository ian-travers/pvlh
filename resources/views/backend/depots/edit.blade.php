<x-layout-backend title="Редактирование депо">
    <div><h2>Редактирование депо приписки</h2></div>
    <form method="post" action="{{ route('backend.depots.update', $depot) }}">
        @csrf
        @method('patch')
        @include('backend.depots._commonFormFields')
        <button class="btn btn-primary" type="submit">Сохранить</button>
    </form>
</x-layout-backend>

