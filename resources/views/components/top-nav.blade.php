@php
    /** @var \App\Models\User $user */
    $user = auth()->user();
@endphp

<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm mb-2">
    <div class="container">
        <a class="navbar-brand position-absolute" style="left: 2rem" href="{{ url('/') }}">
            <span class="h1 fas fa-train"></span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('applications') }}">Заявки на локомотивы</a>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Отчеты
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#monthly-report-form">Отчет за месяц</button>
                    </div>
                </li>
                @can('sysadmin', $user)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('backend') }}">Панель управления</a>
                    </li>
                @endcan
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                <user-notifications></user-notifications>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <div class="d-inline-block bg-secondary text-center text-light p-2 rounded-circle"
                             style="min-width: 2.5rem">
                            <strong>{{ $user->initials }}</strong></div>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <div class="text-center bg-light text-black-50 my-n2">
                            <div>{{ $user->name }}</div>
                            <div>
                                <small>{{ $user->position }}</small>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item"
                           href="{{ route('profile') }}">Профиль</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item"
                           href="{{ route('notifications') }}">Уведомления</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Выход
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>


    <!-- Monthly Report Modal Form-->
    <div id="monthly-report-form" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Подготовка месячного отчета</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('reports.monthly-report') }}" method="get">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="sections">Тип локомотивов</label>
                            <select class="form-control" id="sections" name="sections" required>
                                <option value="1">Односекционный</option>
                                <option value="2">Двухсекционный</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-7">
                                @php $month = now()->month; @endphp
                                <select class="form-control" id="month" name="month" required>
                                    <option value="1" {{ $month == 1 ? 'selected' : '' }}>Январь</option>
                                    <option value="2" {{ $month == 2 ? 'selected' : '' }}>Февраль</option>
                                    <option value="3" {{ $month == 3 ? 'selected' : '' }}>Март</option>
                                    <option value="4" {{ $month == 4 ? 'selected' : '' }}>Апрель</option>
                                    <option value="5" {{ $month == 5 ? 'selected' : '' }}>Май</option>
                                    <option value="6" {{ $month == 6 ? 'selected' : '' }}>Июнь</option>
                                    <option value="7" {{ $month == 7 ? 'selected' : '' }}>Июль</option>
                                    <option value="8" {{ $month == 8 ? 'selected' : '' }}>Август</option>
                                    <option value="9" {{ $month == 9 ? 'selected' : '' }}>Сентябрь</option>
                                    <option value="10" {{ $month == 10 ? 'selected' : '' }}>Октябрь</option>
                                    <option value="11" {{ $month == 11 ? 'selected' : '' }}>Ноябрь</option>
                                    <option value="12" {{ $month == 12 ? 'selected' : '' }}>Декабрь</option>
                                </select>
                            </div>
                            <div class="col-5">
                                @php $year = now()->year; @endphp
                                <select class="form-control" id="year" name="year" required>
                                    <option value="{{ $year - 1 }}">{{ $year - 1 }}</option>
                                    <option value="{{ $year }}" selected>{{ $year }}</option>
                                    <option value="{{ $year + 1 }}">{{ $year + 1 }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-block">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">
                                Сформировать отчет
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</nav>

