<div class="btn-group" style="margin-bottom: 5px; margin-left: 5px;">
    <button type="button" class="btn dropdown-toggle btn-primary ladda-button btn-xs" data-toggle="dropdown">
        <span class="ladda-label">
            <i class="fa fa-plus"></i>
        </span>
    </button>
    <ul class="dropdown-menu">
        <li>
            @include('inf.accounts.dropdown.search')
            <div class="row" style="width: 400px; margin-left: 5px;">
                <ul class="list-unstyled col-md-4">
                    <li class="header">
                        <i class="fa fa-calendar"></i> &nbsp;
                        <span style="font-weight: 600;">{{ trans_choice('informacrm.event', 1) }}</span>
                    </li>
                    @php
                        $complete_url = url(config('backpack.base.route_prefix', 'admin')).'/event/create?active_account_id='.$opportunity->account_id.'&active_opportunity_id='.$opportunity->id.'&annulle=account/'.$opportunity->account_id.'&tab=opportunities';
                    @endphp
                    <li><a href={{ $complete_url }}>{{ trans('informacrm.new') }}</a></li>
                </ul>
                <ul class="list-unstyled col-md-4">
                    <li class="header">
                        <i class="fa fa-files-o"></i> &nbsp;
                        <span style="font-weight: 600;">{{ trans_choice('informacrm.document', 1) }}</span>
                    </li>
                    <li><a href="#">{{ trans('informacrm.new') }}</a></li>
                </ul>
                <ul class="list-unstyled col-md-4">
                    <li class="header">
                        <i class="fa fa-money"></i> &nbsp;
                        <span style="font-weight: 600;">{{ trans_choice('informacrm.service_ticket', 1) }}</span>
                    </li>
                    <li><a href="#">{{ trans('informacrm.new') }}</a></li>
                </ul>
            </div>
        </li>
    </ul>
</div>
