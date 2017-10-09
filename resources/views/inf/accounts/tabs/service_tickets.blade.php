<!-- Create button -->
@includeif('vendor.backpack.crud.buttons.create', [
    'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/event/create?active_account_id='.$entry->id),
    'custom_button_attributes' => " title='".trans('backpack::crud.add')." ".trans('informacrm.events')."' ",
    'custom_button_class' => ""
])
<hr>
@foreach ($opportunities->chunk(2) as $chunk)
    <div class="row">
        @foreach ($chunk as $opportunity)
            <div class="col-md-6" id="opportunities-panel-{{ $opportunity->id }}">
                <div class="panel panel-primary panel-heading col-md-12" style="padding-left: 0px; padding-right: 0px; padding-bottom: 0px;">
                    <div class="row col-md-12" style="margin-left: 0px;margin-right: 0px;padding-left: 0px;padding-right: 0px;">
                        <div class="row col-md-12" style="margin-left: 0px;margin-right: 0px;padding-right: 0px;padding-left: 0px;">
                            <div class="panel-title col-md-12">
                                <h3 class="profile-username col-md-9">
                                    Creata il 10/10/2017 <br>
                                    Incaricato: Andrea Mapelli
                                    {{-- {{ $opportunity->title }} --}}
                                </h3>
                                <div class="col-md-3 button-tools" style="padding: 8px;">
                                    <!-- Delete button -->
                                    @includeif('vendor.backpack.crud.buttons.delete', [
                                        'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/events').'/'.$opportunity->id,
                                        'custom_button_attributes' => "  title='Delete events' delete-id='$opportunity->id' ",
                                        'custom_button_class' => " pull-right  del-confirmevents"
                                    ])

                                    <!-- Edit button -->
                                    @includeif('vendor.backpack.crud.buttons.update', [
                                        'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/event').'/'.$opportunity->id.'/edit?call_url=account/'.$opportunity->inf_account_id.'&call=account',
                                        'custom_button_attributes' => " title='Edit event' style='margin-right: 3px;' ",
                                        'custom_button_class' => " pull-right "
                                    ])
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row event-types col-md-7">
                                    <!-- event types -->
                                    @include('vendor.backpack.crud.fields.internal_label_multiple',['field' => $opportunity->event_types])
                                </div>
                                <div class="row event-status col-md-5">
                                    <!-- event types -->
                                    {{-- {{ dump($event->event_status->description) }} --}}
                                    {!! $opportunity->fullresult !!}
                                    <span style="font-size: 80%; margin-right: 3px; color: {{ $opportunity->event_status->color }}; background-color: {{ $opportunity->event_status->background_color }}" class="label label-default pull-right">
                                        <i class= "fa  {{ $opportunity->event_status->icon }}"></i> {{ $opportunity->event_status->description }}
                                    </span>

                                    {{-- {{ dd($event->event_status) }} --}}
                                    {{-- @include('vendor.backpack.crud.fields.internal_label_multiple',['field' => $event['event_status']]) --}}
                                </div>
                            </div>
                        </div>
                        <div class="note col-md-12" style="margin-top: 5px; padding-bottom: 15px;">
                            @if ( $opportunity->result_description == "" )

                            @else
                                <div class="well" style="padding: 1px 1px 1px 10px; margin-bottom: 0px;">
                                    <p>{!! $opportunity->result_description !!}</p>
                                </div>
                            @endif
                            {{-- <hr style="margin-bottom: 2px;margin-top: 2px; border-color: #0016f5;"> --}}
                        </div>
                        Contatti: Marco Mapelli <br>
                        Eventi....<br>
                        Documenti....
                    </div>
                </div>          <!-- /.panel panel-primary contact-->
            </div> <!-- /#contact-panel.... -->
        @endforeach
    </div>
@endforeach
