@php /** @var \App\Models\LocomotiveApplication $locApp */ @endphp

<div class="row">
    <div class="col-md-6 col-12">
        <div class="row">
            <div class="col-sm-6 col-12">
                <div class="form-group required">
                    <label class="lead" for="on-date">Дата</label>
                    <input class="form-control @error('on_date') is-invalid @enderror" type="date" id="on-date"
                           name="on_date"
                           value="{{ old('on_date', $locApp->on_date ? $locApp->on_date->format('Y-m-d') : '') }}"
                           required
                           autofocus>
                    @error('on_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6 col-12">
                @if($isSA)
                    <label class="lead" for="customer">Предприятие-заказчик</label>
                    <select class="form-control" type="text" id="customer" name="customer_id" required>
                        @foreach($customers as $id => $name)
                            <option value="{{ $id }}"
                                    @if ($locApp->customer_id == $id)
                                    selected="selected"
                                @endif
                            >{{ $name }}</option>
                        @endforeach
                    </select>
                @elseif($isCustomer)
                    <input type="hidden" name="customer_id" value="{{ auth()->user()->customer_id }}">
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-sm-8 col-12">
                <div class="form-group required">
                    <label class="lead" for="sections">Секционность</label>
                    <select class="form-control" type="text" id="sections" name="sections" required>
                        @foreach($sections as $id => $name)
                            <option value="{{ $id }}"
                                    @if ($locApp->sections == $id)
                                    selected="selected"
                                @endif
                            >{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-4 col-12">
                <div class="form-group required">
                    <label class="lead" for="count">Количество</label>
                    <input class="form-control @error('count') is-invalid @enderror" id="count" name="count"
                           value="{{ old('count', $locApp->count) }}"
                           required>
                    @error('count')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-12">
                <div class="form-group required">
                    <label class="lead" for="hours">Время пользования, час.</label>
                    <input class="form-control @error('hours') is-invalid @enderror" id="hours" name="hours"
                           value="{{ old('hours', $locApp->hours) }}"
                           required>
                    @error('hours')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6 col-12">
                <div class="form-group required">
                    <label class="lead" for="depot">Депо приписки</label>
                    <select class="form-control" type="text" id="depot" name="depot_id" required>
                        @foreach($depots as $id => $name)
                            <option value="{{ $id }}"
                                    @if ($locApp->depot_id == $id)
                                    selected="selected"
                                @endif
                            >{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group required">
            <label class="lead" for="purpose">Назначение</label>
            <select class="form-control" type="text" id="purpose" name="purpose_id" required>
                @foreach($purposes as $id => $name)
                    <option value="{{ $id }}"
                            @if ($locApp->purpose_id == $id)
                            selected="selected"
                        @endif
                    >{{ $name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="form-group required">
            <label class="lead" for="desc">План</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="desc" name="description"
                      rows="13"
                      required>{{ old('description', $locApp->description) }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

