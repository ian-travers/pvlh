@php /** @var \App\Models\LocomotiveApplication $locomotiveApplication */ @endphp

<div class="row">
    <div class="col-md-6 col-12">
        <div class="form-group required">
            <label class="lead" for="on-date">Дата</label>
            <input class="form-control" type="date" id="on-date" name="on_date" required autofocus>
        </div>
        <div class="row">
            <div class="col-sm-8 col-12">
                <div class="form-group required">
                    <label class="lead" for="sections">Секционность</label>
                    <select class="form-control" type="text" id="sections" name="sections" required>
                        <option value="1"
                                @if ($locomotiveApplication->sections == 1)
                                selected="selected"
                            @endif
                        >Односекционный
                        </option>
                        <option value="2"
                                @if ($locomotiveApplication->sections == 2)
                                selected="selected"
                            @endif
                        >Двухсекционный
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-sm-4 col-12">
                <div class="form-group required">
                    <label class="lead" for="count">Количество</label>
                    <input class="form-control" id="count" name="count" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-12">
                <div class="form-group required">
                    <label class="lead" for="hours">Время пользования, час.</label>
                    <input class="form-control" id="hours" name="hours" required>
                </div>
            </div>
            <div class="col-sm-6 col-12">
                <div class="form-group required">
                    <label class="lead" for="depot">Депо приписки</label>
                    <select class="form-control" type="text" id="depot" name="depot_id" required>
                        @foreach($depots as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group required">
            <label class="lead" for="purpose">Назначение</label>
            <select class="form-control" type="text" id="purpose" name="purpose_id" required>
                @foreach($purposes as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="form-group required">
            <label class="lead" for="desc">План</label>
            <textarea class="form-control" id="desc" name="description" rows="13" required></textarea>
        </div>
    </div>
</div>

