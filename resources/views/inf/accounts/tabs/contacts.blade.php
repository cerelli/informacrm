<!-- Create button -->
@includeif('vendor.backpack.crud.buttons.create', [
    'custom_button_url' => url(config('backpack.base.route_prefix', 'admin').'/contact/create?active_account_id='.$entry->id),
    'custom_button_attributes' => "",
    'custom_button_class' => ""
])
<hr>
@foreach ($contacts->chunk(3) as $chunk)
    <div class="row">
        @foreach ($chunk as $contact)
            <div class="col-md-4" id="contact-panel-{{ $contact->id }}">
                <div class="panel panel-primary panel-heading col-md-12" style="padding-left: 0px; padding-right: 0px; padding-bottom: 0px;">
                    <div class="row col-md-12" style="margin-left: 0px;margin-right: 0px;padding-left: 0px;padding-right: 0px;">
                        <div class="classification col-md-12">
                            <p class="text-muted text-center">
                                {{ $contact->contact_type['description'] }} - {{ $contact->office['description'] }}
                            </p>
                        </div>
                        <div class="row col-md-12" style="margin-left: 0px;margin-right: 0px;padding-right: 0px;padding-left: 0px;">
                            <div class="panel-title col-md-9">
                                <h3 class="profile-username">
                                    {{ $contact->title['description'] }}

                                    {{ $contact->FullName }}
                                </h3>
                            </div>
                            <div class="col-md-3 button-tools" style="padding: 8px;">
                                <!-- Delete button -->
                                @includeif('vendor.backpack.crud.buttons.delete', [
                                    'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/contact').'/'.$contact->id,
                                    'custom_button_attributes' => " title= 'Delete Contact' delete-id='$contact->id'",
                                    'custom_button_class' => " pull-right del-confirmcontactdetails"
                                ])

                                <!-- Edit button -->
                                @includeif('vendor.backpack.crud.buttons.update', [
                                    'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/contact').'/'.$contact->id.'/edit',
                                    'custom_button_attributes' => " title='Edit Contact' style='margin-right: 3px;' ",
                                    'custom_button_class' => " pull-right "
                                ])
                            </div>
                        </div>
                        <div class="note col-md-12">
                            @if ( $contact->notes == "" )

                            @else
                                <div class="well" style="padding: 1px 1px 1px 10px; margin-bottom: 0px;">
                                    <p>{!! $contact->notes !!}</p>
                                </div>
                            @endif
                            <hr style="margin-bottom: 2px;margin-top: 2px; border-color: #0016f5;">
                        </div>

                    </div>
                    <div class="row col-md-12" style="padding-right: 0px;padding-bottom: 3px;padding-left: 0px;margin-left: 0px;margin-right: 0px;">
                        @include('inf.accounts.partials.contact_details', ['contact_details' => $entry->contact_details()->where('inf_contact_details.inf_contact_id', '=', $contact->id)->get()])
                        <!-- contact_details -->
                        {{-- <div class="box-body box-profile  col-md-12"> --}}

                        {{-- </div> --}}
                    </div>
                </div>          <!-- /.panel panel-primary contact-->
            </div> <!-- /#contact-panel.... -->
        @endforeach
    </div>
@endforeach


{{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
