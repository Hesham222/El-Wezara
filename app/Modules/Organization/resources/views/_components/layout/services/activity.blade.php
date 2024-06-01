@if(checkAdminSideBarActivity(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray()))
    <li class="m-menu__item  m-menu__item--submenu @yield('nav-sports-activities-active')" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a href="{{ route('organizations.navigations.sports-activities') }}" class="m-menu__link m-menu__toggle">
        <i class=" m-menu__link-icon fa fa-futbol-o">
            <span> </span>
        </i>
        <span class="m-menu__link-text">
            الانشطة الرياضية</span>
    </a>
</li>
@endif
