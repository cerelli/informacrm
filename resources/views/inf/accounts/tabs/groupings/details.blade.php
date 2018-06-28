<ul class="timeline" id="tab_groupings_details">
    <li class="time-label">
        @if (isset($groupings[0]))
            <span class="bg" style="background-color: {{ $groupings[0]->grouping_status->background_color }} !important; color: {{ $groupings[0]->grouping_status->color }} !important;">
                {{ $groupings[0]->grouping_status->description }}
            </span>
        @else

        @endif

    </li>
    <!-- /.timeline-label -->

    @foreach ($groupings as $grouping)
        <!-- timeline item -->
        <li class='acton-li-{{ $grouping->id }}'>
            <!-- timeline icon -->
            <i class="fa {{ $grouping->grouping_status->icon }} bg" style="background-color: {{ $grouping->grouping_status->background_color }} !important; color: {{ $grouping->grouping_status->color }} !important;"></i>
            <div class="timeline-item">
                <div class="row col-md-12" style="margin-left: 2px;">
                    <div class="pull-right" id="refresh_acud{{ $grouping->id }}">
                        @include('inf.acud',['acud' => $grouping->acud])
                    </div>
                </div>
                <div class="row col-md-12" style="padding-bottom: 10px; padding-top: 5px;">
                    <div class="event-types col-md-10">
                        <!-- event types -->
                        @include('vendor.backpack.crud.fields.internal_label_multiple',['field' => $grouping->grouping_types])
                    </div>
                    <div class="button-tools  col-md-2">
                        @can ('delete')
                            <!-- Delete button -->
                            @includeif('inf.buttons.delete', [
                                'custom_button_url' => url(config('backpack.base.route_prefix', 'admin').'/account').'/'.$grouping->account_id.'/grouping/'.$grouping->grouping_type_id.'/grouping/'.$grouping->id,
                                'custom_button_attributes' => "  title='Delete grouping' delete-id='$grouping->id' ",
                                'custom_button_class' => " pull-right  del-confirmgrouping"
                            ])
                        @endcan

                        <!-- Edit button -->
                        @can ('update')
                            @includeif('inf.buttons.update', [
                                'custom_button_url' => url(config('backpack.base.route_prefix', 'admin').'/account').'/'.$grouping->account_id.'/grouping/'.$grouping->grouping_type_id.'/grouping/'.$grouping->id.'/edit',
                                'custom_button_attributes' => " id='btn_edit_grouping' title='".trans('backpack::crud.edit')." ".trans('informacrm.grouping')."'  style='margin-right: 3px;' ",
                                'custom_button_class' => " pull-right "
                            ])
                        @endcan

                        <!-- Assigned button -->
                        @can ('assign grouping')
                        <button
                           type="button"
                           title="{{trans('general.assign')}}"
                           class="btn btn-xs btn-info pull-right"
                           style="margin-right: 3px;"
                           data-toggle="modal"
                           data-id="{{ $grouping->id }}"
                           data-testid="{{ $grouping->id }}"
                           data-title="{{ $grouping->title }}"
                           data-target="#assign_toModal"
                           data-route={{ url(config('backpack.base.route_prefix', 'admin').'/grouping/assign').'/'.$grouping->id }}><i class="fa fa-hand-o-right"></i>
                          @if ( Config::get('settings.button_label') == '0') {{ trans('general.assign') }}@endif
                        </button>
                        @endcan
                    </div>
                </div>


                {{-- <span class="time">
                    @php
                        $title = trans('informacrm.grouping_creation') .'<br>'.Carbon\Carbon::parse($grouping->created_at)->format('d-m-Y i');
                        // . \Carbon\Carbon::parse($grouping->created_at)->format('d/m/Y h:i'). 'da' .$grouping->created_by."<br>";
                        // $title .= trans('informacrm.grouping_modification')." ". \Carbon\Carbon::parse($grouping->update_at)->format('d/m/Y h:i')." da ".$grouping->updated_by."<br>";
                        // // dd($title);
                    @endphp
                    <i class="fa fa-clock-o" data-toggle="popover" data-trigger= "hover" title="PIPPO" data-content={{ $grouping->created_at->diffForHumans() }}></i> {{ Carbon\Carbon::parse($grouping->created_at)->format('d-m-Y h:i') }}</span> --}}

                <h3 class="timeline-header"><a href={{ url(config('backpack.base.route_prefix', 'admin').'/account').'/'.$grouping->account_id.'/grouping/'.$grouping->grouping_type_id.'/grouping/'.$grouping->id }}>[{{ $grouping->id }}]&nbsp{{ $grouping->title }}</a> </h3>

                <div class="timeline-body">
                    {!! $grouping->notes !!}
                </div>

                <div class="timeline-footer row">

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
                    groupingid=""
                    groupingUrl = ""
                        class="btn btn-success btnAssignAction"
                         data-button-type="assign" > {{ trans('backpack::crud.apply') }} </a>
                </span> --}}
                <button
                   type="button"
                   class="btn btn-success btnAssignAction"
                   style="margin-right: 3px;"
                   href="javascript:void(0)" onclick="assignAction(this)"
                   groupingid=""
                   groupingUrl = ""> {{ trans('backpack::crud.apply') }}
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
    var route = button.attr('groupingUrl');
    var groupingId = button.attr('groupingid');
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
            // $("#tab_groupings_details > li.acton-li-"+delete_id).remove();
             $('#assign_toModal').modal( 'hide' );
             $('#refresh_acud'+groupingId).html(result);

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
         $('.btnAssignAction').attr('groupingid', idAction);
         $('.btnAssignAction').attr('groupingUrl', route);
    });
});
    $(document).ready(function () {
        $('[data-toggle="popover"]').popover({
            html: true,
            placement: 'auto left'
        });

        $('.del-confirmgrouping').click(function(e){
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
                        $("#tab_groupings_details > li.acton-li-"+delete_id).remove();
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
