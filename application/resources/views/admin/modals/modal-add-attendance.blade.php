<div class="ui modal medium add">
    <div class="header">{{ __("Incluir Registro Manual") }}</div>
    <div class="content">
        <form id="add_attendance_form" action="{{ url('attendance/add-entry') }}" class="ui form add-attendance" method="post" accept-charset="utf-8">
            @csrf
            <div class="field">
                <label>{{ __("Funcionário") }}</label>
                <select class="ui search dropdown getref uppercase" name="name">
                    <option value="">Selecione o funcionário</option>
                    @isset($employees)
                    @foreach ($employees as $data)
                    <option value="{{ $data->firstname }}, {{ $data->lastname }}" data-ref="{{ $data->id }}">{{ $data->firstname }}, {{ $data->lastname }}</option>
                    @endforeach
                    @endisset
                </select>
            </div>
            <div class="field">
                <label for="">{{ __("Data") }}</label>
                <input class="airdatepicker" type="text" placeholder="00-00-0000" name="date" data-position="top right">
            </div>
            <div class="field">
                <label for="">{{ __("Horário (Entrada)") }} <span class="help">(required)</span></label>
                <input class="jtimepicker" type="text" placeholder="00:00:00 AM" name="timein" value="" required>
            </div>
            <div class="field">
                <label for="">{{ __("Horário (Saída)") }} <span class="help">(optional)</span></label>
                <input class="jtimepicker" type="text" placeholder="00:00:00 PM" name="timeout" value="">
            </div>
            <div class="field">
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
        <input type="hidden" value="" name="ref">
        <button class="ui positive approve small button" type="submit" name="submit"><i class="ui checkmark icon"></i> {{ __("Salvar") }}</button>
        <button class="ui grey cancel small button" type="button"><i class="ui times icon"></i> {{ __("Cancelar") }}</button>
    </div>
    </form>
</div>