@if(checkAdminSideBarLaundry(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray()))

    <li class="m-menu__item  m-menu__item--submenu @yield('nav-laundry-active')" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a href="{{ route('organizations.navigations.laundry') }}" class="m-menu__link m-menu__toggle">
        <i class=" m-menu__link-icon fa fa-shower">
            <span> </span>
        </i>
        <span class="m-menu__link-text">خدمة المغاسل
        </span>
    </a>
</li>
@endif
