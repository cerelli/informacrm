<!-- Create button -->
@includeif('vendor.backpack.crud.buttons.create', [
    'custom_button_url' => url(config('backpack.base.route_prefix', 'admin').'/account/'.$entry->id.'/address/create'),
    'custom_button_attributes' => " title='".trans('backpack::crud.add')." ".trans('informacrm.address')."' ",
    'custom_button_class' => ""
])
<hr>
@foreach ($addresses->chunk(2) as $chunk)
    <div class="row">
        @foreach ($chunk as $address)
            <div class="col-md-6" id="addresses-panel-{{ $address->id }}">
                <div class="panel panel-primary panel-heading col-md-12" style="padding-left: 0px; padding-right: 0px; padding-bottom: 0px;">
                    <div class="row col-md-12" style="margin-left: 0px;margin-right: 0px;padding-left: 0px;padding-right: 0px;">
                        <div class="row col-md-12" style="margin-left: 0px;margin-right: 0px;padding-right: 0px;padding-left: 0px;">
                            <div class="panel-title col-md-9">
                                <p class="text-muted">
                                    {{ $address->address_types['description'] }}
                                </p>
                                <h3 class="profile-username">
                                    {!! $address->FormattedAddress !!}
                                </h3>
                            </div>
                            <div class="col-md-3 button-tools" style="padding: 8px;">
                                <!-- Delete button -->
                                @includeif('inf.buttons.delete', [
                                    'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/account/'.$address->account_id.'/address').'/'.$address->id,
                                    'custom_button_attributes' => "  title='Delete address' delete-id='$address->id' ",
                                    'custom_button_class' => " pull-right  del-confirmaddress"
                                ])

                                <!-- Edit button -->
                                @includeif('vendor.backpack.crud.buttons.update', [
                                    'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/account/'.$address->account_id.'/address').'/'.$address->id.'/edit',
                                    'custom_button_attributes' => " title='Edit address' style='margin-right: 3px;' ",
                                    'custom_button_class' => " pull-right "
                                ])
                            </div>
                        </div>
                        <div class="note col-md-12" style="padding-bottom: 15px;">
                            @if ( $address->notes == "" )

                            @else
                                <div class="well" style="padding: 1px 1px 1px 10px; margin-bottom: 0px;">
                                    <p>{!! $address->notes !!}</p>
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
