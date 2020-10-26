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
<div class="form-group">
    <label for="customer_id">Заказчик</label>
    <select id="customer_id" name="customer_id"
            class="form-control @error('role') is-invalid @enderror"
    >
        <option value="">Нет</option>
        @foreach($customers as $value => $name)

            <option value="{{ $value }}"
                    @isset($user->id)
                    @if ($user->customer_id == $value)
                    selected="selected"
                @endif
                @endisset
            >
                {{ $name }}
            </option>
        @endforeach
    </select>
    @error('customer_id')
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>
<div class="form-group">
    <label for="role">Роль</label>
    <select id="role" name="role"
            class="form-control @error('role') is-invalid @enderror"
            required
    >
        @foreach($roles as $value => $name)

            <option value="{{ $value }}"
                    @isset($user->id)
                    @if ($user->role == $value)
                    selected="selected"
                @endif
                @endisset
            >
                {{ $name }}
            </option>
        @endforeach
    </select>
    @error('role')
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>

