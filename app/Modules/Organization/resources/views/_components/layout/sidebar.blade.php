<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
  <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
    <i class="la la-close">
    </i>
  </button>
  <div id="m_aside_left" style="background: black" class="m-grid__item  m-aside-left  m-aside-left--skin-dark ">
    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
      <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">

              @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'OrganizationDashboard-View'))
              <li class="m-menu__item  m-menu__item @yield('dashboard-active')" aria-haspopup="true">
                  <a href="{{ route('organizations.home') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-line-graph">
                    </i>
                    <span class="m-menu__link-title">
                      <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text">لوحة التحكم
                        </span>
                      </span>
                    </span>
                  </a>
                </li>
              @endif
              @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'OrganizationDashboard-View-Event'))
              <li class="m-menu__item  m-menu__item @yield('events-dashboard-active')" aria-haspopup="true">
              <a href="{{ route('organizations.events-dashboard') }}" class="m-menu__link ">
                  <i class="m-menu__link-icon fa fa-calendar">
                  </i>
                  <span class="m-menu__link-title">
              <span class="m-menu__link-wrap">
                <span class="m-menu__link-text">لوحة التحكم الحفالات
                </span>
              </span>
            </span>
              </a>
          </li>
              @endif

              @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'OrganizationDashboard-View-Housing'))
              <li class="m-menu__item  m-menu__item @yield('housing-dashboard-active')" aria-haspopup="true">
              <a href="{{ route('organizations.housing-dashboard') }}" class="m-menu__link ">
                  <i class="m-menu__link-icon fa fa-bar-chart">
                  </i>
                  <span class="m-menu__link-title">
              <span class="m-menu__link-wrap">
                <span class="m-menu__link-text">لوحة تحكم الاسكان
                </span>
              </span>
            </span>
              </a>
          </li>
              @endif

              {{-- @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'OrganizationDashboard-View-Setting'))
              <li class="m-menu__item  m-menu__item @yield('events-settings-active')" aria-haspopup="true">
              <a href="{{ route('organizations.setting.index') }}" class="m-menu__link ">
                  <i class="m-menu__link-icon fa fa-cogs">
                  </i>
                  <span class="m-menu__link-title">
              <span class="m-menu__link-wrap">
                <span class="m-menu__link-text">الاعدادت
                </span>
              </span>
            </span>
              </a>
          </li>
              @endif --}}

              @if(checkAdminSideBarInventory(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray()))
              <li class="m-menu__item  m-menu__item @yield('inventory-active')" aria-haspopup="true">
              <a href="{{ route('organizations.inventory') }}" class="m-menu__link ">
                  <i class="m-menu__link-icon fa fa-database">
                  </i>
                  <span class="m-menu__link-title">
              <span class="m-menu__link-wrap">
                <span class="m-menu__link-text">المخزن
                </span>
              </span>
            </span>
              </a>
          </li>
              @endif
        @include('Organization::_components.layout.services._active_services')

      </ul>
    </div>
  </div>
</div>
