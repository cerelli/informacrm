<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->

<li class="header">{{ trans('backpack::base.user') }}</li>
  {{-- <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li> --}}
<li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/calendar') }}"><i class="fa fa-calendar"></i> <span>{{ trans('informacrm.calendar') }}</span></a></li>
<li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/account') }}"><i class="fa fa-address-book-o"></i> <span>{{ trans('informacrm.accounts') }}</span></a></li>
<li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/action') }}"><i class="fa fa-list-ul"></i> <span>{{ trans('general.actions') }}</span></a></li>
{{-- <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/opportunity') }}"><i class="fa fa-money"></i> <span>{{ trans('informacrm.opportunities') }}</span></a></li> --}}
<li><a href="#"><i class="fa fa-files-o"></i> <span>{{ trans('informacrm.documents') }}</span></a></li>
{{-- <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/service_ticket') }}"><i class="fa fa-wrench"></i> <span>{{ trans('informacrm.service_tickets') }}</span></a></li> --}}

{{-- <li class="treeview"> --}}
<li class="header">{{ trans('general.groupings') }}</li>
    {{-- <a href="#"><i class="fa fa-object-group"></i> <span>{{ trans('general.groupings') }}</span> <i class="fa fa-angle-left     pull-right"></i></a> --}}
    {{-- <ul class="treeview-menu"> --}}
        {{-- {{ grouping_typeCrudController::menus() }} --}}
        {{-- @php
            $test = App\Models\Grouping_type::menu();

        @endphp
        {!! $test !!} --}}
        {!! App\Models\Groupings\Grouping_type::menu() !!}
        {{-- @foreach ($menuItems as $key => $menuItem)
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/grouping_link/'.$menuItem->id) }}"><i class="fa {{ $menuItem->icon }}"></i> <span>{{ $menuItem->name }}</span></a></li>
        @endforeach --}}
    {{-- </ul> --}}
</li>
