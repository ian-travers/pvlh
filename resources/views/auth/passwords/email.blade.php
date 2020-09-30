<x-layout-auth>
    <div class="row d-flex justify-content-center">
        <div class=" mr-3 pt-2">
            <h2 class="text-muted">Восстановления доступа к системе</h2>
        </div>
        <div class="ml-3">
            <div class="card mb-3">
                <div class="card-header lead">Форма для восстановления пароля</div>
                @if (session('status'))
                    <div class="alert alert-success rounded-0" role="alert">
                        На ваш email-адрес отправлено письмо для восстановления пароля
                    </div>
                @endif
                <div class="card-body">
                    <form method="post" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email" class="font-weight-bolder">Адрес email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Восстановить доступ
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout-auth>
