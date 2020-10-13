@php /** @var \Illuminate\Contracts\Pagination\LengthAwarePaginator $users */ @endphp

<x-layout-backend title="Пользователи">
    {{--Modal Password Window--}}
    <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog"
         aria-labelledby="changePasswordModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="changePasswordModalTitle">Смена пароля</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('backend.users.change-password') }}" method="post"
                      class="bootstrap-modal-form">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="userId" id="user-id">
                        <p class="text-center">Пользователь</p>
                        <p class="display-4 text-center" id="username">NAME</p>

                        <div class="form-group">
                            <label for="password">Пароль</label>
                            <input type="text" id="password" name="password" value="{{ old('password') }}"
                                   class="form-control @error('password') is-invalid @enderror">
                            @error('password'))
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-end border-top pt-3">
                            <button type="submit" class="btn btn-lg btn-outline-primary">Сменить пароль</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal">Отменить
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--End Modal--}}
    <div class="d-flex justify-content-between align-items-start mb-1">
        <h2>Пользователи системы</h2>
        <a href="{{ route('backend.users.create') }}" class="btn btn-success">Создать</a>
    </div>
    <users-table data="{{ $data->toJson() }}"></users-table>
    @section('script')
        <script>
            $('#passwordModal').on('show.bs.modal', function (e) {
                let invoker = $(e.relatedTarget);
                let userId = invoker.data('user-id');
                let userName = invoker.data('user-name');

                $('#user-id').val(userId);
                $('#username').text(userName);
            })
        </script>
    @endsection
</x-layout-backend>
