<div class="m-stack m-stack--ver m-stack--desktop">
    <div class="m-stack__item m-brand  m-brand--skin-dark ">
        <div class="m-stack m-stack--ver m-stack--general">
            <div class="m-stack__item m-stack__item--middle m-stack__item--center m-brand__logo">
                <a href="{{ url('inicio') }}" class="m-brand__logo-wrapper">
{{--                    <img class="img-main" src="{{ asset('img/ovintellegi_login.svg') }}">--}}
                    <img class="img-main" src="{{ asset('img/logo.png') }}">
                </a>
            </div>
            <div class="m-stack__item m-stack__item--middle m-brand__tools">
                <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                    <span></span>
                </a>
                <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                    <i class="flaticon-more"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
        <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn">
            <i class="la la-close"></i>
        </button>
        <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
            <div class="m-stack__item m-topbar__nav-wrapper">
                <ul class="m-topbar__nav m-nav m-nav--inline">
                    <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
                        <a href="#" class="m-nav__link m-dropdown__toggle">
                            <span class="m-topbar__userpic">
                                <img src="{{ asset('img/usuario_hombre.jpg') }}" alt=""/>
                            </span>
                        </a>
                        <div class="m-dropdown__wrapper">
                            <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                            <div class="m-dropdown__inner">
                                <div class="m-dropdown__header m--align-center" style="background: url(assets/app/media/img/misc/user_profile_bg.jpg); background-size: cover;">
                                    <div class="m-card-user m-card-user--skin-dark">
                                        <div class="m-card-user__pic">
                                            <img src="{{ asset('img/usuario_hombre.jpg') }}" alt=""/>
                                        </div>
                                        <div class="m-card-user__details">
                                            <span class="m-card-user__name m--font-weight-500">{{ Auth::user()->name }}</span>
                                            <a href="" class="m-card-user__email m--font-weight-300 m-link">{{ Auth::user()->email }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-dropdown__body">
                                    <div class="m-dropdown__content">
                                        <ul class="m-nav m-nav--skin-light">
                                            <li class="m-nav__section m--hide">
                                                <span class="m-nav__section-text">Section</span>
                                            </li>
                                            <li class="m-nav__item">
                                                <a href="profile.html" class="m-nav__link">
                                                    <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                    <span class="m-nav__link-title">
                                                        <span class="m-nav__link-wrap">
                                                            <span class="m-nav__link-text">Mi perfil</span>
                                                            {{--<span class="m-nav__link-badge"><span class="m-badge m-badge--success">2</span></span>--}}
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-nav__separator m-nav__separator--fit">
                                            </li>
                                            <li class="m-nav__item">
                                                <a href="{{ route('logout') }}" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">
                                                    Cerrar Sesión
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
