@extends('layouts.app')

@section('component-css')
    <link href="{{ asset('plugins/datatables/css/datatables.bundle.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')

    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Listado de Personal Administrativo
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="{{ route("manage.user.administrativos.get.create",["type" => $type]) }}" class="btn btn-primary m-btn m-btn--air m-btn--icon">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>Agregar Administrativo</span>
                                </span>
                            </a>
                        </li>
                        <li class="m-portlet__nav-item"></li>
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">
                {{ Form::hidden('typeList', $type, array('id' => 'typeList')) }}
                <div class="m-form--label-align-right m--margin-bottom-30">
                    <div class="row align-items-center">
                        <div class="col-xl-8 order-2 order-xl-1">
                            <div class="row">
                                <div class="form-group m-form__group col-xl-4">
                                    <label>&emsp;</label>
                                    <div class="m-input m-input-icon m-input-icon--left">
                                        <input type="text" class="form-control m-input m-input--pill m-input--solid" placeholder="Buscar..." id="search">
                                        <span class="m-input-icon__icon m-input-icon__icon--left">
                                        <span><i class="la la-search"></i></span>
                                    </span>
                                    </div>
                                </div>
                                <div class="form-group m-form__group col-xl-4">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped- table-bordered table-hover table-checkable" id="dt_administratives" >
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
    <script src="{{ asset('plugins/datatables/js/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/pages/manage/users/administrative/index.js') }}" type="text/javascript"></script>
@endsection
