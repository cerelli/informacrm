<aside class="control-sidebar control-sidebar-dark" >
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li class="active"><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->

      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <section class="sidebar">
      <div class="tab-pane active" id="control-sidebar-settings-tab">
          <!-- ================== Config menu =================== -->

              {{-- <ul class="nav navbar-nav"> --}}
                  {{-- <li class="dropdown tasks-menu"> --}}
                      {{-- <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> --}}
                {{-- <i class="fa fa-gears"></i> --}}
                {{-- <span class="label label-danger">9</span> --}}
              {{-- </a> --}}
                      {{-- <ul class="dropdown-menu"> --}}
                                      <!-- inner menu: contains the actual data -->
                                      <ul class="sidebar-menu">
                                          @can ('show config menu')
                                              <li class="header">{{ trans('informacrm.config') }}</li>
                                              <!-- ====================== ACCOUNTS ================= -->
                                              <ul class="sidebar-menu">
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
                                              <ul class="sidebar-menu">
                                                  <li class="treeview">
                                                      <a href="#"><i class="fa fa-gears"></i> <span>{{ trans('informacrm.event') }}</span> <i class="fa fa-angle-left     pull-right"></i></a>
                                                      <ul class="treeview-menu">
                                                          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/event_status') }}"><i class="fa fa-cog"></i> <span>{{ trans('informacrm.event_status') }}</span></a></li>
                                                          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/event_result') }}"><i class="fa fa-cog"></i> <span>{{ trans('informacrm.event_result') }}</span></a></li>
                                                          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/event_type') }}"><i class="fa fa-cog"></i> <span>{{ trans('informacrm.event_type') }}</span></a></li>
                                                      </ul>
                                                  </li>
                                              </ul>


                                              <!-- ====================== OPPORTUNITIES ================= -->
                                              <ul class="sidebar-menu">
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
                                              <ul class="sidebar-menu">
                                                  <li class="treeview">
                                                      <a href="#"><i class="fa fa-gears"></i> <span>{{ trans('informacrm.service_ticket') }}</span> <i class="fa fa-angle-left     pull-right"></i></a>
                                                      <ul class="treeview-menu">
                                                          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/service_ticket_status') }}"><i class="fa fa-cog"></i> <span>{{ trans('informacrm.opportunity_status') }}</span></a></li>
                                                          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/service_ticket_result') }}"><i class="fa fa-cog"></i> <span>{{ trans('informacrm.opportunity_result') }}</span></a></li>
                                                          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/service_ticket_type') }}"><i class="fa fa-cog"></i> <span>{{ trans('informacrm.opportunity_type') }}</span></a></li>
                                                      </ul>
                                                  </li>
                                              </ul>

                                            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/setting') }}"><i class="fa fa-cog"></i> <span>{{ trans('informacrm.settings') }}</span></a></li>

                                          @endcan
                                          <!-- Control Sidebar Toggle Button -->

                                      </ul>
                                    </li>


                                    {{-- <li class="footer"> --}}
                                      {{-- <a href="#">View all tasks</a> --}}
                                    {{-- </li> --}}
                                  {{-- </ul> --}}
                  {{-- </li> --}}
                  {{-- <li> --}}
                    {{-- <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a> --}}
                  {{-- </li> --}}
              {{-- </ul> --}}
          {{-- </div> --}}
          <!-- ================== End of config menu =========== -->

        {{-- <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
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
          </div>
          <!-- /.form-group -->
        </form> --}}
      </div>
      </section>
      <!-- /.tab-pane -->
    </div>








  </aside>

  <!-- Add the sidebar's background. This div must be placed
      immediately after the control sidebar -->
 <div class="control-sidebar-bg"></div>
