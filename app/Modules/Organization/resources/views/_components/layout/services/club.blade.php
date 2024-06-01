@if(checkAdminSideBarClubServices(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray()))
<li class="m-menu__item  m-menu__item--submenu @yield('nav-club-active')" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a href="{{ route('organizations.navigations.club') }}" class="m-menu__link m-menu__toggle">
        <i class=" m-menu__link-icon fa fa-flag">
            <span> </span>
        </i>
        <span class="m-menu__link-text">خدمات النادي</span>
    </a>
</li>
@endif
