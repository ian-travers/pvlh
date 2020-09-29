<x-layout-auth>
    <div class="d-flex justify-content-center">
        <div class="mr-3 pt-2">
            <h2 class="text-muted">Регистрация в системе</h2>
        </div>
        <div class="ml-3">
            <div class="card">
                <div class="card-header lead">Форма регистрации учетной записи</div>
                <div class="card-body">
                    <form method="post" action="{{ route('register') }}">
                        @csrf
                        @include('auth._register-form')
                        <div class="d-flex align-items-end mb-0 mt-3">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Регистрация
                            </button>
                            <button class="ml-auto btn btn-secondary btn-sm" type="button"
                                    onclick="window.history.back()">Отмена
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layout-auth>
