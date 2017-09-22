<div class="row col-md-12" style="margin-left: 10px; padding-left: 0px">
    <!-- Create button -->
    @includeif('vendor.backpack.crud.buttons.create', [
        'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/contact_detail/create?active_account_id='.$entry->id.'&active_contact_id='.$contact->id),
        'custom_button_attributes' => " ",
        'custom_button_class' => "  btn-xs  "
    ])
</div>
<ul class="list-group list-group-unbordered col-md-12" style="padding-right: 0px;">
    @foreach ($contact_details as $key => $contact_detail)
        <li class="list-group-item  col-md-12" id="contact-detail-li-{{ $contact_detail->id }}" style="border-top-width: 0px;border-top-width: 0px;margin-top: 3px;padding-bottom: 0px;">
            <div class="row col-md-12" style="margin-left: 0px;margin-right: 0px;padding-right: 0px;padding-left: 0px;">
                <div class="details col-md-9" id="contact_detail_panel_{{ $contact_detail->id }}">
                        <i class="text-muted" title= "{{ $contact_detail->contact_detail_type['description'] }}" >{{ $contact_detail->contact_detail_type['description'] }}</i>
                         <i class="text-muted" title= "{{ $contact_detail->communication_type['description'] }}" > - {{ $contact_detail->communication_type['description'] }}</i>
                    <br>
                  {{ $contact_detail->value }}
              </div>
                <div class="col-md-3 button-tools" style="padding: 8px;">
                    <!-- Delete button -->
                    @includeif('vendor.backpack.crud.buttons.delete', [
                        'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/contact_detail').'/'.$contact_detail->id,
                        'custom_button_attributes' => " title='Delete contact_detail' delete-id='$contact_detail->id'",
                        'custom_button_class' => " pull-right del-confirmcontactdetails"
                    ])

                    <!-- Edit button -->
                    @includeif('vendor.backpack.crud.buttons.update', [
                        'custom_button_url' => url(config('backpack.base.route_prefix', 'admin').'/contact_detail/'.$contact_detail->id.'/edit?active_account_id='.$entry->id.'&active_contact_id='.$contact->id),
                        'custom_button_attributes' => " title='Edit Contact detail' style='margin-right: 3px;' ",
                        'custom_button_class' => " pull-right "
                    ])
                </div>
            </div>

            <div class="note col-md-12" >
                @if ( $contact_detail->notes == "" )
                @else
                    <div class="well note col-md-12"  style="padding: 1px 1px 1px 0px;">
                        <p>{!! $contact_detail->notes !!}</p>
                    </div>
                @endif
            </div>
        </li>
    @endforeach
</ul>

{{-- <a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/contact_detail/create?active_account_id='.$entry->id.'&active_contact_id='.$contact->id) }}" class="btn btn-xs btn-default" style="margin-right: 5px;">
    <i class="fa fa-plus-square-o"></i> {{ trans('backpack::crud.add') }}
</a> --}}

<!-- Create button -->

{{-- @php
    $url_button = url(config('backpack.base.route_prefix', 'admin') . '/contact_detail/create?active_account_id='.$entry->id.'&active_contact_id='.$contact->id);
@endphp
@includeif('vendor.backpack.crud.buttons.create', [
    'custom_button_url' => $url_button,
    'custom_button_attributes' => "",
    'custom_button_class' => "  btn-xs  "
])
@php
    $url_button = "";
@endphp --}}
