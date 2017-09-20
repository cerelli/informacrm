
<a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/address/create?active_account_id='.$entry->id) }}" class="btn btn-xs btn-default" style="margin-right: 5px;">
    <i class="fa fa-plus-square-o"></i> {{ trans('backpack::crud.add') }}
</a>
<hr>
@foreach ($addresses->chunk(2) as $chunk)
    <div class="row">
        @foreach ($chunk as $address)
    <div class="col-md-6" id="addresses-panel-{{ $address->id }}">
          <!-- Profile Image -->
          {{-- {{ $request }} --}}
          <div class="panel panel-primary ">
              <div class="col-md-12 button-tools" style="padding: 8px;">
                    @if ($crud->hasAccess('delete'))
                        <button class="btn btn-xs btn-default pull-right btn-hidden del-confirmaddress"
                            href="{{ url(config('backpack.base.route_prefix', 'admin') . '/address').'/'.$address->id }}"
                            type="button"
                            title="Delete contact_detail"
                            delete-id="{{ $address->id }}">
                            <i class="fa fa-trash"></i> {{ trans('backpack::crud.delete') }}</a>
                        </button>
                    @endif
                    <a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/address').'/'.$address->id }}/edit" class="btn btn-xs btn-default pull-right  btn-hidden" style="margin-right: 5px;">
                        <i class="fa fa-edit"></i> {{ trans('backpack::crud.edit') }}
                    </a>
              </div>
            <div class="box-body box-profile">
                <h3 class="profile-username">
                    {!! $address->FormattedAddress !!}
                </h3>
                <p class="text-muted text-center">
                    {{ $address->address_types['description'] }}
                </p>
                @if ( $address->notes == "" )

                @else
                    <hr>
                    <div class="well" style="padding: 1px 1px 1px 10px;;">
                        <p>{!! $address->notes !!}</p>
                    </div>
                @endif
            </div>
            <!-- /.box-body -->
          </div>          <!-- /.box -->
          <!-- /.box -->
        </div>
        @endforeach
        </div>
@endforeach
