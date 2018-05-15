
<a class="refresh1"  >
    <div class="col-md-12">
        {{-- <a class="btn btn-default btn-sm" id="click1" data-dati="{{ url(config('backpack.base.route_prefix', 'admin') . '/grouping-actions-timeline/'.$grouping['id']) }}" ><i class="fa fa-refresh"></i></a> --}}
        @can ('attach actions in grouping')
            <!-- Attach button -->
            {{-- @includeif('inf.buttons.attach_actions_in_grouping', [
                'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/account/'.$grouping->id.'/action/create'),
                'custom_button_attributes' => " title='".trans('backpack::crud.add')." ".trans('informacrm.action')."' style='margin-top: 5px;'",
                'custom_button_class' => ""
            ]) --}}
            {{-- <button
               type="button"
               class="btn btn-primary ladda-button"
               style="margin-right: 3px;"
               data-toggle="modal"
               data-target="#attach_action"
               data-grouping_id="{{ $grouping->id }}"
               data-dati="{{ url(config('backpack.base.route_prefix', 'admin') . '/grouping/'.$grouping->id.'/action/attach') }}"
               ><i class="fa fa-link"></i>
            </button> --}}
        @endcan

        <a class="btn btn-app btn_tab_action_filter" data-action_status_id="all001" data-grouping_id="{{ $grouping->id }}" data-dati="{{ url(config('backpack.base.route_prefix', 'admin') . '/grouping_tab_actions/'.$grouping->id.'/0') }}" style="margin: 10px;">
            <span class="badge bg-teal" >{{ $actions->count() }}</span>
            <i class="fa fa-globe"></i> {{ trans('general.all') }}
        </a>
        {{-- {{ dd($actions) }} --}}
        @foreach ($actionStatuses as $key => $actionStatuse)
            {{-- {{ dd($key,$actionStatuse['attributes']->id) }} --}}
                  <a class="btn btn-app btn_tab_action_filter" data-action_status_id="{{ $actionStatuse['attributes']->id }}" data-grouping_id="{{ $grouping->id }}" data-dati="{{ url(config('backpack.base.route_prefix', 'admin') . '/grouping_tab_actions/'.$grouping->id.'/'.$actionStatuse['attributes']->id) }}" style="margin: 10px;">
                      <span class="badge bg-teal" style="background-color: {{ $actionStatuse['attributes']->background_color }} !important; color: {{ $actionStatuse['attributes']->color }} !important;">{{ $actionStatuse['count'] }}</span>
                      <i class="fa {{ $actionStatuse['attributes']->icon }}"></i> {{ $key }}
                  </a>
        @endforeach

        <div id="refreshDetails">
            {{-- @include('inf.grouping.actions_timeline_details', ['actions' => $actions]) --}}
        </div>

    </div>
</a>

@include('inf.grouping.modal_select_action')

<script>

    // $('#attach_action').on("show.bs.modal", function (e) {
    //     // var button = $(e.relatedTarget);
    //     // var route = button.data('route');
    //     // var idAction = button.data('id');
    //     //  $("#assigned_toModalLabel").html($(e.relatedTarget).data('title'));
    //     //  $("#fav-title").html($(e.relatedTarget).data('title'));
    //     //  $('.btnAssignAction').attr('actionid', idAction);
    //     //  $('.btnAssignAction').attr('actionUrl', route);
    //     e.preventDefault();
    //     var grouping_id = $(this).attr('data-grouping_id');
    //     // sendAjaxRequest($(this),'/pages/test/');
    //     console.log(grouping_id);
    //     $.ajax({
    //         type: "GET",
    //         url: $(this).attr('data-dati'),
    //         dataType: 'html',
    //         data: {
    //             grouping_id: grouping_id,
    //             access_token: $("#access_token").val()
    //         },
    //         success: function(result) {
    //             $('#refreshModalDetails').html(result);
    //         },
    //         error: function(result) {
    //             alert('error');
    //         }
    //     });
    // });

    $(document).ready(function () {
        $(".btn_tab_action_filter").click(function(e){
            e.preventDefault();
            var action_status_id = $(this).attr('data-action_status_id');
            var grouping_id = $(this).attr('data-grouping_id');
            // sendAjaxRequest($(this),'/pages/test/');
            // console.log(action_status_id);
            $.ajax({
                type: "GET",
                url: $(this).attr('data-dati'),
                dataType: 'html',
                data: {
                    grouping_id: grouping_id,
                    action_status_id: action_status_id, // < note use of 'this' here
                    access_token: $("#access_token").val()
                },
                success: function(result) {
                    $('#refreshDetails').html(result);
                },
                error: function(result) {
                    alert('error');
                }
            });
        });
    });
</script>
