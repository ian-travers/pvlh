@php /** @var App\Models\User $user */ @endphp
<x-layout-app title="Профиль">
    <div class="row">
        <div class="col-md-5 col-sm-12 mt-md-3">
            <h3 class="text-muted">Настройки профиля</h3>
            <p class="text-muted">Здесть вы можете изменять профиль и настройки уведомлений</p>
        </div>
        <div class="col-md-7 col-sm12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="#">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="name" class="font-weight-bolder">Имя</label>
                            <input type="text" name="name" id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $user->name) }}"
                                   required autocomplete="name" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="position" class="font-weight-bolder">Должность</label>
                            <input type="text" name="position" id="position"
                                   class="form-control @error('position') is-invalid @enderror"
                                   value="{{ old('position', $user->position) }}"
                                   required autocomplete="position">
                        </div>
                        <div class="border p-2 mb-3">
                            <h3>Система уведомлений</h3>
                            При создании, согласовании, утверждении заявки система может рассылать уведомления своим
                            пользователям. Выберите уведомления, которые хотите получать:
                            <div class="form-check mt-2">
                                <input type="checkbox" name="notifyBrowser" id="notify-browser"
                                       class="form-check-input">
                                <label for="notify-browser" class="font-weight-bolder">Получать уведомления в
                                    браузере</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="notifyEmail" id="notify-email" class="form-check-input">
                                <label for="notify-email" class="font-weight-bolder">Получать уведомления по электронной
                                    почте</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-5 col-sm-12 mt-md-3">
            <h3 class="text-muted">Параметры учетной записи</h3>
            <p class="text-muted">Здесть вы можете изменить адрес email, сменить пароль, удалить учетную запись </p>
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
                            <form action="#" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Адрес email</label>
                                    <input typeof="text" name="email" id="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           value="{{ old('email', $user->email) }}" required
                                    >
                                    @error('email')
                                    <span class="invalid-feedback"
                                          role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Сохранить адрес email</button>
                            </form>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header text-light bg-dark">
                            <span class="h3">Пароль</span>
                        </div>
                        <div class="card-body">
                            <p>Воспользуйтесь кнопкой ниже, чтобы изменить пароль.</p>
                            <button type="button" data-toggle="modal" data-target="#changePasswordForm"
                                    class="btn btn-dark float-right">
                                Изменить пароль...
                            </button>
                        </div>
                    </div>
                    <div id="changePasswordForm" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Изменение пароля</h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="password">Новый пароль</label>
                                            <input type="password" name="password" id="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   required>
                                            <span class="invalid-feedback" id="password-error"
                                                  role="alert"><strong id="password-error-message"></strong></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="password-confirm">Повтор пароля</label>
                                            <input type="password" name="password_confirmation" id="password-confirm"
                                                   class="form-control"
                                                   required>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer d-block">
                                    <div class="text-center">
                                        <button type="button" id="submitChangePasswordForm" class="btn btn-primary">
                                            Сохранить новый пароль
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header text-white bg-danger">
                            <span class="h3">Удалить учетную запись</span>
                        </div>
                        <div class="card-body">
                            <p>Важно понимать: как только вы удалите свою учетную запись, назад возврата не будет.
                                Пожалуйста, будьте внимательны.</p>
                            <button type="button" data-toggle="modal" data-target="#deleteAccountForm"
                                    class="btn btn-danger float-right">
                                Удалить вашу учетную запись...
                            </button>
                        </div>
                    </div>
                    <div id="deleteAccountForm" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ $user->name }}, уверены, что хотите сделать это?</h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="alert alert-danger" role="alert">
                                            Это очень важно. После удаления отменить эту оперцию будет
                                            невозможно!
                                        </div>
                                        <div class="form-group">
                                            <label for="password-check">Подтвердите своим паролем</label>
                                            <input type="password" name="passwordCheck" id="password-check"
                                                   class="form-control @error('passwordCheck') is-invalid @enderror"
                                                   required>
                                            <span class="invalid-feedback" id="password-check-error"
                                                  role="alert"><strong
                                                    id="password-check-error-message"></strong></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="verify-phrase">
                                                Для проверки наберите
                                                <em class="font-weight-normal">delete my account</em>
                                                в строке ниже:
                                            </label>
                                            <input type="text" name="verifyPhrase" id="verify-phrase"
                                                   class="form-control @error('verifyPhrase') is-invalid @enderror"
                                                   required>
                                            <span class="invalid-feedback" id="verify-phrase-error"
                                                  role="alert"><strong id="verify-phrase-error-message"></strong></span>
                                        </div>

                                    </div>
                                    <div class="modal-footer d-block">
                                        <div class="text-center">
                                            <button type="button" id="submitDeleteAccountForm" class="btn btn-primary">
                                                Удалить аккаунт
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout-app>

