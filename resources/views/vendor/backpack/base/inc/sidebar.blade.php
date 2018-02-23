@if (Auth::check())
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="{{ backpack_avatar_url(Auth::user()) }}" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>{{ Auth::user()->name }}</p>
            <small><small><a href="{{ route('backpack.account.info') }}"><span><i class="fa fa-user-circle-o"></i> {{ trans('backpack::base.my_account') }}</span></a> &nbsp;  &nbsp; <a href="{{ backpack_url('logout') }}"><i class="fa fa-sign-out"></i> <span>{{ trans('backpack::base.logout') }}</span></a></small></small>
          </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            {{-- <li class="header">{{ trans('backpack::base.administration') }}</li> --}}
          <!-- ================================================ -->
          <!-- ==== Recommended place for admin menu items ==== -->
          <!-- ================================================ -->
          {{-- @hasrole('super-admin') --}}
          @can ('show admin menu')
              {{-- <li class="header">{{ trans('backpack::base.administration') }}</li> --}}
          <li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>

          <li class="treeview">
              <a href="#"><i class="fa fa-globe"></i> <span>Translations</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                  <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/language') }}"><i class="fa fa-flag-checkered"></i> Languages</a></li>
                  <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/language/texts') }}"><i class="fa fa-language"></i> Site texts</a></li>
              </ul>
          </li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/elfinder') }}"><i class="fa fa-files-o"></i> <span>File manager</span></a></li>
          <li><a href="{{ url('admin/menu-item') }}"><i class="fa fa-list"></i> <span>Menu</span></a></li>
          <!-- Users, Roles Permissions -->
          <li class="treeview">
              <a href="#"><i class="fa fa-group"></i> <span>Users, Roles, Permissions</span> <i class="fa fa-angle-left     pull-right"></i></a>
              <ul class="treeview-menu">
                  <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/user') }}"><i class="fa fa-user"></i> <span>Users</span></a></li>
                  <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/role') }}"><i class="fa fa-group"></i> <span>Roles</span></a></li>
                  <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/permission') }}"><i class="fa fa-key"></i> <span>Permissions</span></a></li>
                  <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/page') }}"><i class="fa fa-file-o"></i> <span>Pages</span></a></li>
                  {{-- <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/setting') }}"><i class="fa fa-cog"></i> <span>Settings</span></a></li> --}}
              </ul>
          </li>


          @endcan
{{-- @endhasrole --}}

        <!-- ================================================ -->
        <!-- ====              CONFIG MENU               ==== -->
        <!-- ================================================ -->


          <!-- ================================================ -->
          <!-- ====               USER MENU                ==== -->
          <!-- ================================================ -->
          @can ('show user menu')
              <li class="header">{{ trans('backpack::base.user') }}</li>
                <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
              <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/calendar') }}"><i class="fa fa-calendar"></i> <span>{{ trans('informacrm.calendar') }}</span></a></li>
              <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/account') }}"><i class="fa fa-address-book-o"></i> <span>{{ trans('informacrm.accounts') }}</span></a></li>
              <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/opportunity') }}"><i class="fa fa-money"></i> <span>{{ trans('informacrm.opportunities') }}</span></a></li>
              <li><a href="#"><i class="fa fa-files-o"></i> <span>{{ trans('informacrm.documents') }}</span></a></li>
              <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/service_ticket') }}"><i class="fa fa-money"></i> <span>{{ trans('informacrm.service_tickets') }}</span></a></li>

          @endcan

          <!-- ================================================ -->
          <!-- ====               LOGOUT                   ==== -->
          <!-- ================================================ -->
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/logout') }}"><i class="fa fa-sign-out"></i> <span>{{ trans('backpack::base.logout') }}</span></a></li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
@endif
