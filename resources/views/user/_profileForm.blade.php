<form action="{{ route('profile.update') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="name" class="font-weight-bolder">Имя</label>
        <input type="text" name="name" id="name"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $user->name) }}"
               required autocomplete="name" autofocus>
    </div>
    <div class="form-group">
        <label for="position" class="font-weight-bolder">Должность</label>
        <input type="text" name="position" id="position"
               class="form-control @error('position') is-invalid @enderror"
               value="{{ old('position', $user->position) }}"
               required autocomplete="position">
    </div>
    <div class="border p-2 mb-3">
        <h3>Система уведомлений</h3>
        При создании, согласовании, утверждении заявки система может рассылать уведомления своим
        пользователям. Выберите уведомления, которые хотите получать:
        <div class="form-check mt-2">
            <input type="checkbox" name="is_browser_notified" id="notify-browser"
                   class="form-check-input" {{ $user->hasBrowserNotifications() ? 'checked' : '' }}>
            <label for="notify-browser" class="font-weight-bolder">Получать уведомления в
                браузере</label>
        </div>
        <div class="form-check">
            <input type="checkbox" name="is_email_notified" id="notify-email"
                   class="form-check-input" {{ $user->hasEmailNotifications() ? 'checked' : '' }}>
            <label for="notify-email" class="font-weight-bolder">Получать уведомления по электронной
                почте</label>
        </div>
    </div>
    <button type="submit" class="btn btn-primary float-right">Сохранить</button>
</form>
