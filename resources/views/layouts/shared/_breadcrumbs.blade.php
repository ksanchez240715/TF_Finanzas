<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
    @if(!empty($breadcrumb_items))
        <li class="m-nav__item m-nav__item--home">
            <a href="{{ route('home') }}" class="m-nav__link m-nav__link--icon">
                <i class="m-nav__link-icon la la-home"></i>
            </a>
        </li>
        <li class="m-nav__separator">
            -
        </li>
        @foreach($breadcrumb_items as $breadcrumb_item)
            <li class="m-nav__item m-nav__item--home">
                @if(empty($breadcrumb_item["URL"]))
                    <a class="m-nav__link m-nav__link--icon" onclick="window.location.reload();">
                        <span class="m-nav__link-text">{{ $breadcrumb_item["NAME"] }}</span>
                    </a>
                @else
                    <a class="m-nav__link m-nav__link--icon"  href="{{ url($breadcrumb_item["URL"]) }}">
                        <span class="m-nav__link-text">{{ $breadcrumb_item["NAME"] }}</span>
                    </a>
                @endif
            </li>
            <li class="m-nav__separator">
                -
            </li>
        @endforeach
    @endif
</ul>
