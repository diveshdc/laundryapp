<div class="sidebar">
    <nav class="sidebar-nav ps ps--active-y">

        <ul class="nav">
            <li class="nav-item">
                <a href="{{ route('admin.home') }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link  ">
                    <i class="fas fa-users nav-icon">

                    </i>
                    {{ trans('global.userManagement.title') }}
                </a>
                <!-- <ul class="nav-item"> -->
                    <li class="nav-item">
                        <a href="{{ route('admin.permissions.index') }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                            <i class="fas fa-unlock-alt nav-icon">

                            </i>
                            {{ trans('global.permission.title') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.roles.index') }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                            <i class="fas fa-briefcase nav-icon">

                            </i>
                            {{ trans('global.role.title') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                            <i class="fas fa-user nav-icon">
                            </i>
                            {{ trans('global.user.title') }}
                        </a>
                    </li>
                   <!--  <li class="nav-item">
                        <a href="{{ route("admin.clients.index") }}" class="nav-link {{ request()->is('admin/clients') || request()->is('admin/clients/*') ? 'active' : '' }}">
                            <i class="fas fa-user nav-icon">

                            </i>
                            {{ trans('global.client.title') }}
                        </a>
                    </li> -->
                    <li class="nav-item">
                        <a href="{{ route('admin.drivers.index') }}" class="nav-link {{ request()->is('admin/drivers') || request()->is('admin/drivers/*') ? 'active' : '' }}">
                            <i class="fas fa-user nav-icon">

                            </i>
                            {{ trans('global.driver.title') }}
                        </a>
                    </li>
                <!-- </ul> -->
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->is('admin/products') || request()->is('admin/products/*') ? 'active' : '' }}">
                    <i class="fas fa-cogs nav-icon">

                    </i>
                    {{ trans('global.product.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.category.index') }}" class="nav-link {{ request()->is('admin/category') || request()->is('admin/category/*') ? 'active' : '' }}">
                    <i class="fas fa-user nav-icon ">

                    </i>
                    {{ trans('global.category.title') }}
                </a>
            </li>

                 <li class="nav-item">
                <a href="{{ route('admin.order.index') }}" class="nav-link {{ request()->is('admin/order') || request()->is('admin/order/*') ? 'active' : '' }}">
                    <i class="fas fa-shopping-bag nav-icon">

                    </i>
                    {{ trans('global.order.orders') }}
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.coupons.index') }}" class="nav-link {{ request()->is('admin/coupons') || request()->is('admin/coupons/*') ? 'active' : '' }}">
                    <i class="fas fa-user nav-icon ">

                    </i>
                    {{ trans('global.coupon.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.postcode.index') }}" class="nav-link {{ request()->is('admin/postcode') || request()->is('admin/postcode/*') ? 'active' : '' }}">
                    <i class="fa fa-map-pin nav-icon">

                    </i>
                    {{ trans('global.postcode.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.pushnotification.index') }}" class="nav-link {{ request()->is('admin/pushnotification') || request()->is('admin/pushnotification/*') ? 'active' : '' }}">
                    <i class="fa fa-bell nav-icon"></i>

                    {{ trans('global.pushnotification.title') }}
                </a>
            </li>

             <li class="nav-item">
                <a href="{{ route('admin.timeslot.index') }}" class="nav-link {{ request()->is('admin/timeslot') || request()->is('admin/timeslot/*') ? 'active' : '' }}">
                    <i class="fa fa-calendar nav-icon">

                    </i>
                    {{ trans('global.timeslot.title') }}
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>

        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 869px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 415px;"></div>
        </div>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>