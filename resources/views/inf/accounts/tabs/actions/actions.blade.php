
<nav class="navbar navbar-default navbar-filters">
    <div id="success">

    </div>
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        {{-- <a class="navbar-brand" href="#">{{ trans('backpack::crud.filters') }}</a> --}}
        @can ('create')
            <!-- Create button -->
            {{-- {{ dd($filter) }} --}}
            @includeif('inf.buttons.create', [
                'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/account/'.$active_account_id['id'].'/action/create'),
                'custom_button_attributes' => " title='".trans('backpack::crud.add')." ".trans('informacrm.action')."' style='margin-top: 20px;'",
                'custom_button_class' => ""
            ])
        @endcan
        {{-- @include('inf.filter.select2_multiple',['filter' => $filter]) --}}
      </div>
      {{-- @include('crud::inc.filters_navbar') --}}
      <!-- Collect the nav links, forms, and other content for toggling -->
      {{-- {{dd($request)}}
      @if ($crud->filtersEnabled()) --}}
        {{-- @include('inf.filter.select2_multiple') --}}
      {{-- @endif --}}
      {{-- @include('inf.filter.select2_multiple', ['filter' => $countActionStatuses]) --}}
      @foreach ($countActionStatuses as $countActionStatus)
          {{-- {{ dd($active_account_id) }} --}}
                <a class="btn btn-app btn_tab_action_filter" data-action_status_id="{{ $countActionStatus->id }}" data-account_id="{{ $active_account_id['id'] }}" data-dati="{{ url(config('backpack.base.route_prefix', 'admin') . '/account_tab_actions/'.$active_account_id['id'].'/'.$countActionStatus->id) }}" style="margin: 10px;">
                    <span class="badge bg-teal" style="background-color: {{ $countActionStatus->background_color }} !important; color: {{ $countActionStatus->color }} !important;">{{ $countActionStatus->actions_count }}</span>
                    <i class="fa {{ $countActionStatus->icon }}"></i> {{ $countActionStatus->description }}

                    {{-- <div class="container-fluid">
                        @foreach ($countActionTypes as $countActionType)
                            <small class="label" style="background-color: {{ $countActionType->background_color }} !important; color: {{ $countActionType->color }} !important;">{{ $countActionType->actions_count }}</small>
                        @endforeach
                    </div> --}}

                </a>
      @endforeach
    </div><!-- /.container-fluid -->
</nav>

{{-- //include details tab_actions --}}
{{-- @include('inf.accounts.tabs.actions.details', ['opportunities' => $entry->events]) --}}
<div class="row" style="background-color: #ecf0f5;">
    <div class="col-md-12">
        @include('inf.accounts.tabs.actions.details', ['actions' => $actions])
    </div>
</div>


<script>
    $(document).ready(function () {
        $(".btn_tab_action_filter").click(function(e){
            e.preventDefault();
            var action_status_id = $(this).attr('data-action_status_id');
            var account_id = $(this).attr('data-account_id');
            // sendAjaxRequest($(this),'/pages/test/');
            // console.log(action_status_id);
            $.ajax({
                type: "GET",
                url: $(this).attr('data-dati'),
                dataType: 'html',
                data: {
                    account_id: account_id,
                    action_status_id: action_status_id, // < note use of 'this' here
                    access_token: $("#access_token").val()
                },
                success: function(result) {
                    $('#tab_actions_details').html(result);
                },
                error: function(result) {
                    alert('error');
                }
            });
        });
    });
</script>
