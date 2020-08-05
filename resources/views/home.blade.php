@extends('layouts.app')


@section('content')

    <div class="m-content">
        <div class="m-portlet">
            <div class="m-portlet__body m-portlet__body--no-padding">
                <div class="m-invoice-1">
                    <div class="m-invoice__wrapper">
                        <div class="m-invoice__head" style="background-image: url('{{ asset('img/home.jpg') }}');">
                            <div class="m-invoice__container m-invoice__container--centered">
                                <div class="m-invoice__logo">
                                    {{--<a href="#">--}}
                                    <h1 style="color: #ffffff; text-align: center">SIMULADOR DE PLAN DE PAGOS | BONO ALEMAN</h1>
                                    {{--</a>--}}
                                </div>

                            </div>
                        </div>
                        {{--<div class="m-invoice__body m-invoice__body--centered">--}}
                        {{--<div class="table-responsive">--}}

                        {{--</div>--}}
                        {{--</div>--}}

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
