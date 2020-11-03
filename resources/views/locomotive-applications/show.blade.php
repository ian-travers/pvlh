@php /** @var \App\Models\LocomotiveApplication $locApp */ @endphp
<x-layout-app title="Заявка на локомотив">
    <div class="card">
        <div class="card-header text-center">
            <div class="position-absolute" style="top: .5rem; right: .75rem">
                <a class="btn btn-secondary float-right" href="{{ route('applications') }}">Список заявок</a>
            </div>
            <h2>Заявка на локомотив</h2>
            <p class="h2">
                <span class="fas fa-calendar-alt"></span>
                <span class="mr-4">{{ $locApp->on_date->format('d.m.Y') }}</span>
                <span class="fas fa-building"></span>
                <span class="mr-4">{{ $locApp->customer->name }}</span>
                <span class="fas fa-user"></span>
                {{ $locApp->user->name }}
            </p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="pb-2"><strong>Информация по заявке</strong></div>
                    <div class="row">
                        <div class="col-sm-5 text-right">
                            <em>Заказчик:</em>
                        </div>
                        <div class="col-sm-7 ml-n3">
                            {{ $locApp->customer->name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5 text-right">
                            <em>На дату:</em>
                        </div>
                        <div class="col-sm-7 ml-n3">
                            {{ $locApp->on_date->locale('ru_RU')->isoFormat('LL') }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5 text-right">
                            <em>Часы работы:</em>
                        </div>
                        <div class="col-sm-7 ml-n3">
                            {{ $locApp->hours }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5 text-right">
                            <em>Тип:</em>
                        </div>
                        <div class="col-sm-7 ml-n3">
                            {{ $locApp->sectionsName() }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5 text-right">
                            <em>Количество локомотивов:</em>
                        </div>
                        <div class="col-sm-7 ml-n3">
                            {{ $locApp->count }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5 text-right">
                            <em>Депо приписки:</em>
                        </div>
                        <div class="col-sm-7 ml-n3">
                            {{ $locApp->depot->name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5 text-right">
                            <em>Назначение:</em>
                        </div>
                        <div class="col-sm-7 ml-n3">
                            {{ $locApp->purpose->name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5 text-right">
                            <em>Согласования:</em>
                        </div>
                        <div class="col-sm-7 ml-n3">
                            <div>НОДН&nbsp;<span
                                    class="fas {{ $locApp->approvedNODN() ? 'fa-check text-success' : 'fa-times text-danger' }}"></span>
                            </div>
                            <div>НОДТ&nbsp;<span
                                    class="fas {{ $locApp->approvedNODT() ? 'fa-check text-success' : 'fa-times text-danger' }}"></span>
                            </div>
                            <div>НОДШП&nbsp;<span
                                    class="fas {{ $locApp->approvedNODSHP() ? 'fa-check text-success' : 'fa-times text-danger' }}"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="pb-2"><strong>План работ</strong></div>
                    {{ $locApp->description }}
                </div>
            </div>
        </div>
        <div class="card-footer">
            @can('edit-app', $locApp)
                <a class="btn btn-primary mr-2"
                   href="{{ route('applications.edit', $locApp) }}">Редактировать</a>
                <form class="d-inline" action="{{ route('applications.delete', $locApp) }}" method="post">
                    @csrf
                    @method('delete')
                    <button
                        type="submit"
                        onclick="return confirm('Подтверждаете удаление?')"
                        class="btn btn-danger"
                    >Удалить
                    </button>
                </form>
            @endcan

            @can('approve-nodn', $locApp)
                <form class="d-inline " action="{{ route('applications.toggle-nodn', $locApp) }}" method="post">
                    @csrf
                    @method('patch')
                    <button
                        type="submit"
                        class="btn btn-secondary w-25"
                    >{{ $locApp->approvedNODN() ? 'Отменить согласование' : 'Согласовать' }} НОДН
                    </button>
                </form>
            @endcan

            @can('approve-nodt', $locApp)
                <form class="d-inline" action="{{ route('applications.toggle-nodt', $locApp) }}" method="post">
                    @csrf
                    @method('patch')
                    <button
                        type="submit"
                        class="btn btn-secondary w-25"
                    >{{ $locApp->approvedNODT() ? 'Отменить согласование' : 'Согласовать' }} НОДТ
                    </button>
                </form>
            @endcan

            @can('approve-nodshp', $locApp)
                <form class="d-inline" action="{{ route('applications.toggle-nodshp', $locApp) }}" method="post">
                    @csrf
                    @method('patch')
                    <button
                        type="submit"
                        class="btn btn-secondary w-25"
                    >{{ $locApp->approvedNODSHP() ? 'Отменить согласование' : 'Согласовать' }} НОДШП
                    </button>
                </form>
            @endcan
        </div>
    </div>
</x-layout-app>

