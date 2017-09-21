{{-- @php
    $url_button = url(config('backpack.base.route_prefix', 'admin') . '/contact/create?active_account_id='.$entry->id);
@endphp
@includeif('vendor.backpack.crud.buttons.create', ['custom_button_url' => $url_button])
@php
    $url_button = "";
@endphp --}}
<!-- Create button -->
@php
    $url_button = url(config('backpack.base.route_prefix', 'admin') . '/contact/create?active_account_id='.$entry->id);
@endphp
@includeif('vendor.backpack.crud.buttons.create', [
    'custom_button_url' => $url_button,
    'custom_button_attributes' => "",
    'custom_button_class' => ""
])
@php
    $url_button = "";
@endphp
{{-- <a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/contact/create?active_account_id='.$entry->id) }}" class="btn btn-xs btn-primary" style="margin-right: 5px;">
    <i class="fa fa-plus-square-o"></i> {{ trans('backpack::crud.add') }}
</a> --}}

<hr>
@foreach ($contacts->chunk(3) as $chunk)
    <div class="row">
        @foreach ($chunk as $contact)
    <div class="col-md-4" id="contact-panel-{{ $contact->id }}">
          <!-- Profile Image -->
          {{-- {{ $request }} --}}
          <div class="panel panel-primary panel-heading col-md-12">
              <div class="panel-title col-md-9">
                  <h3 class="profile-username">
                      {{ $contact->title['description'] }}

                      {{ $contact->FullName }}
                  </h3>
              </div>
              <div class="col-md-3 button-tools" style="padding: 8px;">
                  <!-- Delete button -->
                  @php
                      $url_button = url(config('backpack.base.route_prefix', 'admin') . '/contact').'/'.$contact->id;
                  @endphp
                  @includeif('vendor.backpack.crud.buttons.delete', [
                      'custom_button_url' => $url_button,
                      'custom_button_attributes' => " title='Delete Contact' delete-id='$contact->id'",
                      'custom_button_class' => " pull-right  del-confirmcontact"
                  ])
                  @php
                      $url_button = "";
                  @endphp

                  <!-- Edit button -->
                  @php
                      $url_button = url(config('backpack.base.route_prefix', 'admin') . '/contact').'/'.$contact->id.'/edit';
                  @endphp
                  @includeif('vendor.backpack.crud.buttons.update', [
                      'custom_button_url' => $url_button,
                      'custom_button_attributes' => " title='Edit Contact' style='margin-right: 3px;' ",
                      'custom_button_class' => " pull-right "
                  ])
                  @php
                      $url_button = "";
                  @endphp

                    {{-- @if ($crud->hasAccess('delete'))
                        <button class="btn btn-xs btn-default pull-right  del-confirmcontact"
                            href="{{ url(config('backpack.base.route_prefix', 'admin') . '/contact').'/'.$contact->id }}"
                            type="button"
                            title="Delete Contact"
                            delete-id="{{ $contact->id }}">
                            <i class="fa fa-trash"></i> </a>
                        </button>
                    @endif --}}

                    {{-- <a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/contact').'/'.$contact->id }}/edit" class="btn btn-xs btn-default pull-right  " style="margin-right: 5px;">
                        <i class="fa fa-edit"></i> {{ trans('backpack::crud.edit') }}
                    </a> --}}
              </div>
              {{-- <div class="col-md-9 "> --}}
              <div class="classification col-md-12">
                  <p class="text-muted text-center">
                      {{ $contact->contact_type['description'] }} - {{ $contact->office['description'] }}
                  </p>
              </div>
              <div class="note col-md-12">
                  @if ( $contact->notes == "" )

                  @else
                      <div class="well" style="padding: 1px 1px 1px 10px;">
                          <p>{!! $contact->notes !!}</p>
                      </div>
                  @endif
                  <hr>
              </div>
              {{-- </div> --}}


            <!-- /.box-body -->

                <div class="box-body box-profile  col-md-12">
                    <ul class="list-group list-group-unbordered col-md-12">
                        @include('inf.accounts.partials.contact_details', ['contact_details' => $entry->contact_details()->where('inf_contact_details.inf_contact_id', '=', $contact->id)->get()])
                    </ul>
                </div>
            </div>          <!-- /.panel panel-primary contact-->
         <!-- /.panel panel-primary details-->
        </div> <!-- /#contact-panel.... -->
        @endforeach
        </div>
@endforeach


{{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
