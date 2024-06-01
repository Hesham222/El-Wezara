<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
  <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
    <i class="la la-close">
    </i>
  </button>
  <div id="m_aside_left" style="background: black" class="m-grid__item  m-aside-left  m-aside-left--skin-dark ">
      <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
          <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
              @if(checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Dashboard-Module'))
                  <li class="m-menu__item  m-menu__item @yield('dashboard-active')" aria-haspopup="true">
                      <a href="{{ route('admins.home') }}" class="m-menu__link ">
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
                  <li class="m-menu__item  m-menu__item @yield('events-dashboard-active')" aria-haspopup="true">
                      <a href="{{ route('admins.sports-activities-home') }}" class="m-menu__link ">
                          <i class="m-menu__link-icon flaticon-line-graph">
                          </i>
                          <span class="m-menu__link-title">
                  <span class="m-menu__link-wrap">
                    <span class="m-menu__link-text">لوحة التحكم الانشطة الرياضية
                    </span>
                  </span>
                </span>
                      </a>
                  </li>
                  <li class="m-menu__item  m-menu__item @yield('hr-dashboard-active')" aria-haspopup="true">
                      <a href="{{ route('admins.hr-home') }}" class="m-menu__link ">
                          <i class="m-menu__link-icon flaticon-line-graph">
                          </i>
                          <span class="m-menu__link-title">
                  <span class="m-menu__link-wrap">
                    <span class="m-menu__link-text">لوحة التحكم الموارد البشريه
                    </span>
                  </span>
                </span>
                      </a>
                  </li>
                  <li class="m-menu__item  m-menu__item @yield('rents-dashboard-active')" aria-haspopup="true">
                      <a href="{{ route('admins.rents-home') }}" class="m-menu__link ">
                          <i class="m-menu__link-icon flaticon-line-graph">
                          </i>
                          <span class="m-menu__link-title">
                  <span class="m-menu__link-wrap">
                    <span class="m-menu__link-text">لوحة التحكم الايجارات
                    </span>
                  </span>
                </span>
                      </a>
                  </li>
                  <li class="m-menu__item  m-menu__item @yield('sports-activities-dashboard-active')" aria-haspopup="true">
                      <a href="{{ route('admins.events-home') }}" class="m-menu__link ">
                          <i class="m-menu__link-icon flaticon-line-graph">
                          </i>
                          <span class="m-menu__link-title">
                  <span class="m-menu__link-wrap">
                    <span class="m-menu__link-text">لوحة التحكم المناسابات
                    </span>
                  </span>
                </span>
                      </a>
                  </li>
              @endif
              <li class="m-menu__section ">
                  <h4 class="m-menu__section-text">العناصر</h4>
                  <i class="m-menu__section-icon flaticon-more-v2"></i>
              </li>
              @if(checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Add')||checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')
                ||checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-View')||checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')||checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Change-Password'))
              <!-- Start Admin Module -->
                  <li class="m-menu__item  m-menu__item--submenu @yield('admins-active')" aria-haspopup="true" m-menu-submenu-toggle="hover">
                      <a href="javascript:;" class="m-menu__link m-menu__toggle">
                          <i class="m-menu__link-icon fa fa-users"> </i>
                          <span class="m-menu__link-text">المشرفين </span>
                          <i class="m-menu__ver-arrow la la-angle-right"></i>
                      </a>
                      <div class="m-menu__submenu ">
                          <span class="m-menu__arrow"></span>
                          <ul class="m-menu__subnav">
                              @if(checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Add'))
                                  <li class="m-menu__item @yield('admins-create-active')" aria-haspopup="true">
                                      <a href="{{route('admins.admin.create')}}" class="m-menu__link ">
                                          <i class="m-menu__link-bullet m-menu__link-icon fa fa-plus">
                                              <span></span>
                                          </i>
                                          <span class="m-menu__link-text"> اضف جديد</span>
                                      </a>
                                  </li>
                              @endif
                              @if(checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')
                              ||checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-View')||checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')||checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Change-Password'))
                                      <li class="m-menu__item @yield('admins-view-active')" aria-haspopup="true">
                                          <a href="{{route('admins.admin.index').'?view=view'}}" class="m-menu__link ">
                                              <i class="m-menu__link-bullet m-menu__link-icon fa fa-eye">
                                                  <span> </span>
                                              </i>
                                              <span class="m-menu__link-text">عرض</span>
                                          </a>
                                      </li>
                              @endif
                              @if(checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete'))
                                      <li class="m-menu__item @yield('admins-trash-active')" aria-haspopup="true">
                                          <a href="{{route('admins.admin.index').'?view=trash'}}" class="m-menu__link ">
                                              <i class="m-menu__link-bullet m-menu__link-icon fa fa-trash">
                                                  <span></span>
                                              </i>
                                          <span class="m-menu__link-text"> سله المهملات
                                            <span class="m-menu__link-badge">
                                                <span class="m-badge m-badge--danger" id="module-admins">
                                                {{$adminTrashesCount}}
                                                </span>
                                            </span>
                                         </span>
                                         </a>
                                      </li>
                              @endif
                          </ul>
                      </div>
                  </li>
              <!-- End Admin Module -->
              @endif
              @if(checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Module')||checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Add')||checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Edit')
                ||checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-View')||checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Delete'))
              <!-- Start Organization Module -->
                  <li class="m-menu__item  m-menu__item--submenu @yield('organizations-active')" aria-haspopup="true" m-menu-submenu-toggle="hover">
                      <a href="javascript:;" class="m-menu__link m-menu__toggle">
                          <i class="m-menu__link-icon fa fa-building"> </i>
                          <span class="m-menu__link-text">المنظمات </span>
                          <i class="m-menu__ver-arrow la la-angle-right"></i>
                      </a>
                      <div class="m-menu__submenu ">
                          <span class="m-menu__arrow"></span>
                          <ul class="m-menu__subnav">
                              @if(checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Module')||checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Add'))
                                  <li class="m-menu__item @yield('organizations-create-active')" aria-haspopup="true">
                                      <a href="{{route('admins.organization.create')}}" class="m-menu__link ">
                                          <i class="m-menu__link-bullet m-menu__link-icon fa fa-plus">
                                              <span></span>
                                          </i>
                                          <span class="m-menu__link-text"> اضف جديد</span>
                                      </a>
                                  </li>
                              @endif
                                  @if(checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Module')||checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Edit')
                                  ||checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-View')||checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Delete'))
                                      <li class="m-menu__item @yield('organizations-view-active')" aria-haspopup="true">
                                          <a href="{{route('admins.organization.index').'?view=view'}}" class="m-menu__link ">
                                              <i class="m-menu__link-bullet m-menu__link-icon fa fa-eye">
                                                  <span> </span>
                                              </i>
                                              <span class="m-menu__link-text">عرض</span>
                                          </a>
                                      </li>
                                  @endif
                                  @if(checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Module')||checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Organization-Delete'))
                                      <li class="m-menu__item @yield('organizations-trash-active')" aria-haspopup="true">
                                          <a href="{{route('admins.organization.index').'?view=trash'}}" class="m-menu__link ">
                                              <i class="m-menu__link-bullet m-menu__link-icon fa fa-trash">
                                                  <span></span>
                                              </i>
                                              <span class="m-menu__link-text"> سله المهملات
                                                <span class="m-menu__link-badge">
                                                  <span class="m-badge m-badge--danger" id="module-organizations">
                                                    {{$organizationTrashesCount}}
                                                  </span>
                                                </span>
                                              </span>
                                          </a>
                                      </li>
                          </ul>
                      </div>
                                      </li>
                               @endif

              <!-- End organizations Module -->
              @endif
              @if(checkAdminPermission(auth('admin')->user()->role->permissions->pluck('permission_id')->toArray(),'All-Modules'))
              <!-- Start Role Module -->
                  <li class="m-menu__item  m-menu__item--submenu @yield('roles-active')" aria-haspopup="true" m-menu-submenu-toggle="hover">
                      <a href="javascript:;" class="m-menu__link m-menu__toggle">
                          <i class="m-menu__link-icon fa fa-sitemap"> </i>
                          <span class="m-menu__link-text">الأدوار </span>
                          <i class="m-menu__ver-arrow la la-angle-right"></i>
                      </a>
                      <div class="m-menu__submenu ">
                          <span class="m-menu__arrow"></span>
                          <ul class="m-menu__subnav">
                              <li class="m-menu__item @yield('roles-create-active')" aria-haspopup="true">
                                  <a href="{{route('admins.role.create')}}" class="m-menu__link ">
                                      <i class="m-menu__link-bullet m-menu__link-icon fa fa-plus">
                                          <span></span>
                                      </i>
                                      <span class="m-menu__link-text"> اضف جديد</span>
                                  </a>
                              </li>
                              <li class="m-menu__item @yield('roles-view-active')" aria-haspopup="true">
                                  <a href="{{route('admins.role.index').'?view=view'}}" class="m-menu__link ">
                                      <i class="m-menu__link-bullet m-menu__link-icon fa fa-eye">
                                          <span> </span>
                                      </i>
                                      <span class="m-menu__link-text">عرض</span>
                                  </a>
                              </li>
                              <li class="m-menu__item @yield('roles-trash-active')" aria-haspopup="true">
                                  <a href="{{route('admins.role.index').'?view=trash'}}" class="m-menu__link ">
                                      <i class="m-menu__link-bullet m-menu__link-icon fa fa-trash">
                                          <span></span>
                                      </i>
                                      <span class="m-menu__link-text"> سله المهملات
            <span class="m-menu__link-badge">
              <span class="m-badge m-badge--danger" id="module-admins">
                {{$roleTrashesCount}}
              </span>
            </span>
          </span>
                                  </a>
                              </li>
                          </ul>
                      </div>
                  </li>
              <!-- End Role Module -->


                  <!-- Start Role Module -->
                  <li class="m-menu__item  m-menu__item--submenu @yield('calendar-active')" aria-haspopup="true" m-menu-submenu-toggle="hover">
                      <a href="javascript:;" class="m-menu__link m-menu__toggle">
                          <i class="m-menu__link-icon fa fa-sitemap"> </i>
                          <span class="m-menu__link-text">النتيجه </span>
                          <i class="m-menu__ver-arrow la la-angle-right"></i>
                      </a>
                      <div class="m-menu__submenu ">
                          <span class="m-menu__arrow"></span>
                          <ul class="m-menu__subnav">
                              <li class="m-menu__item @yield('calendar-view-active')" aria-haspopup="true">
                                  <a href="{{route('admins.calendar.view')}}" class="m-menu__link ">
                                      <i class="m-menu__link-bullet m-menu__link-icon fa fa-plus">
                                          <span></span>
                                      </i>
                                      <span class="m-menu__link-text"> عرض</span>
                                  </a>
                              </li>
                          </ul>
                      </div>
                  </li>
                  <!-- End Role Module -->


              @endif
        </ul>
      </div>
  </div>
</div>
