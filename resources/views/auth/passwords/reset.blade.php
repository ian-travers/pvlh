<x-layout-auth>
    <div class="row d-flex justify-content-center">
        <div class=" mr-3 pt-2">
            <h2 class="text-muted">Восстановление доступа к системе</h2>
        </div>
        <div class="ml-3">
            <div class="card mb-3">
                <div class="card-header lead">Форма установки пароля</div>
                <div class="card-body">
                    <form method="post" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group">
                            <label for="email" class="font-weight-bolder">Адрес email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ $email ?? old('email') }}" required autocomplete="email"
                                   autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="font-weight-bolder">Пароль</label>
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror" name="password"
                                   required autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password-confirm" class="font-weight-bolder">Повтор пароля</label>
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Установить пароль
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout-auth>
