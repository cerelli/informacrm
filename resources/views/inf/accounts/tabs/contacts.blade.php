<a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/contact/create?active_account_id='.$entry->id) }}" class="btn btn-xs btn-default" style="margin-right: 5px;">
    <i class="fa fa-plus-square-o"></i> {{ trans('backpack::crud.add') }}
</a>
<hr>
@foreach ($contacts->chunk(3) as $chunk)
    <div class="row">
        @foreach ($chunk as $contact)
    <div class="col-md-4" id="contact-panel-{{ $contact->id }}">
          <!-- Profile Image -->
          {{-- {{ $request }} --}}
          <div class="panel panel-primary ">
              <div class="col-md-12 button-tools" style="padding: 8px;">
                    @if ($crud->hasAccess('delete'))
                        <button class="btn btn-xs btn-default pull-right btn-hidden del-confirmcontact"
                            href="{{ url(config('backpack.base.route_prefix', 'admin') . '/contact').'/'.$contact->id }}"
                            type="button"
                            title="Delete Contact"
                            delete-id="{{ $contact->id }}">
                            <i class="fa fa-trash"></i> {{ trans('backpack::crud.delete') }}</a>
                        </button>
                    @endif
                    <a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/contact').'/'.$contact->id }}/edit" class="btn btn-xs btn-default pull-right  btn-hidden" style="margin-right: 5px;">
                        <i class="fa fa-edit"></i> {{ trans('backpack::crud.edit') }}
                    </a>
              </div>
            <div class="box-body box-profile">
                <h3 class="profile-username">
                    {{ $contact->title['description'] }}
                    <br/>
                    {{ $contact->FullName }}
                </h3>
                <p class="text-muted text-center">
                    {{ $contact->contact_type['description'] }} - {{ $contact->office['description'] }}
                </p>
                @if ( $contact->notes == "" )

                @else
                    <hr>
                    <div class="well" style="padding: 1px 1px 1px 10px;;">
                        <p>{!! $contact->notes !!}</p>
                    </div>
                @endif
            <ul class="list-group list-group-unbordered">
                @include('inf.accounts.partials.contact_details', ['contact_details' => $entry->contact_details()->where('inf_contact_details.inf_contact_id', '=', $contact->id)->get()])
            </ul>
            </div>
            <!-- /.box-body -->
          </div>          <!-- /.box -->
          <!-- /.box -->
        </div>
        @endforeach
        </div>
@endforeach


{{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
