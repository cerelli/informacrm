{{-- <a href="#tab_actions" data-dati="{{ url(config('backpack.base.route_prefix', 'admin') . '/account_tab_actions/'.$entry->id) }}" data-tab="tab_actions" aria-controls="tab_actions" role="tab" data-toggle="tab">{{ trans('informacrm.actions') }}</a> --}}
{{-- @include('inf.filter.select2_multiple') --}}
<ul class="timeline" id="tab_actions_details">
    {{-- {{ dump($actions[0]->action_status->background_color) }} --}}
    <!-- timeline time label -->
    <li class="time-label">
        @if (isset($actions[0]))
            <span class="bg" style="background-color: {{ $actions[0]->action_status->background_color }} !important; color: {{ $actions[0]->action_status->color }} !important;">
                {{ $actions[0]->action_status->description }}
            </span>
        @else

        @endif

    </li>
    <!-- /.timeline-label -->

    @foreach ($actions as $action)
        <!-- timeline item -->
        <li class='acton-li-{{ $action->id }}'>
            <!-- timeline icon -->
            <i class="fa {{ $action->action_status->icon }} bg" style="background-color: {{ $action->action_status->background_color }} !important; color: {{ $action->action_status->color }} !important;"></i>
            <div class="timeline-item">
                <div class="row col-md-12" style="padding-bottom: 10px; padding-top: 5px;">
                    <div class="event-types col-md-10">
                        <!-- event types -->
                        @include('vendor.backpack.crud.fields.internal_label_multiple',['field' => $action->action_types])
                    </div>
                    <div class="button-tools  col-md-2">
                        @can ('delete')
                            <!-- Delete button -->
                            @includeif('inf.buttons.delete', [
                                'custom_button_url' => url(config('backpack.base.route_prefix', 'admin').'/account').'/'.$action->account_id.'/action/'.$action->id,
                                'custom_button_attributes' => "  title='Delete action' delete-id='$action->id' ",
                                'custom_button_class' => " pull-right  del-confirmaction"
                            ])
                        @endcan

                        <!-- Edit button -->
                        @can ('update')
                            @includeif('inf.buttons.update', [
                                'custom_button_url' => url(config('backpack.base.route_prefix', 'admin').'/account').'/'.$action->account_id.'/action/'.$action->id.'/edit',
                                'custom_button_attributes' => " id='btn_edit_action' title='".trans('backpack::crud.edit')." ".trans('informacrm.action')."'  style='margin-right: 3px;' ",
                                'custom_button_class' => " pull-right "
                            ])
                        @endcan

                        <!-- Assigned button -->
                        @can ('assign action')
                        <button
                           type="button"
                           title="{{trans('general.assign')}}"
                           class="btn btn-xs btn-info pull-right"
                           style="margin-right: 3px;"
                           data-toggle="modal"
                           data-id="{{ $action->id }}"
                           data-testid="{{ $action->id }}"
                           data-title="{{ $action->title }}"
                           data-target="#assign_toModal"
                           data-route={{ url(config('backpack.base.route_prefix', 'admin').'/action/assign').'/'.$action->id }}><i class="fa fa-hand-o-right"></i>
                          @if ( Config::get('settings.button_label') == '0') {{ trans('general.assign') }}@endif
                        </button>
                        @endcan
                    </div>
                </div>


                {{-- <span class="time">
                    @php
                        $title = trans('informacrm.action_creation') .'<br>'.Carbon\Carbon::parse($action->created_at)->format('d-m-Y i');
                        // . \Carbon\Carbon::parse($action->created_at)->format('d/m/Y h:i'). 'da' .$action->created_by."<br>";
                        // $title .= trans('informacrm.action_modification')." ". \Carbon\Carbon::parse($action->update_at)->format('d/m/Y h:i')." da ".$action->updated_by."<br>";
                        // // dd($title);
                    @endphp
                    <i class="fa fa-clock-o" data-toggle="popover" data-trigger= "hover" title="PIPPO" data-content={{ $action->created_at->diffForHumans() }}></i> {{ Carbon\Carbon::parse($action->created_at)->format('d-m-Y h:i') }}</span> --}}

                <h3 class="timeline-header"><a href={{ url(config('backpack.base.route_prefix', 'admin').'/account').'/'.$action->account_id.'/action/'.$action->id }}>[{{ $action->id }}]&nbsp{{ $action->title }}</a> </h3>

                <div class="timeline-body">
                    {!! $action->notes !!}
                </div>

                <div class="timeline-footer row">
                    <div class="row col-md-12" style="margin-left: 2px;">
                        <div class="pull-left" id="refresh_acud{{ $action->id }}">
                            @include('inf.acud',['acud' => $action->acud])
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <!-- END timeline item -->
    @endforeach

</ul>

<div class="modal fade" id="assign_toModal" tabindex="-1" role="dialog" aria-labelledby="assigned_toModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close"
                data-dismiss="modal"
                aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="assigned_toModalLabel">The Sun Also Rises</h4>
            </div>
            <div class="modal-body">
                <p>{!! trans('general.assign') !!}?</p>
                <select id="asssign" class="form-control" name="assign_to">
                    <?php
                    // $assign = App\User::where('role', '!=', 'user')->where('active', '=', '1')->orderBy('first_name')->get();
                    $assign = App\User::All();
                    $count_assign = count($assign);
                    // $teams = App\Model\helpdesk\Agent\Teams::where('status', '=', '1')->get();
                    // $count_teams = count($teams);
                    ?>
                    {{-- <optgroup label="Agents ( {!! $count_assign !!} )"> --}}
                    <option  value=""></option>
                        @foreach($assign as $user)
                        <option  value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    {{-- </optgroup> --}}
                </select>
            </div>
            <div class="modal-footer">
                {{-- <span class="btn btn-success pull-right ">
                    <a href="javascript:void(0)" onclick="assignAction(this)"
                    actionid=""
                    actionUrl = ""
                        class="btn btn-success btnAssignAction"
                         data-button-type="assign" > {{ trans('backpack::crud.apply') }} </a>
                </span> --}}
                <button
                   type="button"
                   class="btn btn-success btnAssignAction"
                   style="margin-right: 3px;"
                   href="javascript:void(0)" onclick="assignAction(this)"
                   actionid=""
                   actionUrl = ""> {{ trans('backpack::crud.apply') }}
                </button>
                <button type="button"
                   class="btn btn-default"
                   data-dismiss="modal">{{ trans('backpack::crud.close') }}
               </button>
            </div>
        </div>
    </div>
</div>

<script>
function assignAction(button) {
    var button = $(button);
    var route = button.attr('actionUrl');
    var actionId = button.attr('actionid');
    var selected = $("#asssign").val();
    // console.log(selected);

    $.ajax({
        url: route,
        type: 'PATCH',
        data: {
            assigned_to: selected
        },
        success: function(result) {
            // Show an alert with the result
            new PNotify({
                title: "{{ trans('general.assigned_confirmation_title') }}",
                text: "{{ trans('general.assigned_confirmation_message') }}",
                type: "success"
            });
            // return to account list
            // $("#tab_actions_details > li.acton-li-"+delete_id).remove();
             $('#assign_toModal').modal( 'hide' );
             $('#refresh_acud'+actionId).html(result);

        },
        error: function(result) {
            // Show an alert with the result
            new PNotify({
                title: "{{ trans('general.assigned_confirmation_not_title') }}",
                text: "{{ trans('general.assigned_confirmation_not_message') }}",
                type: "warning"
            });
        }
    });
}

$(function() {
    $('#assign_toModal').on("show.bs.modal", function (e) {
        var button = $(e.relatedTarget);
        var route = button.data('route');
        var idAction = button.data('id');
         $("#assigned_toModalLabel").html($(e.relatedTarget).data('title'));
         $("#fav-title").html($(e.relatedTarget).data('title'));
         $('.btnAssignAction').attr('actionid', idAction);
         $('.btnAssignAction').attr('actionUrl', route);
    });
});
    $(document).ready(function () {
        $('[data-toggle="popover"]').popover({
            html: true,
            placement: 'auto left'
        });

        $('.del-confirmaction').click(function(e){
            e.preventDefault();
            var delete_button = $(this);
            var delete_url = $(this).attr('href');
            var delete_id = $(this).attr('delete-id');
            if (confirm("{{ trans('backpack::crud.delete_confirm') }}") == true) {
                $.ajax({
                    url: delete_url,
                    type: 'DELETE',
                    success: function(result) {
                        // Show an alert with the result
                        new PNotify({
                            title: "{{ trans('backpack::crud.delete_confirmation_title') }}",
                            text: "{{ trans('backpack::crud.delete_confirmation_message') }}",
                            type: "success"
                        });
                        // return to account list
                        $("#tab_actions_details > li.acton-li-"+delete_id).remove();
                    },
                    error: function(result) {
                        // Show an alert with the result
                        new PNotify({
                            title: "{{ trans('backpack::crud.delete_confirmation_not_title') }}",
                            text: "{{ trans('backpack::crud.delete_confirmation_not_message') }}",
                            type: "warning"
                        });
                    }
                });
            } else {
                new PNotify({
                    title: "{{ trans('backpack::crud.delete_confirmation_not_deleted_title') }}",
                    text: "{{ trans('backpack::crud.delete_confirmation_not_deleted_message') }}",
                    type: "info"
                });
            }
        });
    });
</script>
