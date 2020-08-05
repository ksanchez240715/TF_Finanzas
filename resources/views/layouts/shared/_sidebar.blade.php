<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark m-aside-menu--dropdown " data-menu-vertical="true" m-menu-dropdown="1" m-menu-scrollable="0" m-menu-dropdown-timeout="500">
    <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
        @if(Auth::user()->hasRole('administrador'))
            <li class="m-menu__item  {{ Request::is('humanresources*') ? 'm-menu__item--active' : '' }}" aria-haspopup="true" >
                <a  href="{{ route("humanresources.index") }}" class="m-menu__link ">
                    <span class="m-menu__item-here"></span>
                    <i class="m-menu__link-icon fa fa-chalkboard-teacher"></i>
                    <span class="m-menu__link-text">Recursos Humanos</span>
                </a>
            </li>
            <li class="m-menu__item  {{ Request::is('inventory*') ? 'm-menu__item--active' : '' }}" aria-haspopup="true" >
                <a  href="{{ route("inventory.index") }}" class="m-menu__link ">
                    <span class="m-menu__item-here"></span>
                    <i class="m-menu__link-icon la la-paste"></i>
                    <span class="m-menu__link-text">Inventario</span>
                </a>
            </li>
        @endif


        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  m-menu-submenu-toggle="hover">
            <a  href="javascript:;" class="m-menu__link m-menu__toggle">
                <span class="m-menu__item-here"></span>
                <i class="m-menu__link-icon flaticon-open-box"></i>
                <span class="m-menu__link-text">CONSULTAR</span>
                <i class="m-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="m-menu__submenu ">
                <span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
							<span class="m-menu__link">
								<span class="m-menu__item-here"></span>
								<span class="m-menu__link-text">CONSULTAR</span>
							</span>
                    </li>
                    <li class="m-menu__item " aria-haspopup="true" >
                        <a  href="{{ route("index.bonos") }}" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">Metodo Aleman</span>
                        </a>
                    </li>
                    <li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
                        <a  href="builder.html" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">Historial</span>
                        </a>
                    </li>
            </div>
        </li>
    </ul>
</div>
