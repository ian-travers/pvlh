<x-layout-backend title="Новый пользователь">
    <div><h2>Создание нового пользователя</h2></div>
    <form method="post" action="{{ route('backend.users.store') }}">
        @csrf
        @include('backend.users._commonFormFields')
        <div class="form-group">
            <label for="password">Пароль</label>
            <input id="password" type="password" name="password" maxlength="100"
                   class="form-control @error('password') is-invalid @enderror"
                   required>
            @error('password')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <button class="btn btn-primary" type="submit">Сохранить</button>
    </form>
</x-layout-backend>
