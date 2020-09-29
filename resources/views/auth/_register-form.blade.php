<div class="form-group">
    <label for="name" class="font-weight-bolder">Имя</label>
    <input id="name" type="text"
           class="form-control @error('name') is-invalid @enderror" name="name"
           value="{{ old('name') }}" required autocomplete="name" autofocus>
    @error('name')
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>
<div class="form-group">
    <label for="position" class="font-weight-bolder">Должность</label>
    <input id="position" type="text"
           class="form-control @error('position') is-invalid @enderror" name="position"
           value="{{ old('position') }}" required autocomplete="position">
    @error('position')
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>
<div class="form-group">
    <label for="email" class="font-weight-bolder">Адрес email</label>
    <input id="email" type="email"
           class="form-control @error('email') is-invalid @enderror" name="email"
           value="{{ old('email') }}" required autocomplete="email">

    @error('email')
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>
<div class="form-group">
    <label for="password" class="font-weight-bolder">Пароль</label>
    <input id="password" type="password"
           class="form-control @error('password') is-invalid @enderror" name="password"
           required autocomplete="new-password">

    @error('password')
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>
<div class="form-group">
    <label for="password-confirm" class="font-weight-bolder">Повтор пароля</label>
    <input id="password-confirm" type="password" class="form-control"
           name="password_confirmation" required autocomplete="new-password">
</div>




