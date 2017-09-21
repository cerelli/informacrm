

{{-- <a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/contact_detail/create?active_account_id='.$entry->id.'&active_contact_id='.$contact->id) }}" class="btn btn-xs btn-default" style="margin-right: 5px;">
    <i class="fa fa-plus-square-o"></i> {{ trans('backpack::crud.add') }}
</a> --}}

<!-- Create button -->
@php
    $url_button = url(config('backpack.base.route_prefix', 'admin') . '/contact_detail/create?active_account_id='.$entry->id.'&active_contact_id='.$contact->id);
@endphp
@includeif('vendor.backpack.crud.buttons.create', [
    'custom_button_url' => $url_button,
    'custom_button_attributes' => "",
    'custom_button_class' => ""
])
@php
    $url_button = "";
@endphp


{{-- @php
    $url_button = url(config('backpack.base.route_prefix', 'admin') . '/contact_detail/create?active_account_id='.$entry->id.'&active_contact_id='.$contact->id);
@endphp
@includeif('vendor.backpack.crud.buttons.create', ['custom_button_url' => $url_button])
@php
    $url_button = "";
@endphp --}}

@foreach ($contact_details as $key => $contact_detail)
    <li class="list-group-item  col-md-12" id="contact-detail-li-{{ $contact_detail->id }}">
        <div class="datails-note col-md-12">
        <div class="details col-md-9" id="contact_detail_panel_{{ $contact_detail->id }}">
            {{-- <p class="text-muted"> --}}
                {{-- class="fa {{ $contact_detail->contact_detail_type['icon'] }}" --}}
                <i class="text-muted" title= "{{ $contact_detail->contact_detail_type['description'] }}" >{{ $contact_detail->contact_detail_type['description'] }}</i>
            {{-- </p> --}}
            {{-- <p class="text-muted"> --}}
                {{-- class="fa {{ $contact_detail->communication_type['icon'] }}" --}}
                 <i class="text-muted" title= "{{ $contact_detail->communication_type['description'] }}" > - {{ $contact_detail->communication_type['description'] }}</i>
            {{-- </p> --}}
            <br>
          {{ $contact_detail->value }}
      </div>
        {{-- <div class="classification col-md-9">
            <p class="text-muted text-center">
                {{ $contact->contact_type['description'] }} - {{ $contact->office['description'] }}
            </p>
        </div> --}}
        <div class="col-md-3 button-tools" style="padding: 8px;">
            <!-- Delete button -->
            @php
                $url_button = url(config('backpack.base.route_prefix', 'admin') . '/contact_detail').'/'.$contact_detail->id;
            @endphp
            @includeif('vendor.backpack.crud.buttons.delete', [
                'custom_button_url' => $url_button,
                'custom_button_attributes' => " title='Delete contact_detail' delete-id='$contact_detail->id'",
                'custom_button_class' => " pull-right del-confirmcontactdetails"
            ])
            @php
                $url_button = "";
            @endphp

            <!-- Edit button -->
            @php
                $url_button = url(config("backpack.base.route_prefix", "admin") . "/contact_detail/".$contact_detail->id."/edit?active_account_id=".$entry->id."&active_contact_id=".$contact->id);
            @endphp
            @includeif('vendor.backpack.crud.buttons.update', [
                'custom_button_url' => $url_button,
                'custom_button_attributes' => " title='Edit Contact detail' style='margin-right: 3px;' ",
                'custom_button_class' => " pull-right "
            ])
            @php
                $url_button = "";
            @endphp
              {{-- @if ($crud->hasAccess('delete'))
                  <button class="btn btn-xs btn-default pull-right del-confirmcontactdetails"
                      href="{{ url(config('backpack.base.route_prefix', 'admin') . '/contact_detail').'/'.$contact_detail->id }}"
                      type="button"
                      title="Delete contact_detail"
                      delete-id="{{ $contact_detail->id }}">
                      <i class="fa fa-trash"></i> {{ trans('backpack::crud.delete') }}</a>
                  </button>
              @endif --}}
              {{-- <a href='{{ url(config("backpack.base.route_prefix", "admin") . "/contact_detail/".$contact_detail->id."/edit?active_account_id=".$entry->id."&active_contact_id=".$contact->id) }}' class="btn btn-xs btn-default pull-right  " style="margin-right: 5px;">
                  <i class="fa fa-edit"></i> {{ trans('backpack::crud.edit') }}
              </a> --}}
        </div>
        </div>
        {{-- <div class="note col-md-12"> --}}
            @if ( $contact_detail->notes == "" )

            @else
                <div class="well note col-md-12" style="padding: 1px 1px 1px 10px;">
                    <p>{!! $contact_detail->notes !!}</p>
                </div>
                <hr>
            @endif

        {{-- </div> --}}

      {{-- @if ( $contact_detail->notes == "" )

      @else
          <div class="well" style="padding: 1px 1px 1px 10px;;">
              <p>{!! $contact_detail->notes !!}</p>
          </div>
      @endif --}}
    </li>
@endforeach
