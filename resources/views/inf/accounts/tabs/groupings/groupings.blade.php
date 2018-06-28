<div class="box box-primary" style="border-top-color: {{ config('informa.config.groupings_color') }} !important; border-top-width: 3px;">
    <div class="box-header">
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
                        'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/account/'.$active_account_id['id'].'/grouping/'.$active_grouping_type_id['id'].'/grouping/create'),
                        'custom_button_attributes' => " title='".trans('backpack::crud.add')." ".trans('informacrm.action')."' style='margin-top: 20px;'",
                        'custom_button_class' => ""
                    ])
                @endcan
              </div>
              @foreach ($groupingStatuses as $groupingStatus)
                        <a class="btn btn-app btn_tab_grouping_filter" data-grouping_type_id="{{ $active_grouping_type_id['id'] }}" data-grouping_status_id="{{ $groupingStatus->id }}" data-account_id="{{ $active_account_id['id'] }}" data-dati="{{ url(config('backpack.base.route_prefix', 'admin') . '/account_tab_groupings/'.$active_account_id['id'].'/'.$active_grouping_type_id['id'].'/'.$groupingStatus->id) }}" style="margin: 10px;">
                            <span class="badge bg-teal" style="background-color: {{ $groupingStatus->background_color }} !important; color: {{ $groupingStatus->color }} !important;">{{ $groupingStatus->totalGroupings }}</span>
                            <i class="fa {{ $groupingStatus->icon }}"></i> {{ $groupingStatus->description }}
                        </a>
              @endforeach
            </div><!-- /.container-fluid -->
        </nav>
    </div>
    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: auto;">
        <div class="box-body">
            <div class="row" style="background-color: #ecf0f5;">
                <div class="col-md-12">
                    @include('inf.accounts.tabs.groupings.details', ['groupings' => $groupings])
                </div>
            </div>
        </div>
    </div>
</div>





<script>
    $(document).ready(function () {
        $(".btn_tab_grouping_filter").click(function(e){
            e.preventDefault();
            var grouping_status_id = $(this).attr('data-grouping_status_id');
            var grouping_type_id = $(this).attr('data-grouping_type_id');
            var account_id = $(this).attr('data-account_id');
            // sendAjaxRequest($(this),'/pages/test/');
            // console.log(grouping_status_id);
            $.ajax({
                type: "GET",
                url: $(this).attr('data-dati'),
                dataType: 'html',
                data: {
                    account_id: account_id,
                    grouping_type_id: grouping_type_id,
                    grouping_status_id: grouping_status_id, // < note use of 'this' here
                    access_token: $("#access_token").val()
                },
                success: function(result) {
                    $('#tab_groupings_details').html(result);
                },
                error: function(result) {
                    alert('error');
                }
            });
        });
    });
</script>
