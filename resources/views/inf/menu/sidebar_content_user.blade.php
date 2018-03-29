<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
@can ('show user menu')
    <li class="header">{{ trans('backpack::base.user') }}</li>
      <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/calendar') }}"><i class="fa fa-calendar"></i> <span>{{ trans('informacrm.calendar') }}</span></a></li>
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/account') }}"><i class="fa fa-address-book-o"></i> <span>{{ trans('informacrm.accounts') }}</span></a></li>
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/action') }}"><i class="fa fa-list-ul"></i> <span>{{ trans('general.actions') }}</span></a></li>
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/opportunity') }}"><i class="fa fa-money"></i> <span>{{ trans('informacrm.opportunities') }}</span></a></li>
    <li><a href="#"><i class="fa fa-files-o"></i> <span>{{ trans('informacrm.documents') }}</span></a></li>
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/service_ticket') }}"><i class="fa fa-wrench"></i> <span>{{ trans('informacrm.service_tickets') }}</span></a></li>
@endcan
