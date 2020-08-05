@extends('layouts.app')

@section('component-css')
    <link href="{{ asset('plugins/datatables/css/datatables.bundle.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('component-title')
    <h3 class="m-subheader__title m-subheader__title--separator">Gestión de Personal Administrativo</h3>
    @include('layouts.shared._breadcrumbs', [
                           'breadcrumb_items' => [
                           config('constants.BREADCRUMB_ITEMS.MODULES.GESTION_USUARIOS.TITLE'),
                           config('constants.BREADCRUMB_ITEMS.MODULES.GESTION_USUARIOS.ITEMS.ADMINISTRATIVE.LIST'),
                           config('constants.BREADCRUMB_ITEMS.MODULES.GESTION_USUARIOS.ITEMS.ADMINISTRATIVE.ADD')
                           ]
                       ])
@endsection
@section('content')

    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Formulario de creación
                        </h3>

                    </div>
                </div>
                <div class="m-portlet__head-tools">

                </div>
            </div>
            <div class="m-portlet__body">
                {{ Form::open(['route' => 'manage.user.administrativos.post.create','id' => 'add-form','class'=>'m-form m-form--fit m-form--label-align-right','method' => 'POST']) }}
                {{ csrf_field() }}
                <div class="m-portlet__body">
                    {{ Form::hidden('typeAdd', $type) }}
                    <div class="form-group row">
                        <div class="m-form__group-sub col-lg-3">
                            <label>DNI:</label>
                            {{ Form::text("dni",null,["class" => "form-control m-input", "placeholder" => "Doc. de Identidad","minlength" => 8, "maxlength" => 8]) }}
                        </div>
                        <div class="m-form__group-sub col-lg-3">
                            <label>Nombres:</label>
                            {{ Form::text("name",null,["class" => "form-control m-input", "placeholder" => "Nombre completo","onkeypress" => 'return isTextKey(event)']) }}
                        </div>
                        <div class="m-form__group-sub col-lg-3">
                            <label>Apellido Paterno:</label>
                            {{ Form::text("paternalLastName",null,["class" => "form-control m-input", "placeholder" => "Apellido Paterno","onkeypress" => 'return isTextKey(event)']) }}
                        </div>
                        <div class="m-form__group-sub col-lg-3">
                            <label>Apellido Materno:</label>
                            {{ Form::text("maternalLastName",null,["class" => "form-control m-input", "placeholder" => "Apellido Materno","onkeypress" => 'return isTextKey(event)']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="m-form__group-sub col-lg-2">
                            <label>Usuario:</label>
                            <div class="input-group m-input-group m-input-group--square">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-user"></i>
                                    </span>
                                </div>
                                {{ Form::text("username",null,["class" => "form-control m-input", "placeholder" => "Código Institucional"]) }}
                            </div>
                        </div>
                        <div class="m-form__group-sub col-lg-3">
                            <label>Contraseña:</label>
                            {{ Form::password("password",["class" => "form-control", "placeholder" => "*********"]) }}
                        </div>
                        <div class="m-form__group-sub col-lg-3">
                            <label>Reingrese la contraseña:</label>
                            {{ Form::password("repassword",["class" => "form-control", "placeholder" => "*********"]) }}
                            @foreach ($errors->all() as $error)
                                <strong style="color: #f4516c;font-weight: 400; font-size: 1rem;">{{ $error }}</strong>
                            @endforeach
                        </div>
                        <div class="m-form__group-sub col-lg-4">
                            <label>Asignación de Rol(es):</label>
                            {{ Form::select('roles[]', array(1 => 'Administrador', 2 => 'Asistente', 10 => 'Director general'), null, array('class' => 'form-control','id' => 'select-roles','multiple' => true,'required' => true)) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="m-form__group-sub col-lg-2">
                            <label class="">Sexo:</label>
                            <div class="m-radio-inline">
                                <label class="m-radio m-radio--solid">
                                    <input type="radio" name="sex" checked value="1"> Hombre
                                    <span></span>
                                </label>
                                <label class="m-radio m-radio--solid">
                                    <input type="radio" name="sex" value="2"> Mujer
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <div class="m-form__group-sub col-lg-10">
                            <label>Dirección:</label>
                            {{ Form::text("address",null,["class" => "form-control m-input", "placeholder" => "Dirección del hogar"]) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="m-form__group-sub col-lg-2">
                            <label>Fecha de Nacimiento:</label>
                            {{ Form::text("birthdate",null,["class" => "form-control m-input", "placeholder" => "Fecha de Nacimiento","id" => "dateBirthday"]) }}
                        </div>
                        <div class="m-form__group-sub col-lg-3">
                            <label>Nacionalidad:</label>
                            {{ Form::text("nationality",null,["class" => "form-control m-input", "placeholder" => "Nacionalidad","onkeypress" => 'return isTextKey(event)']) }}
                        </div>
                        <div class="m-form__group-sub col-lg-3">
                            <label>Correo electr&oacute;nico:</label>
                            {{ Form::email("email",null,["class" => "form-control m-input", "placeholder" => "Correo electr&oacute;nico"]) }}
                        </div>
                        <div class="m-form__group-sub col-lg-2">
                            <label>Telef&oacute;no:</label>
                            {{ Form::text("phoneNumber",null,["class" => "form-control m-input", "placeholder" => "##########","onkeypress" => 'return isNumberKey(event)',"minlength" => 7, "maxlength" => 9]) }}
                        </div>
                        <div class="m-form__group-sub col-lg-2">
                            <label>Celular:</label>
                            {{ Form::text("cellPhone",null,["class" => "form-control m-input", "placeholder" => "##########","onkeypress" => 'return isNumberKey(event)',"minlength" => 9, "maxlength" => 9]) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="m-form__group-sub col-lg-4">
                            <label>Grupo:</label>
                            {{ Form::select('group', array(1 => 'Funcionario', 2 => 'Profesional', 3 => 'Tecnico', 4 => 'Auxiliar',5 => 'Obrero'), null, array('class' => 'form-control','id' => 'select-group')) }}
                        </div>
                        <div class="m-form__group-sub col-lg-4">
                            <label>Grupo:</label>
                            {{ Form::select('level', array(1 => 'C', 2 => 'D', 3 => 'E', 4 => 'F',5 => '1',6 => '2',7 => '3',8 => '4'), null, array('class' => 'form-control','id' => 'select-level')) }}
                        </div>
                        <div class="m-form__group-sub col-lg-4">
                            <label>Grupo:</label>
                            {{ Form::select('condition', array(1 => 'Nombrado ', 2 => 'Contratado mayor a un año ', 3 => 'Contratado igual a un año', 4 => 'Contratado menor a un año'), null, array('class' => 'form-control','id' => 'select-condition')) }}
                        </div>
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions--solid">
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <a type="button" href="{{ route("manage.user.administrativos.index") }}" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection

@section('component-js')
    <script src="{{ asset('js/helpers.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/pages/manage/users/administrative/create.js') }}" type="text/javascript"></script>
@endsection
