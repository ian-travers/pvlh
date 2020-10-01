@php /** @var App\Models\User $user */ @endphp
<x-layout-app title="Профиль">
    <div class="row">
        <div class="col-md-5 col-sm-12 mt-md-3">
            <h3 class="text-muted">Настройки профиля</h3>
            <p class="text-muted">Здесть вы можете изменять настройки профиля и параметры учетной записи</p>
        </div>
        <div class="col-md-7 col-sm12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="#">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="name" class="font-weight-bolder">Имя</label>
                            <input type="text" name="name" id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $user->name) }}"
                                   required autocomplete="name" autofocus>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout-app>

