@extends('layouts.auth')

@section('content')

    <style>
        .form-control.m-input{
            margin-top: 0 !important;
            margin-bottom: 0.5rem;
        }
        label{
            color: #302e41 !important;
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
                                Inicie Sesión
                            </h3>
                        </div>
                        <form class="m-login__form m-form" method="POST" action="{{ route('login.post') }}">
                            {{ csrf_field() }}
                            <div class="form-group m-form__group{{ $errors->has('username') ? ' has-danger' : '' }}">
                                <label class="col-md-12 control-label">Usuario</label>
                                <input class="form-control m-input" value="{{ old('username') }}" type="text" name="username" autocomplete="off">
                                @if ($errors->has('username'))
                                    <div id="email-error" class="form-control-feedback">
                                        {{ $errors->first('username') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group m-form__group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <label class="col-md-4 control-label">Contraseña</label>
                                <input class="form-control m-input m-login__form-input--last" type="password" name="password" autocomplete="off">
                                @if ($errors->has('password'))
                                    <div id="password-error" class="form-control-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                            <div class="row m-login__form-sub">
                                <div class="col m--align-left m-login__form-left">
                                    <label class="m-checkbox  m-checkbox--light">
                                        <input type="checkbox" name="remember">
                                        Recordar datos
                                        <span></span>
                                    </label>
                                </div>
{{--                                <div class="col m--align-right m-login__form-right">--}}
{{--                                    <a href="javascript:;" id="m_login_forget_password" class="m-link">--}}
{{--                                        ¿ Olvido la clave ?--}}
{{--                                    </a>--}}
{{--                                </div>--}}
                                <div class="col m--align-right m-login__form-right">
                                    <a href="{{ route('register') }}" id="m_login_forget_password" class="m-link">
                                        ¿ Eres nuevo ? | Regsitrate
                                    </a>
                                </div>
                            </div>
                            <div class="m-login__form-action">
                                <button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn m-login__btn--primary">
                                    Ingresar
                                </button>
                            </div>
                        </form>
                    </div>


                    <div class="m-login__forget-password">
                        <div class="m-login__head">
                            <h3 class="m-login__title">
                                ¿ Olvido la contraseña ?
                            </h3>
                            <div class="m-login__desc">
                                Ingrese su correo electronico para recuperar contraseña:
                            </div>
                        </div>
                        <form class="m-login__form m-form" action="">
                            <div class="form-group m-form__group">
                                <input class="form-control m-input" type="text" placeholder="Email" name="email" id="m_email" autocomplete="off">
                            </div>
                            <div class="m-login__form-action">
                                <button id="m_login_forget_password_submit" class="btn m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">
                                    Enviar
                                </button>
                                &nbsp;&nbsp;
                                <button id="m_login_forget_password_cancel" class="btn m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn">
                                    Cancelar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
