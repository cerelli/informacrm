<!-- Create button -->
@includeif('vendor.backpack.crud.buttons.create', [
    'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/event/create?active_account_id='.$entry->id),
    'custom_button_attributes' => " title='".trans('backpack::crud.add')." ".trans('informacrm.events')."' ",
    'custom_button_class' => ""
])
<hr>
@foreach ($events->chunk(2) as $chunk)
    <div class="row">
        @foreach ($chunk as $event)
            <div class="col-md-6" id="events-panel-{{ $event->id }}">
                <div class="panel panel-primary panel-heading col-md-12" style="padding-left: 0px; padding-right: 0px; padding-bottom: 0px;">
                    <div class="row col-md-12" style="margin-left: 0px;margin-right: 0px;padding-left: 0px;padding-right: 0px;">
                        <div class="row col-md-12" style="margin-left: 0px;margin-right: 0px;padding-right: 0px;padding-left: 0px;">
                            <div class="panel-title col-md-12">
                                <h3 class="profile-username col-md-9">
                                    {{ $event->title }}
                                </h3>
                                <div class="col-md-3 button-tools" style="padding: 8px;">
                                    <!-- Delete button -->
                                    @includeif('vendor.backpack.crud.buttons.delete', [
                                        'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/events').'/'.$event->id,
                                        'custom_button_attributes' => "  title='Delete events' delete-id='$event->id' ",
                                        'custom_button_class' => " pull-right  del-confirmevents"
                                    ])

                                    <!-- Edit button -->
                                    @includeif('vendor.backpack.crud.buttons.update', [
                                        'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/event').'/'.$event->id.'/edit?call_url=account/'.$event->inf_account_id.'&call=account',
                                        'custom_button_attributes' => " title='Edit event' style='margin-right: 3px;' ",
                                        'custom_button_class' => " pull-right "
                                    ])
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row event-types col-md-7">
                                    <!-- event types -->
                                    @include('vendor.backpack.crud.fields.internal_label_multiple',['field' => $event->event_types])
                                </div>
                                <div class="row event-status col-md-5">
                                    <!-- event types -->
                                    {{-- {{ dump($event->event_status->description) }} --}}
                                    {!! $event->fullresult !!}
                                    <span style="font-size: 80%; margin-right: 3px; color: {{ $event->event_status->color }}; background-color: {{ $event->event_status->background_color }}" class="label label-default pull-right">
                                        <i class= "fa  {{ $event->event_status->icon }}"></i> {{ $event->event_status->description }}
                                    </span>

                                    {{-- {{ dd($event->event_status) }} --}}
                                    {{-- @include('vendor.backpack.crud.fields.internal_label_multiple',['field' => $event['event_status']]) --}}
                                </div>
                            </div>
                        </div>
                        <div class="note col-md-12" style="margin-top: 5px; padding-bottom: 15px;">
                            @if ( $event->result_description == "" )

                            @else
                                <div class="well" style="padding: 1px 1px 1px 10px; margin-bottom: 0px;">
                                    <p>{!! $event->result_description !!}</p>
                                </div>
                            @endif
                            {{-- <hr style="margin-bottom: 2px;margin-top: 2px; border-color: #0016f5;"> --}}
                        </div>
                    </div>
                </div>          <!-- /.panel panel-primary contact-->
            </div> <!-- /#contact-panel.... -->
        @endforeach
    </div>
@endforeach
