@if(checkAdminSideBarHotel(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray()))

    <li class="m-menu__item  m-menu__item--submenu @yield('nav-hotel-active')" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a href="{{ route('organizations.navigations.hotel') }}" class="m-menu__link m-menu__toggle">
        <i class=" m-menu__link-icon fa fa-building">
            <span> </span>
        </i>
        <span class="m-menu__link-text">خدمات الفندق
        </span>
    </a>
</li>
@endif
