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
                            Gestion de Calendario de Fechas
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav" style="color: white;">
                        <li class="m-portlet__nav-item">
                            <a class="btn btn-primary m-btn m-btn--air m-btn--icon btn-division">
                                <span>
                                    <i class="flaticon-cogwheel-1"></i>
                                    <span>División de Meses</span>
                                </span>
                            </a>
                        </li>
                        <li class="m-portlet__nav-item"></li>
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="m-portlet m-portlet--tabs">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-tools">
                            <ul class="nav nav-tabs m-tabs-line m-tabs-line--success m-tabs-line--2x" role="tablist">
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_portlet_base_demo_1_tab_content" role="tab" aria-expanded="false">
                                        <i class="flaticon-suitcase"></i>
                                        Inscripción y Presentación de Avances
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_portlet_base_demo_2_tab_content" role="tab" aria-expanded="false">
                                        <i class="flaticon-folder-1"></i>
                                        Evaluaciones
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_portlet_base_demo_3_tab_content" role="tab" aria-expanded="true">
                                        <i class="flaticon-edit"></i>
                                        Levantamiento de Observaciones
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_portlet_base_demo_4_tab_content" role="tab" aria-expanded="true">
                                        <i class="flaticon-clipboard"></i>
                                        Evaluación de Observaciones
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="m_portlet_base_demo_1_tab_content" role="tabpanel">

                                <table class="table table-striped- table-bordered table-hover table-checkable" id="dt_inscription" >
                                    <thead>

                                    </thead>

                                    <tbody>

                                    </tbody>

                                </table>

                            </div>
                            <div class="tab-pane" id="m_portlet_base_demo_2_tab_content" role="tabpanel">

                                <table class="table table-striped- table-bordered table-hover table-checkable" id="dt_evaluation" >
                                    <thead>

                                    </thead>

                                    <tbody>

                                    </tbody>

                                </table>

                            </div>
                            <div class="tab-pane" id="m_portlet_base_demo_3_tab_content" role="tabpanel">

                                <table class="table table-striped- table-bordered table-hover table-checkable" id="dt_lifting" >
                                    <thead>

                                    </thead>

                                    <tbody>

                                    </tbody>

                                </table>

                            </div>
                            <div class="tab-pane" id="m_portlet_base_demo_4_tab_content" role="tabpanel">

                                <table class="table table-striped- table-bordered table-hover table-checkable" id="dt_observation" >
                                    <thead>

                                    </thead>

                                    <tbody>

                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('component-js')
    <script src="{{ asset('js/helpers.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/datatables/js/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/pages/manage/schedule/index.js') }}" type="text/javascript"></script>
@endsection
