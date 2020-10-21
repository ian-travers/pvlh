@php
    /** @var \App\Models\User $user */
    $user = auth()->user();
@endphp

<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm mb-2">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @can('create-app')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('applications') }}">Заявки на локомотивы</a>
                    </li>
                @endcan
                @if($user->isAdmin())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('backend') }}">Панель управления</a>
                    </li>
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <div class="d-inline-block bg-secondary text-center text-light p-2 rounded-circle" style="min-width: 2.5rem">
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
</nav>

