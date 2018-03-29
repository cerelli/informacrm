
  <form method="post">
    <h3 class="control-sidebar-heading">{{ trans('informacrm.config') }}</h3>

    <!-- ====================== ACCOUNTS ================= -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="treeview">
            <a href="#"><i class="fa fa-gears"></i> <span>{{ trans('informacrm.account') }}</span> <i class="fa fa-angle-left     pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/title') }}"><i class="fa fa-cog"></i> <span>{{ trans('informacrm.title') }}</span></a></li>
                <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/account_type') }}"><i class="fa fa-cog"></i> <span>{{ trans('informacrm.account_type') }}</span></a></li>
                <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/contact_type') }}"><i class="fa fa-cog"></i> <span>{{ trans('informacrm.contact_type') }}</span></a></li>
                <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/office') }}"><i class="fa fa-cog"></i> <span>{{ trans('informacrm.office') }}</span></a></li>
                <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/contact_detail_type') }}"><i class="fa fa-cog"></i> <span>{{ trans('informacrm.contact_detail_type') }}</span></a></li>
                <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/communication_type') }}"><i class="fa fa-cog"></i> <span>{{ trans('informacrm.communication_type') }}</span></a></li>
                <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/web_site_type') }}"><i class="fa fa-cog"></i> <span>{{ trans('informacrm.web_site_type') }}</span></a></li>
                <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/address_type') }}"><i class="fa fa-cog"></i> <span>{{ trans('informacrm.address_type') }}</span></a></li>
            </ul>
        </li>
    </ul>

    <!-- ====================== EVENTS ================= -->
    {{-- <ul class="sidebar-menu" data-widget="tree">
        <li class="treeview">
            <a href="#"><i class="fa fa-gears"></i> <span>{{ trans('informacrm.event') }}</span> <i class="fa fa-angle-left     pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/event_status') }}"><i class="fa fa-cog"></i> <span>{{ trans('informacrm.event_status') }}</span></a></li>
                <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/event_result') }}"><i class="fa fa-cog"></i> <span>{{ trans('informacrm.event_result') }}</span></a></li>
                <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/event_type') }}"><i class="fa fa-cog"></i> <span>{{ trans('informacrm.event_type') }}</span></a></li>
            </ul>
        </li>
    </ul> --}}

    <!-- ====================== ACTIONS ================= -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="treeview">
            <a href="#"><i class="fa fa-gears"></i> <span>{{ trans('informacrm.action') }}</span> <i class="fa fa-angle-left     pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/action_type') }}"><i class="fa fa-cog"></i> <span>{{ trans('informacrm.action_type') }}</span></a></li>
                <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/action_status') }}"><i class="fa fa-cog"></i> <span>{{ trans('informacrm.action_status') }}</span></a></li>
                <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/action_result') }}"><i class="fa fa-cog"></i> <span>{{ trans('informacrm.action_result') }}</span></a></li>
            </ul>
        </li>
    </ul>

    <!-- ====================== OPPORTUNITIES ================= -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="treeview">
            <a href="#"><i class="fa fa-gears"></i> <span>{{ trans('informacrm.opportunity') }}</span> <i class="fa fa-angle-left     pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/opportunity_status') }}"><i class="fa fa-cog"></i> <span>{{ trans('informacrm.opportunity_status') }}</span></a></li>
                <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/opportunity_result') }}"><i class="fa fa-cog"></i> <span>{{ trans('informacrm.opportunity_result') }}</span></a></li>
                <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/opportunity_type') }}"><i class="fa fa-cog"></i> <span>{{ trans('informacrm.opportunity_type') }}</span></a></li>
            </ul>
        </li>
    </ul>

    <!-- ====================== SERVICE TICKETS ================= -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="treeview">
            <a href="#"><i class="fa fa-gears"></i> <span>{{ trans('informacrm.service_ticket') }}</span> <i class="fa fa-angle-left     pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/service_ticket_status') }}"><i class="fa fa-cog"></i> <span>{{ trans('informacrm.service_ticket_status') }}</span></a></li>
                <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/service_ticket_result') }}"><i class="fa fa-cog"></i> <span>{{ trans('informacrm.service_ticket_result') }}</span></a></li>
                <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/service_ticket_type') }}"><i class="fa fa-cog"></i> <span>{{ trans('informacrm.service_ticket_type') }}</span></a></li>
            </ul>
        </li>
    </ul>

    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/setting') }}"><i class="fa fa-cog"></i> <span>{{ trans('informacrm.settings') }}</span></a></li>

    {{-- <div class="form-group">
      <label class="control-sidebar-subheading">
        Report panel usage
        <input type="checkbox" class="pull-right" checked>
      </label>

      <p>
        Some information about this general settings option
      </p>
    </div>
    <!-- /.form-group -->

    <div class="form-group">
      <label class="control-sidebar-subheading">
        Allow mail redirect
        <input type="checkbox" class="pull-right" checked>
      </label>

      <p>
        Other sets of options are available
      </p>
    </div>
    <!-- /.form-group -->

    <div class="form-group">
      <label class="control-sidebar-subheading">
        Expose author name in posts
        <input type="checkbox" class="pull-right" checked>
      </label>

      <p>
        Allow the user to show his name in blog posts
      </p>
    </div>
    <!-- /.form-group -->

    <h3 class="control-sidebar-heading">Chat Settings</h3>

    <div class="form-group">
      <label class="control-sidebar-subheading">
        Show me as online
        <input type="checkbox" class="pull-right" checked>
      </label>
    </div>
    <!-- /.form-group -->

    <div class="form-group">
      <label class="control-sidebar-subheading">
        Turn off notifications
        <input type="checkbox" class="pull-right">
      </label>
    </div>
    <!-- /.form-group -->

    <div class="form-group">
      <label class="control-sidebar-subheading">
        Delete chat history
        <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
      </label>
    </div> --}}
    <!-- /.form-group -->
  </form>
