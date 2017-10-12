<!-- Create button -->
@includeif('vendor.backpack.crud.buttons.create', [
    'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/opportunity/create?active_account_id='.$entry->id),
    'custom_button_attributes' => " title='".trans('backpack::crud.add')." ".trans('informacrm.opportunities')."' ",
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
                                @php
                                    $title = trans('informacrm.opportunity_creation')." ". \Carbon\Carbon::parse($opportunity->created_at)->format('d/m/Y');
                                    if ( isset($opportunity->expiration_date) ) {
                                        $title .= " - ".trans('informacrm.opportunity_expiration_date')." ".\Carbon\Carbon::parse($opportunity->expiration_date)->format('d/m/Y');
                                    } else {

                                    }
                                    $title .=  "<br>".trans('informacrm.opportunity_value').": ". number_format($opportunity->value, 2, ',', '.')." €.";
                                @endphp
                                <h3 class="profile-username col-md-9">
                                    {!! $title !!}
                                    {{-- Creata il {{ \Carbon\Carbon::parse($opportunity->created_at)->format('d/m/Y')}} -
                                    <br>Valore: {{ number_format($opportunity->value, 2, ',', '.') }} €. --}}
                                    {{-- {{ $opportunity->title }} --}}
                                </h3>
                                <div class="col-md-3 button-tools" style="padding: 8px;">
                                    <!-- Delete button -->
                                    @includeif('vendor.backpack.crud.buttons.delete', [
                                        'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/opportunity').'/'.$opportunity->id,
                                        'custom_button_attributes' => "  title='Delete opportunity' delete-id='$opportunity->id' ",
                                        'custom_button_class' => " pull-right  del-confirmopportunities"
                                    ])

                                    <!-- Edit button -->
                                    @includeif('vendor.backpack.crud.buttons.update', [
                                        'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/opportunity').'/'.$opportunity->id.'/edit?call_url=account/'.$opportunity->inf_account_id.'&call=account',
                                        'custom_button_attributes' => " title='Edit opportunity' style='margin-right: 3px;' ",
                                        'custom_button_class' => " pull-right "
                                    ])
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row opportunity-types col-md-7">
                                    <!-- opportunity types -->
                                    @include('vendor.backpack.crud.fields.internal_label_multiple',['field' => $opportunity->opportunity_types])
                                </div>
                                <div class="row opportunity-status col-md-5">
                                    <!-- opportunity types -->
                                    {{-- {{ dump($event->event_status->description) }} --}}
                                    {!! $opportunity->fullresult !!}
                                    <span style="font-size: 80%; margin-right: 3px; color: {{ $opportunity->opportunity_status->color }}; background-color: {{ $opportunity->opportunity_status->background_color }}" class="label label-default pull-right">
                                        <i class= "fa  {{ $opportunity->opportunity_status->icon }}"></i> {{ $opportunity->opportunity_status->description }}
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
                                    <p>{!! $opportunity->description !!}</p>
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
