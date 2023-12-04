<div class="ui modal add medium">
    <div class="header">{{ __("Incluir Novo Horário") }}</div>
    <div class="content">
        <form id="add_schedule_form" action="{{ url('schedules/add') }}" class="ui form" method="post" accept-charset="utf-8">
            @csrf
            <div class="field">
                <label>{{ __('Funcionário') }}</label>
                <select class="ui search dropdown getid uppercase" name="employee">
                    <option value="">Selecione o Funcionário</option>
                    @isset($employee)
                    @foreach ($employee as $data)
                    <option value="{{ $data->firstname }}, {{ $data->lastname }}" data-id="{{ $data->id }}">{{ $data->firstname }}, {{ $data->lastname }}</option>
                    @endforeach
                    @endisset
                </select>
            </div>
            <div class="two fields">
                <div class="field">
                    <label for="">{{ __('Horário (Entrada)') }}</label>
                    <input type="text" placeholder="00:00:00 AM" name="intime" class="jtimepicker" />
                </div>
                <div class="field">
                    <label for="">{{ __('Horário (Saída)') }}</label>
                    <input type="text" placeholder="00:00:00 PM" name="outime" class="jtimepicker" />
                </div>
            </div>
            <div class="field">
                <label for="">{{ __('Início (Data)') }}</label>
                <input type="text" placeholder="Date" name="datefrom" id="datefrom" class="airdatepicker" />
            </div>
            <div class="field">
                <label for="">{{ __('Fim (Data)') }}</label>
                <input type="text" placeholder="Date" name="dateto" id="dateto" class="airdatepicker" />
            </div>
            <div class="eight wide field">
                <label for="">{{ __('Total (Horas)') }}</label>
                <input type="number" placeholder="0" name="hours" />
            </div>
            <div class="grouped fields field">
                <label>{{ __('Dias de folga') }}</label>
                <div class="field">
                    <div class="ui checkbox sunday">
                        <input type="checkbox" name="restday[]" value="Sunday">
                        <label>{{ __('Domingo') }}</label>
                    </div>
                </div>
                <div class="field">
                    <div class="ui checkbox ">
                        <input type="checkbox" name="restday[]" value="Monday">
                        <label>{{ __('Segunda - Feira') }}</label>
                    </div>
                </div>
                <div class="field">
                    <div class="ui checkbox ">
                        <input type="checkbox" name="restday[]" value="Tuesday">
                        <label>{{ __('Terça - Feira') }}</label>
                    </div>
                </div>
                <div class="field">
                    <div class="ui checkbox ">
                        <input type="checkbox" name="restday[]" value="Wednesday">
                        <label>{{ __('Quarta - Feira') }}</label>
                    </div>
                </div>
                <div class="field">
                    <div class="ui checkbox ">
                        <input type="checkbox" name="restday[]" value="Thursday">
                        <label>{{ __('Quinta - Feira') }}</label>
                    </div>
                </div>
                <div class="field">
                    <div class="ui checkbox ">
                        <input type="checkbox" name="restday[]" value="Friday">
                        <label>{{ __('Sexta - Feira') }}</label>
                    </div>
                </div>
                <div class="field" style="padding:0">
                    <div class="ui checkbox saturday">
                        <input type="checkbox" name="restday[]" value="Saturday">
                        <label>{{ __('Sábado') }}</label>
                    </div>
                </div>
                <div class="ui error message">
                    <i class="close icon"></i>
                    <div class="header"></div>
                    <ul class="list">
                        <li class=""></li>
                    </ul>
                </div>
            </div>
    </div>

    <div class="actions">
        <input type="hidden" name="id" value="">
        <button class="ui positive small button" type="submit" name="submit"><i class="ui checkmark icon"></i> {{ __('Salvar') }}</button>
        <button class="ui grey small button cancel" type="button"><i class="ui times icon"></i> {{ __('Cancelar') }}</button>
    </div>
    </form>
</div>