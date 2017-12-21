<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Encrypted CSRF token for Laravel, in order for Ajax requests to work --}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>
      {{ isset($title) ? $title.' :: '.config('backpack.base.project_name').' Admin' : config('backpack.base.project_name').' Admin' }}
    </title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('') }}/favicon.ico" />
    @yield('before_styles')

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/dist/css/skins/_all-skins.min.css">

    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/plugins/pace/pace.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/backpack/pnotify/pnotify.custom.min.css') }}">

    <!-- BackPack Base CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/backpack/backpack.base.css') }}?v=2">
    <link rel="stylesheet" href="{{ asset('vendor/backpack/overlays/backpack.bold.css') }}">

    @yield('after_styles')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition {{ config('backpack.base.skin') }} sidebar-mini">
	<script type="text/javascript">
		/* Recover sidebar state */
		(function () {
			if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
				var body = document.getElementsByTagName('body')[0];
				body.className = body.className + ' sidebar-collapse';
			}
		})();
	</script>
    <!-- Site wrapper -->
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="{{ url('') }}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">{!! config('backpack.base.logo_mini') !!}</span>
          {{-- <span class="logo-mini">{!! Config::get('settings.logo-mini') !!}</span> --}}
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">{!! config('backpack.base.logo_lg') !!}</span>
          {{-- <span class="logo-mini">{!! Config::get('settings.logo_lg') !!}</span> --}}
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">{{ trans('backpack::base.toggle_navigation') }}</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          {{-- <ul class="add-new nav navbar-nav pull-left">
                      <!-- Notifications: style can be found in dropdown.less -->
                      <li class="dropdown add-new-menu">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                              <i class="fa fa-plus"></i>
                          </a>
                          <div class="dropdown-menu">
                              <ul class="list-inline"> --}}
                                  {{-- <li>
                                      <ul class="list-unstyled">
                                          <li class="header"><i class="fa fa-money"></i> &nbsp;<span style="font-weight: 600;">{{ trans_choice('general.incomes', 1) }}</span></li>
                                          <li>
                                              <ul class="menu">
                                                  @permission('create-incomes-invoices')
                                                  <li><a href="{{ url('incomes/invoices/create') }}">{{ trans_choice('general.invoices', 1) }}</a></li>
                                                  @endpermission
                                                  @permission('create-incomes-revenues')
                                                  <li><a href="{{ url('incomes/revenues/create') }}">{{ trans_choice('general.revenues', 1) }}</a></li>
                                                  @endpermission
                                                  @permission('create-incomes-customers')
                                                  <li><a href="{{ url('incomes/customers/create') }}">{{ trans_choice('general.customers', 1) }}</a></li>
                                                  @endpermission
                                              </ul>
                                          </li>
                                      </ul>
                                  </li>
                                  <li>
                                      <ul class="list-unstyled">
                                          <li class="header"><i class="fa fa-shopping-cart"></i> &nbsp;<span style="font-weight: 600;">{{ trans_choice('general.expenses', 1) }}</span></li>
                                          <li>
                                              <ul class="menu">
                                                  @permission('create-expenses-bills')
                                                  <li><a href="{{ url('expenses/bills/create') }}">{{ trans_choice('general.bills', 1) }}</a></li>
                                                  @endpermission
                                                  @permission('create-expenses-payments')
                                                  <li><a href="{{ url('expenses/payments/create') }}">{{ trans_choice('general.payments', 1) }}</a></li>
                                                  @endpermission
                                                  @permission('create-expenses-vendors')
                                                  <li><a href="{{ url('expenses/vendors/create') }}">{{ trans_choice('general.vendors', 1) }}</a></li>
                                                  @endpermission
                                              </ul>
                                          </li>
                                      </ul>
                                  </li>
                                  <li>
                                      <ul class="list-unstyled">
                                          <li class="header"><i class="fa fa-university"></i> &nbsp;<span style="font-weight: 600;">{{ trans('general.banking') }}</span></li>
                                          <li>
                                              <ul class="menu">
                                                  @permission('create-banking-accounts')
                                                  <li><a href="{{ url('banking/accounts/create') }}">{{ trans_choice('general.accounts', 1) }}</a></li>
                                                  @endpermission
                                                  @permission('create-banking-transfers')
                                                  <li><a href="{{ url('banking/transfers/create') }}">{{ trans_choice('general.transfers', 1) }}</a></li>
                                                  @endpermission
                                              </ul>
                                          </li>
                                      </ul>
                                  </li> --}}
                              {{-- </ul>
                          </div>
                      </li>
                  </ul> --}}

          @include('backpack::inc.menu')
        </nav>
      </header>

      <!-- =============================================== -->


      @include('backpack::inc.sidebar')
      @include('backpack::inc.config_menu')

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
         @yield('header')

        <!-- Main content -->
        <section class="content">

          @yield('content')

        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <footer class="main-footer">
        @if (config('backpack.base.show_powered_by'))
            <div class="pull-right hidden-xs">
              {{ trans('backpack::base.powered_by') }} <a target="_blank" href="http://backpackforlaravel.com?ref=panel_footer_link">Backpack for Laravel</a>
            </div>
        @endif
        {{ trans('backpack::base.handcrafted_by') }} <a target="_blank" href="{{ config('backpack.base.developer_link') }}">{{ config('backpack.base.developer_name') }}</a>.
      </footer>
    </div>
    <!-- ./wrapper -->


    @yield('before_scripts')

    <!-- jQuery 2.2.0 -->
    <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script>window.jQuery || document.write('<script src="{{ asset('vendor/adminlte') }}/plugins/jQuery/jQuery-2.2.3.min.js"><\/script>')</script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{ asset('vendor/adminlte') }}/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ asset('vendor/adminlte') }}/plugins/pace/pace.min.js"></script>
    <script src="{{ asset('vendor/adminlte') }}/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="{{ asset('vendor/adminlte') }}/plugins/fastclick/fastclick.js"></script>
    <script src="{{ asset('vendor/adminlte') }}/dist/js/app.min.js"></script>

    <!-- page script -->
    <script type="text/javascript">
        /* Store sidebar state */
        $('.sidebar-toggle').click(function(event) {
          event.preventDefault();
          if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
            sessionStorage.setItem('sidebar-toggle-collapsed', '');
          } else {
            sessionStorage.setItem('sidebar-toggle-collapsed', '1');
          }
        });
        // To make Pace works on Ajax calls
        $(document).ajaxStart(function() { Pace.restart(); });

        // Ajax calls should always have the CSRF token attached to them, otherwise they won't work
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        // Set active state on menu element
        var current_url = "{{ Request::fullUrl() }}";
        var full_url = current_url+location.search;
        var $navLinks = $("ul.sidebar-menu li a");
        // First look for an exact match including the search string
        var $curentPageLink = $navLinks.filter(
            function() { return $(this).attr('href') === full_url; }
        );
        // If not found, look for the link that starts with the url
        if(!$curentPageLink.length > 0){
            $curentPageLink = $navLinks.filter(
                function() { return $(this).attr('href').startsWith(current_url) || current_url.startsWith($(this).attr('href')); }
            );
        }

        $curentPageLink.parents('li').addClass('active');
        {{-- Enable deep link to tab --}}
        var activeTab = $('[href="' + location.hash.replace("#", "#tab_") + '"]');
        location.hash && activeTab && activeTab.tab('show');
        $('.nav-tabs a').on('shown.bs.tab', function (e) {
            location.hash = e.target.hash.replace("#tab_", "#");
        });
    </script>

    @include('backpack::inc.alerts')

    @yield('after_scripts')

    <!-- JavaScripts -->
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
