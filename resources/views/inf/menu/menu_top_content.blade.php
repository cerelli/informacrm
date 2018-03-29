<!-- SLAM start-->
<ul class="add-new nav navbar-nav pull-left">
    <li class="dropdown add-new-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-plus"></i>
        </a>
      <div class="dropdown-menu">
          <ul class = "list-inline" style="margin-left: 5px;">
              <ul class="list-unstyled">
                  <li class="header"><i class="fa fa-address-book-o"></i> &nbsp;<span style="font-weight: 600;">{{ trans('general.account') }}</span></li>
                  <li>
                      <ul class="menu">
                          @can('create-account')
                              <li><a href="{{ '/admin/account/create' }}">{{ trans('general.account') }}</a></li>
                          @endcan
                      </ul>
              </ul>
          </ul>
      </div>
    </li>
    <li>
        <div class="twitter-typeahead" style="position: relative; display: inline-block;">
            @include('backpack::inc.search')
        </div>
    </li>
</ul>
{{-- SLAM end--}}
