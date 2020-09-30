<x-layout-auth>
    <div class="col-7 mx-auto">
        <div class="card">
            <div class="card-header">
                <h2 class="text-muted">Верификация адреса email</h2>
            </div>
            @if (session('resent'))
                <div class="alert alert-success rounded-0" role="alert">
                    Новое письмо с инструкцией по верификации отправлено на ваш адрес email.
                </div>
            @endif
            <div class="card-body">

                На адрес email, указанный при регистрации, выслано письмо для подтверждения вашего адреса email. Это
                процедура необходима для дальнейшей работе в системе. В настройках вашего профиля можно указать
                рассылку уведомлений на события, происходящие в системе, которая будет посылаться на ваш адрес
                email. Если вы не получили email, то
                <form class="d-inline" method="post" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit"
                            class="btn btn-link p-0 m-0 align-baseline">кликните сюда и система отправит вам новый
                    </button>
                    .
                </form>
            </div>
        </div>
    </div>
</x-layout-auth>
