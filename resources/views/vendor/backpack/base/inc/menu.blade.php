{{-- <nav class="navbar navbar-static-top"> --}}

<div class="navbar-custom-menu">
    <ul class="nav navbar-nav">

      <!-- ========================================================= -->
      <!-- ========== Top menu right items (ordered left) ========== -->
      <!-- ========================================================= -->

      <!-- <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> <span>Home</span></a></li> -->
        @if (Auth::guest())
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/login') }}">{{ trans('backpack::base.login') }}</a></li>
            @if (config('backpack.base.registration_open'))
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/register') }}">{{ trans('backpack::base.register') }}</a></li>
            @endif
        @else

            {{-- <li><a href="{{ url('admin/menu-item') }}"><i class="fa fa-list"></i> <span>Menu</span></a></li> --}}
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    {{-- <li> --}}
                        {{-- <div class="twitter-typeahead" style="position: relative; display: inline-block;">
                            @include('backpack::inc.search')
                        </div> --}}

                    {{-- </li> --}}
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/logout') }}"><i class="fa fa-btn fa-sign-out"></i> {{ trans('backpack::base.logout') }}</a></li>
                </ul>
            </div>


        @endif

       <!-- ========== End of top menu right items ========== -->
    </ul>
</div>

{{-- </nav> --}}
