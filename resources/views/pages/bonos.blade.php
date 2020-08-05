@extends('layouts.app')

@section('component-css')
    <link href="{{ asset('plugins/datatables/css/datatables.bundle.css') }}" rel="stylesheet" type="text/css">

@endsection

@section('content')
    <style>
        .form-control.m-input,
        .select2-selection.select2-selection--single{
            border-color: #acb9da !important;
            color: #000000 !important;
        }
        #dt_flujoPagos_paginate{
            display: none;
        }
    </style>
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Calculo del bono aleman
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">

                        </li>
                        <li class="m-portlet__nav-item"></li>
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">
                {{ Form::open(['route' => 'consultar.bono','id' => 'add-form','class'=>'m-form m-form--fit m-form--label-align-right','method' => 'POST']) }}
                {{ csrf_field() }}
                <h3 class="m-portlet__head-text">
                    Datos del Bono
                </h3>
                <div class="m-portlet__body">

                    <div class="m-portlet__body">
                        <div class="form-group row">
                            <div class="m-form__group-sub col-lg-2">
                                <label>Tipo de Moneda:</label>
                                {{ Form::select("tipoMoneda",array("1" => "SOL (S/. 1.00)", "3.52" => "US$ (S/. 3.52)", "3.96" => "EURO (S/. 3.96)"),null,["class" => "form-control", "id"=>"select2TipoMoneda"]) }}
                            </div>
                            <div class="m-form__group-sub col-lg-2">
                                <label>Valor Nominal:</label>
                                {{ Form::number("vNominal",null,["class" => "form-control m-input ","id" => "vNominal", "placeholder" => "_ _ _ _ _", "min" => 100.00, "max" => 100000,"required" => true]) }}
                            </div>
                            <div class="m-form__group-sub col-lg-2">
                                <label>Valor Comercial:</label>
                                {{ Form::number("vComercial",null,["class" => "form-control m-input", "id" => "vComercial","placeholder" => "_ _ _ _ _", "min" => 100.00, "max" => 100000,"required" => "required"]) }}
                            </div>
                            <div class="m-form__group-sub col-lg-1">
                                <label>Nro. de Años:</label>
                                {{ Form::number("nAnios",null,["class" => "form-control m-input", "id" => "nAnios", "placeholder" => "", "min" => 1, "max" => 20,"required" => "required"]) }}
                            </div>
                            <div class="m-form__group-sub col-lg-2">
                                <label>Frecuencia del Cupón:</label>
                                {{ Form::select("frecuenciaCupon",array(
                                30 => "MENSUAL",
                                60 => "BIMESTRAL",
                                90 => "TRIMESTRAL",
                                120 => "CUATRIMESTRAL",
                                180 => "SEMESTRAL",
                                360 => "ANUAL"
                                ),null,["class" => "form-control", "id"=>"select2FrecuenciaCupon","required" => "required"]) }}
                            </div>
                            <div class="m-form__group-sub col-lg-2">
                                <label>Días por Años:</label>
                                {{ Form::select("dias_x_anios",array(360 => "360", 365 => "365"),null,["class" => "form-control", "id"=>"select2DiasXAnio","required" => "required"]) }}
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="m-form__group-sub col-lg-2">
                                <label>Tipo de Tasa de Interés:</label>
                                {{ Form::select("tipo_tasa_interes",array("E" => "EFECTIVA", "N" => "NOMINAL"),"E",["class" => "form-control slct_tipo_tasa_interes", "id"=>"select2TipoTasaInteres","required" => "required"]) }}
                            </div>
                            <div class="m-form__group-sub col-lg-2" id="idCapitalizacion" style="display: none;">
                                <label>Capitalización:</label>
                                {{ Form::select("capitalizacion",array(
                                   1 => "DIARIA",
                                   15 => "QUINCENAL",
                                   30 => "MENSUAL",
                                   60 => "BIMESTRAL",
                                   90 => "TRIMESTRAL",
                                   120 => "CUATRIMESTRAL",
                                   180 => "SEMESTRAL",
                                   360 => "ANUAL"
                                   ),
                                   null,["class" => "form-control", "id"=>"select2Capitalizacion","required" => "required"]) }}
                            </div>
                            <div class="m-form__group-sub col-lg-1">
                                <label>Tasa de Interes</label>
                                {{ Form::number("tasaInteres",null,["class" => "form-control m-input", "id" => "tasaInteres", "placeholder" => "0.00 %", "min" => 0.00, "max" => 100.00,"step" => "any","required" => "required"]) }}
                            </div>
                            <div class="m-form__group-sub col-lg-2">
                                <label>Tasa de dsct.</label>
                                {{ Form::number("tasa_anual_descuento",null,["class" => "form-control m-input", "id" => "tasa_anual_descuento","placeholder" => "0.00 %", "min" => 0.00, "max" => 100.00,"step" => "any","required" => "required"]) }}
                            </div>
                            <div class="m-form__group-sub col-lg-2">
                                <label>Impuesto a la Renta</label>
                                {{ Form::number("impRenta",null,["class" => "form-control m-input","id" => "impRenta", "placeholder" => "0.00 %", "min" => 0.00, "max" => 100.00,"step" => "any","required" => "required"]) }}
                            </div>
                            <div class="m-form__group-sub col-lg-2">
                                <label>Fecha de Emisión</label>
                                {{ Form::text("fechaEmisionBono",null,["class" => "form-control m-input", "placeholder" => "dd/mm/AA","id" => "fechaEmisionBono","required" => "required"]) }}
                            </div>
                        </div>

                        <hr>
                    </div>
                </div>

                <h3 class="m-portlet__head-text">
                    Datos de los costes/Gastos Iniciales
                </h3>
                <div class="m-portlet__body">

                    <div class="m-portlet__body">

                        <div class="form-group row">

                            <div class="m-form__group-sub col-lg-1">
                                <label>% Prima</label>
                                {{ Form::number("prima",null,["class" => "form-control m-input","id"=>"prima", "placeholder" => "0.00 %", "min" => 0.00, "max" => 100.00,"step" => "any","required" => "required"]) }}
                            </div>
                            <div class="m-form__group-sub col-lg-2">
                                <label>% Estructuración</label>
                                {{ Form::number("estructuracion",null,["class" => "form-control m-input", "id" => "estructuracion","placeholder" => "0.00 %", "min" => 0.00, "max" => 100.00,"step" => "any","required" => "required"]) }}
                            </div>
                            <div class="m-form__group-sub col-lg-2">
                                <label>% Colocación</label>
                                {{ Form::number("colocacion",null,["class" => "form-control m-input","id" => "colocacion", "placeholder" => "0.00 %", "min" => 0.00, "max" => 100.00,"step" => "any","required" => "required"]) }}
                            </div>
                            <div class="m-form__group-sub col-lg-2">
                                <label>% Flotación</label>
                                {{ Form::number("flotacion",null,["class" => "form-control m-input","id" => "flotacion", "placeholder" => "0.00 %", "min" => 0.00, "max" => 100.00,"step" => "any","required" => "required"]) }}
                            </div>
                            <div class="m-form__group-sub col-lg-2">
                                <label>% CAVALI</label>
                                {{ Form::number("cavali",null,["class" => "form-control m-input", "id" => "cavali", "placeholder" => "0.00 %", "min" => 0.00, "max" => 100.00,"step" => "any","required" => "required"]) }}
                            </div>
                        </div>

                        <hr>
                    </div>
                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions m-form__actions--solid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="button" id="calcular" class="btn btn-primary">Consultar Flujo de Pagos</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>





                <div class="row">
                    <div class="col-lg-10">
                        <h3 class="m-portlet__head-text">
                            Resultados de la estructura del Bono
                        </h3>
                    </div>

                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-primary">Guardar Flujo de Pagos del Bono</button>
                    </div>
                </div>

                <div class="m-portlet__body">
                    <div class="m-portlet__body">
                        <div class="form-group row">
                            <div class="m-form__group-sub col-lg-2">
                                <label>Frecuencia del cupón</label>
                                {{ Form::text("frecuenciaCupon",null,["class" => "form-control m-input","id"=>"frecuenciaCupon", "placeholder" => "- - -", "disabled" => true]) }}
                            </div>
                            <div class="m-form__group-sub col-lg-2">
                                <label>Días capitalización</label>
                                {{ Form::text("diasCapitalizacion",null,["class" => "form-control m-input", "id" => "diasCapitalizacion","placeholder" => "- - -", "disabled" => true]) }}
                            </div>
                            <div class="m-form__group-sub col-lg-2">
                                <label>Nº Períodos por Año</label>
                                {{ Form::text("NroPeriodosXAnio",null,["class" => "form-control m-input","id" => "NroPeriodosXAnio", "placeholder" => "- - - ", "disabled" => true]) }}
                            </div>
                            <div class="m-form__group-sub col-lg-2">
                                <label>Nº Total de periodos</label>
                                {{ Form::text("nTotalPeriodos",null,["class" => "form-control m-input","id" => "nTotalPeriodos", "placeholder" => "- - -", "disabled" => true]) }}
                            </div>
                            <div class="m-form__group-sub col-lg-2">
                                <label>Tasa efectiva anual (TEA)</label>
                                {{ Form::text("tea",null,["class" => "form-control m-input", "id" => "tea", "placeholder" => "0.00 %", "disabled" => true]) }}
                            </div>
                            <div class="m-form__group-sub col-lg-2">
                                <label>Tasa efectiva del período </label>
                                {{ Form::text("tep",null,["class" => "form-control m-input", "id" => "tep", "placeholder" => "0.00 %","disabled" => true]) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="m-form__group-sub col-lg-2">
                                <label>COK del período</label>
                                {{ Form::text("cokTep",null,["class" => "form-control m-input","id"=>"cokTep", "placeholder" => "0.00 %","disabled" => true]) }}
                            </div>
                            <div class="m-form__group-sub col-lg-2">
                                <label>Costes Iniciales Emisor</label>
                                {{ Form::text("costesInicialesEmisor",null,["class" => "form-control m-input", "id" => "costesInicialesEmisor","placeholder" => "- - -", "disabled" => true]) }}
                            </div>
                            <div class="m-form__group-sub col-lg-2">
                                <label>Costes Iniciales Bonista</label>
                                {{ Form::text("costesInicialesBonista",null,["class" => "form-control m-input","id" => "costesInicialesBonista", "placeholder" => "- - - ", "disabled" => true]) }}
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="m-portlet__head-text">
                            Resultados del Precio Actual y Utilidad
                        </h3>
                    </div>
                </div>

                <div class="m-portlet__body">
                    <div class="m-portlet__body">
                        <div class="form-group row">
                            <div class="m-form__group-sub col-lg-2">
                                <label>Precio Actual</label>
                                {{ Form::text("precioActual",null,["class" => "form-control m-input","id"=>"precioActual", "placeholder" => "- - -", "disabled" => true]) }}
                            </div>
                            <div class="m-form__group-sub col-lg-2">
                                <label>Utilidad / Pérdida</label>
                                {{ Form::text("utilidadPerdida",null,["class" => "form-control m-input", "id" => "utilidadPerdida","placeholder" => "- - -", "disabled" => true]) }}
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="m-portlet__head-text">
                            Resultados de los Indicadores de Rentabilidad
                        </h3>
                    </div>
                </div>

                <div class="m-portlet__body">
                    <div class="m-portlet__body">
                        <div class="form-group row">
                            <div class="m-form__group-sub col-lg-2">
                                <label>TCEA Emisor</label>
                                {{ Form::text("tceaEmisor",null,["class" => "form-control m-input","id"=>"tceaEmisor", "placeholder" => "0.00 %", "disabled" => true]) }}
                            </div>
                            <div class="m-form__group-sub col-lg-2">
                                <label>TCEA Emisor c/Escudo</label>
                                {{ Form::text("tceaEmisorEscudo",null,["class" => "form-control m-input", "id" => "tceaEmisorEscudo","placeholder" => "0.00 %", "disabled" => true]) }}
                            </div>
                            <div class="m-form__group-sub col-lg-2">
                                <label>TREA Bonista</label>
                                {{ Form::text("treaBonista",null,["class" => "form-control m-input", "id" => "treaBonista","placeholder" => "0.00 %", "disabled" => true]) }}
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>



                <div class="row">
                    <div class="col-lg-10">
                        <h3 class="m-portlet__head-text">
                            Flujos de Pagos
                        </h3>
                    </div>
                </div>


                {{ Form::close() }}
                <table class="table table-striped- table-bordered table-hover table-checkable" id="dt_flujoPagos" >
                    <thead>

                    </thead>

                    <tbody>

                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection

@section('component-js')
    <script src="{{ asset('js/helpers.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/select2/select2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/jquery-validation/js/additional-methods.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/jquery-validation/js/jquery.validate.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/datatables/js/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/pages/manage/users/administrative/index.js') }}" type="text/javascript"></script>
@endsection
