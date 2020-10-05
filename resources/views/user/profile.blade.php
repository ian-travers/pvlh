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
