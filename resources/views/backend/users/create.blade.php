<x-layout-backend title="Новый пользователь">
    <div><h2>Создание нового пользователя</h2></div>
    <form method="post" action="{{ route('backend.users.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">ФИО</label>
            <input id="name" type="text" name="name" maxlength="100"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}"
                   autofocus required>
            @error('name')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="form-group">
            <label for="position">Должность</label>
            <input id="position" type="text" name="position" maxlength="100"
                   class="form-control @error('position') is-invalid @enderror"
                   value="{{ old('position') }}"
                   required>
            @error('position')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Адрес email</label>
            <input id="email" type="text" name="email" maxlength="100"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}"
                   required>
            @error('email')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
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

