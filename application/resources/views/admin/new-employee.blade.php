@extends('layouts.default')

@section('meta')
<title>Novo Funcionário | Pontual</title>
<meta name="description" content="Workday add new employee, delete employee, edit employee">
@endsection

@section('styles')
<link href="{{ asset('/assets/vendor/air-datepicker/dist/css/datepicker.min.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-title">{{ __('Perfil do funcionário') }}</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
            <div class="ui error message">
                <i class="close icon"></i>
                <div class="header">{{ __('There were some errors with your submission') }}</div>
                <ul class="list">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        <form id="add_employee_form" action="{{ url('employee/add') }}" class="ui form custom" method="post" accept-charset="utf-8" enctype="multipart/form-data">
            @csrf
            <div class="col-md-6 float-left">
                <div class="box box-success">
                    <div class="box-header with-border">{{ __('Informações pessoais') }}</div>
                    <div class="box-body">
                        <div class="two fields">
                            <div class="field">
                                <label>{{ __('Nome') }}</label>
                                <input type="text" class="uppercase" name="firstname" value="">
                            </div>
                            <div class="field">
                                <label>{{ __('Nome do meio') }}</label>
                                <input type="text" class="uppercase" name="mi" value="">
                            </div>
                        </div>
                        <div class="field">
                            <label>{{ __('Sobrenome') }}</label>
                            <input type="text" class="uppercase" name="lastname" value="">
                        </div>
                        <div class="field">
                            <label>{{ __('Sexo') }}</label>
                            <select name="gender" class="ui dropdown uppercase">
                                <option value="">Selecione</option>
                                <option value="MALE">Masculino</option>
                                <option value="FEMALE">Feminino</option>
                            </select>
                        </div>
                        <div class="field">
                            <label>{{ __('Estado civil') }}</label>
                            <select name="civilstatus" class="ui dropdown uppercase">
                                <option value="">Selecione o estado civil</option>
                                <option value="SINGLE">Solteiro (a)</option>
                                <option value="MARRIED">Casado (a)</option>
                                <option value="ANULLED">Separado (a)</option>
                                <option value="WIDOWED">Divorciado (a)</option>
                                <option value="LEGALLY SEPARATED">Viúvo (a)</option>
                            </select>
                        </div>
                        <div class="two fields">
                            <div class="field">
                                <label>{{ __('Altura') }} <span class="help">(cm)</span></label>
                                <input type="number" name="height" value="" placeholder="000">
                            </div>
                            <div class="field">
                                <label>{{ __('Peso') }} <span class="help">(kg)</span></label>
                                <input type="number" name="weight" value="" placeholder="000">
                            </div>
                        </div>
                        <div class="two fields">
                            <div class="field">
                                <label>{{ __('Endereço de E-mail (Pessoal)') }}</label>
                                <input type="email" name="emailaddress" value="" class="lowercase">
                            </div>
                            <div class="field">
                                <label>{{ __('Telefone celular') }}</label>
                                <input type="text" class="" name="mobileno" value="">
                            </div>
                        </div>
                        <div class="two fields">
                            <div class="field">
                                <label>{{ __('Idade') }}</label>
                                <input type="number" name="age" value="" placeholder="00">
                            </div>
                            <div class="field">
                                <label>{{ __('Data de aniversário') }}</label>
                                <input type="text" name="birthday" value="" class="airdatepicker" data-position="top right" placeholder="Date">
                            </div>
                        </div>
                        <div class="field">
                            <label>{{ __('Documento') }}</label>
                            <input type="text" class="uppercase" name="nationalid" value="" placeholder="">
                        </div>
                        <div class="field">
                            <label>{{ __('Local de nascimento') }}</label>
                            <input type="text" class="uppercase" name="birthplace" value="" placeholder="Cidade - Estado">
                        </div>
                        <div class="field">
                            <label>{{ __('Endereço') }}</label>
                            <input type="text" class="uppercase" name="homeaddress" value="" placeholder="Rua, Avenida">
                        </div>
                        <div class="field">
                            <label>{{ __('Subir foto de perfil') }}</label>
                            <input class="ui file upload" value="" id="imagefile" name="image" type="file" accept="image/png, image/jpeg, image/jpg" onchange="validateFile()">
                        </div>
                        <br>
                    </div>
                </div>
            </div>
            <div class="col-md-6 float-left">
                <div class="box box-success">
                    <div class="box-header with-border">{{ __('Informações profissionais') }}</div>
                    <div class="box-body">
                        <h4 class="ui dividing header">{{ __('Designação') }}</h4>
                        <div class="field">
                            <label>{{ __('Empresa') }}</label>
                            <select name="company" class="ui search dropdown uppercase">
                                <option value="">Selecione a empresa</option>
                                @isset($company)
                                @foreach ($company as $data)
                                <option value="{{ $data->company }}"> {{ $data->company }}</option>
                                @endforeach
                                @endisset
                            </select>
                        </div>
                        <div class="field">
                            <label>{{ __('Departamento') }}</label>
                            <select name="department" class="ui search dropdown uppercase department">
                                <option value="">Selecione o departamento</option>
                                @isset($department)
                                @foreach ($department as $data)
                                <option value="{{ $data->department }}"> {{ $data->department }}</option>
                                @endforeach
                                @endisset
                            </select>
                        </div>
                        <div class="field">
                            <label>{{ __('Cargo') }}</label>
                            <div class="ui search dropdown selection uppercase jobposition">
                                <input type="hidden" name="jobposition">
                                <i class="dropdown icon" tabindex="1"></i>
                                <div class="default text">Selecione o cargo</div>
                                <div class="menu">
                                    @isset($jobtitle)
                                    @isset($department)
                                    @foreach ($jobtitle as $data)
                                    @foreach ($department as $dept)
                                    @if($dept->id == $data->dept_code)
                                    <div class="item" data-value="{{ $data->jobtitle }}" data-dept="{{ $dept->department }}">{{ $data->jobtitle }}</div>
                                    @endif
                                    @endforeach
                                    @endforeach
                                    @endisset
                                    @endisset
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label>{{ __('ID') }}</label>
                            <input type="text" class="uppercase" name="idno" value="">
                        </div>
                        <div class="field">
                            <label>{{ __('Endereço de E-mail (Profissional)') }}</label>
                            <input type="email" name="companyemail" value="" class="lowercase">
                        </div>
                        <div class="field">
                            <label>{{ __('Leave Group') }}</label>
                            <select name="leaveprivilege" class="ui dropdown uppercase">
                                <option value="">Select Leave Privilege</option>
                                @isset($leavegroup)
                                @foreach($leavegroup as $lg)
                                <option value="{{ $lg->id }}">{{ $lg->leavegroup }}</option>
                                @endforeach
                                @endisset
                            </select>
                        </div>
                        <h4 class="ui dividing header">{{ __('Informações do contrato') }}</h4>
                        <div class="field">
                            <label>{{ __('Tipo de contrato') }}</label>
                            <select name="employmenttype" class="ui dropdown uppercase">
                                <option value="">Selecione o tipo</option>
                                <option value="Regular">Tempo integral</option>
                                <option value="Trainee">Temporário</option>
                            </select>
                        </div>
                        <div class="field">
                            <label>{{ __('Status do contrato') }}</label>
                            <select name="employmentstatus" class="ui dropdown uppercase">
                                <option value="">Selecione o contrato</option>
                                <option value="Active">Ativo</option>
                                <option value="Archived">Finalizado</option>
                            </select>
                        </div>
                        <div class="field">
                            <label>{{ __('Data de início') }}</label>
                            <input type="text" name="startdate" value="" class="airdatepicker uppercase" data-position="top right" placeholder="Data">
                        </div>
                        <div class="field">
                            <label>{{ __('Data de encerramento') }}</label>
                            <input type="text" name="dateregularized" value="" class="airdatepicker uppercase" data-position="top right" placeholder="Data">
                        </div>
                        <br>
                    </div>
                </div>
            </div>
            <div class="col-md-12 float-left">
                <div class="ui error message">
                    <i class="close icon"></i>
                    <div class="header"></div>
                    <ul class="list">
                        <li class=""></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-12 float-left">
                <div class="action align-right">
                    <button type="submit" name="submit" class="ui green button small"><i class="ui checkmark icon"></i>{{ __('Salvar') }}</button>
                    <a href="{{ url('employees') }}" class="ui grey button small"><i class="ui times icon"></i>{{ __('Cancelar') }}</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('/assets/vendor/air-datepicker/dist/js/datepicker.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/air-datepicker/dist/js/i18n/datepicker.en.js') }}"></script>
<script type="text/javascript">
    $('.airdatepicker').datepicker({
        language: 'en',
        dateFormat: 'yyyy-mm-dd',
        autoClose: true
    });

    $('.ui.dropdown.department').dropdown({
        onChange: function(value, text, $selectedItem) {
            $('.jobposition .menu .item').addClass('hide disabled');
            $('.jobposition .text').text('');
            $('input[name="jobposition"]').val('');
            $('.jobposition .menu .item').each(function() {
                var dept = $(this).attr('data-dept');
                if (dept == value) {
                    $(this).removeClass('hide disabled');
                };
            });
        }
    });

    function validateFile() {
        var f = document.getElementById("imagefile").value;
        var d = f.lastIndexOf(".") + 1;
        var ext = f.substr(d, f.length).toLowerCase();
        if (ext == "jpg" || ext == "jpeg" || ext == "png") {} else {
            document.getElementById("imagefile").value = "";
            $.notify({
                icon: 'ui icon times',
                message: "Please upload only jpg/jpeg and png image formats."
            }, {
                type: 'danger',
                timer: 400
            });
        }
    }
</script>
@endsection