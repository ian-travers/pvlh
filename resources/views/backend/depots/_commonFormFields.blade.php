@php /** @var \App\Models\Depot $depot */ @endphp

<div class="form-group">
    <label for="name">Название депо приписки</label>
    <input id="name" type="text" name="name" maxlength="100"
           class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $depot->name) }}"
           autofocus required>
    @error('name')
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>
