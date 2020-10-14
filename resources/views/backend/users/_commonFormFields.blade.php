<div class="form-group">
    <label for="name">ФИО</label>
    <input id="name" type="text" name="name" maxlength="100"
           class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $user->name) }}"
           autofocus required>
    @error('name')
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>
<div class="form-group">
    <label for="position">Должность</label>
    <input id="position" type="text" name="position" maxlength="100"
           class="form-control @error('position') is-invalid @enderror"
           value="{{ old('position', $user->position) }}"
           required>
    @error('position')
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>
<div class="form-group">
    <label for="email">Адрес email</label>
    <input id="email" type="text" name="email" maxlength="100"
           class="form-control @error('email') is-invalid @enderror"
           value="{{ old('email', $user->email) }}"
           required>
    @error('email')
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>

