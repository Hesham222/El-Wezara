@if(checkAdminSideBarEvent(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray()))

    <li class="m-menu__item  m-menu__item--submenu @yield('nav-event-active')" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a href="{{ route('organizations.navigations.event') }}" class="m-menu__link m-menu__toggle">
        <i class=" m-menu__link-icon fa fa-gift">
            <span> </span>
        </i>
        <span class="m-menu__link-text">خدمات المناسبات
        </span>
    </a>

</li>
@endif
