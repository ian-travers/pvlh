<x-layout-app title="Новая заявка">
    <div class="card">
        <div class="card-header">
            <h2>Создание заявки на локомотив</h2>
        </div>
        <div class="card-body">
            @if($isCustomer || $isSA)
                <form method="post" action="{{ route('applications.store') }}">
                    @csrf
                    @include('locomotive-applications._form')

                    <div class="d-flex justify-content-between align-items-end">
                        <div class="d-flex justify-content-between align-items-end">
                            <button type="submit" class="btn btn-lg btn-primary mr-2">Сохранить</button>
                            <a href="{{ route('applications') }}" class="btn btn-sm btn-secondary">Отменить</a>
                        </div>
                        <p class="text-muted">
                            <span class="required">*</span>
                            <em>Отмечены обязательные поля</em>
                        </p>
                    </div>
                </form>
            @else
                <div class="lead">
                    У вас недостаточно прав на создание заявки. Обратитесь к администратору этой системы.
                </div>
            @endif
        </div>
    </div>
</x-layout-app>
