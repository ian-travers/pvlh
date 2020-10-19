@php /** @var \App\Models\Customer $customer */ @endphp

<div class="form-group">
    <label for="name">Название организации</label>
    <input id="name" type="text" name="name" maxlength="100"
           class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $customer->name) }}"
           autofocus required>
    @error('name')
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>

