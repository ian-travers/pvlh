<x-layout-auth>
    <div class="row d-flex justify-content-center">
        <div class=" mr-3 pt-2">
            <h2 class="text-muted">Вход в систему</h2>
        </div>
        <div class="ml-3">
            <div class="card mb-3">
                <div class="card-header lead">Форма входа в систему</div>
                <div class="card-body">
                    <form method="post" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email" class="font-weight-bolder">Адрес email</label>
                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="font-weight-bolder">Пароль</label>
                            @if (Route::has('password.request'))
                                <span class="float-right">
                                <a class="btn-link"
                                   href="{{ route('password.request') }}"
                                >Не можете вспомнить пароль?</a>
                            </span>
                            @endif
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror" name="password" required
                                   autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group border-bottom pb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember"
                                       id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">Запомнить меня</label>
                            </div>
                        </div>
                        <div class="d-flex align-items-end mb-0 mt-3">
                            <button type="submit" class="btn btn-primary btn-lg">Войти</button>
                            <button class="ml-auto btn btn-secondary btn-sm" type="button"
                                    onclick="window.history.back()">Отмена
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    Нет учетной записи?
                    <a href="{{ route('register') }}">Зарегистрироваться</a>
                </div>
            </div>
        </div>
    </div>
</x-layout-auth>
