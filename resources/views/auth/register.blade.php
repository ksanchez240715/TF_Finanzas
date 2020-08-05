@extends('layouts.auth')

@section('content')
<style>
    .form-control.m-input{
        margin-top: 0 !important;
        margin-bottom: 0.5rem;
    }
    label{
        color: #2e5688 !important;
        font-weight: 600;
    }
</style>
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-1" id="m_login" style="opacity: 0.84; background-image: url({{ asset('img/fondo2.png') }})">
            <div class="m-grid__item m-grid__item--fluid m-login__wrapper">
                <div class="m-login__container">
                    <div class="m-login__logo">
                        <a href="#">
                            {{--                            <img src="{{ asset('img/ovintellegi_login.svg') }}">--}}
                            <img src="{{ asset('img/logo.png') }}">
                        </a>
                    </div>
                    <div class="m-login__signin">
                        <div class="m-login__head">
                            <h3 class="m-login__title">
                                Registrarse
                            </h3>
                        </div>
{{--                        <form class="form-horizontal" method="POST" action="{{ route('register') }}">--}}
                        <form class="m-login__form m-form" method="POST" action="{{ route('register.post') }}">
                            {{ csrf_field() }}
                            <div class="form-group m-form__group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label for="name" class="col-md-12 control-label">Nombres completos</label>
                                <input class="form-control m-input" value="{{ old('name') }}" type="text" name="name" autocomplete="off">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group m-form__group{{ $errors->has('paternalSurname') ? ' has-danger' : '' }}">
                                <label for="paternalSurname" class="col-md-12 control-label">Apellido paterno</label>
                                <input class="form-control m-input" value="{{ old('paternalSurname') }}" type="text" name="paternalSurname" autocomplete="off">
                                @if ($errors->has('paternalSurname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('paternalSurname') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group m-form__group{{ $errors->has('maternalSurname') ? ' has-danger' : '' }}">
                                <label for="maternalSurname" class="col-md-12 control-label">Apellido materno</label>
                                <input class="form-control m-input" value="{{ old('maternalSurname') }}" type="text" name="maternalSurname" autocomplete="off">
                                @if ($errors->has('maternalSurname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('maternalSurname') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group m-form__group{{ $errors->has('username') ? ' has-danger' : '' }}">
                                <label for="username" class="col-md-12 control-label">Usuario</label>
                                <input class="form-control m-input" value="{{ old('username') }}" type="text" name="username" autocomplete="off">
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group m-form__group{{ $errors->has('dni') ? ' has-danger' : '' }}">
                                <label for="dni" class="col-md-12 control-label">DNI</label>
                                <input class="form-control m-input" value="{{ old('dni') }}" type="text" name="dni" autocomplete="off">
                                @if ($errors->has('dni'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dni') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group m-form__group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label for="email" class="col-md-12 control-label">Correo electronico</label>

                                <input class="form-control m-input m-login__form-input--last" type="text" name="email" autocomplete="off">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group m-form__group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <label for="password" class="col-md-12 control-label">Contraseña</label>
                                <input class="form-control m-input m-login__form-input--last" type="password" name="password" autocomplete="off">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group m-form__group{{ $errors->has('password-confirm') ? ' has-danger' : '' }}">
                                <label for="password-confirm" class="col-md-12 control-label">Confirmar Contraseña</label>
                                <input class="form-control m-input m-login__form-input--last" type="password" id="password-confirm" name="password_confirmation" autocomplete="off">
                                @if ($errors->has('password-confirm'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password-confirm') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="m-login__form-action">
                                <button type="submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn m-login__btn--primary">
                                    Registrar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection
