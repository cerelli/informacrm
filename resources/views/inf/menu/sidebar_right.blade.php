<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      {{-- <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li> --}}
      <li class="active"><a href="#control-sidebar-configs-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      {{-- <div class="tab-pane  active" id="control-sidebar-home-tab">
          @include('inf.menu.sidebar_right_home')
      </div> --}}
      <!-- /.tab-pane -->

      <!-- Settings tab content -->
      @can ('show config menu')
          <div class="tab-pane active" id="control-sidebar-configs-tab">
              @include('inf.menu.sidebar_right_configs')
          </div>
      @endcan
      <!-- /.tab-pane -->
    </div>
  </aside>
  <div class="control-sidebar-bg"></div>
