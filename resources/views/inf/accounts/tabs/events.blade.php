<!-- Create button -->
@includeif('vendor.backpack.crud.buttons.create', [
    'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/address/create?active_account_id='.$entry->id),
    'custom_button_attributes' => " title='".trans('backpack::crud.add')." ".trans('informacrm.address')."' ",
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
                            <div class="panel-title col-md-9">
                                <p class="text-muted">
                                    {{-- {{ dd($event->event_types) }}
                                    {{ $event->event_types['description'] }} --}}
                                </p>
                                <h3 class="profile-username">
                                    {{-- {!! $event->FormattedAddress !!} --}}
                                </h3>
                            </div>
                            <div class="col-md-3 button-tools" style="padding: 8px;">
                                <!-- Delete button -->
                                @includeif('vendor.backpack.crud.buttons.delete', [
                                    'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/events').'/'.$event->id,
                                    'custom_button_attributes' => "  title='Delete events' delete-id='$event->id' ",
                                    'custom_button_class' => " pull-right  del-confirmevents"
                                ])

                                <!-- Edit button -->
                                @includeif('vendor.backpack.crud.buttons.update', [
                                    'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/event').'/'.$event->id.'/edit',
                                    'custom_button_attributes' => " title='Edit event' style='margin-right: 3px;' ",
                                    'custom_button_class' => " pull-right "
                                ])
                            </div>
                        </div>
                        <div class="note col-md-12" style="padding-bottom: 15px;">
                            @if ( $event->notes == "" )

                            @else
                                <div class="well" style="padding: 1px 1px 1px 10px; margin-bottom: 0px;">
                                    <p>{!! $event->notes !!}</p>
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
