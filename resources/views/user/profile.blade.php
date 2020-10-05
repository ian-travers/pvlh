@php /** @var App\Models\User $user */ @endphp

<x-layout-app title="Профиль">
    @if($user->hasVerifiedEmail())
    <div class="row">
        <div class="col-md-5 col-sm-12 mt-md-3">
            <h3 class="text-muted">Настройки профиля</h3>
            <p class="text-muted">Здесть вы можете изменять профиль и настройки уведомлений</p>
        </div>
        <div class="col-md-7 col-sm12">
            <div class="card">
                <div class="card-body">
                    <edit-profile-form :user="{{ auth()->user() }}"></edit-profile-form>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="row mt-3">
        <div class="col-md-5 col-sm-12 mt-md-3">
            <h3 class="text-muted">Параметры учетной записи</h3>
            <p class="text-muted">Здесть вы можете изменить адрес email, сменить пароль, удалить учетную запись.</p>
        </div>
        <div class="col-md-7 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card">
                        <div class="card-header text-light bg-primary">
                            <span class="h3">Адрес email</span>
                        </div>
                        <div class="card-body">
                            <p>Для изменения введите ниже новый адрес email и нажмите "Сохранить адрес email".</p>
                            <change-email-form email="{{ $user->email }}"></change-email-form>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header text-light bg-dark">
                            <span class="h3">Пароль</span>
                        </div>
                        <div class="card-body">
                            <p>Воспользуйтесь кнопкой ниже, чтобы изменить пароль.</p>
                            <change-password-form></change-password-form>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header text-white bg-danger">
                            <span class="h3">Удалить учетную запись</span>
                        </div>
                        <div class="card-body">
                            <p>Важно понимать: как только вы удалите свою учетную запись, назад возврата не будет.
                                Пожалуйста, будьте внимательны.</p>
                            <delete-account-form name="{{ $user->name }}"></delete-account-form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout-app>
