
{{-- <a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/web_site/create?active_account_id='.$entry->id) }}" class="btn btn-xs btn-default" style="margin-right: 5px;">
    <i class="fa fa-plus-square-o"></i> {{ trans('backpack::crud.add') }}
</a> --}}
<!-- Create button -->
@php
    $url_button = url(config('backpack.base.route_prefix', 'admin') . '/web_site/create?active_account_id='.$entry->id);
@endphp
@includeif('vendor.backpack.crud.buttons.create', [
    'custom_button_url' => $url_button,
    'custom_button_attributes' => " title='Aggiungi' ",
    'custom_button_class' => ""
])
@php
    $url_button = "";
@endphp
<hr>
@foreach ($web_sites->chunk(3) as $chunk)
    <div class="row">
        @foreach ($chunk as $web_site)
    <div class="col-md-4" id="web-site-panel-{{ $web_site->id }}">
          <!-- Profile Image -->
          {{-- {{ $request }} --}}
          <div class="panel panel-primary  col-md-12">
          <div class="box-body box-profile col-md-9">
              <h3 class="profile-username">
                  <a href="{{ $web_site->url }}" target="_blank">{{ $web_site->url }}</a>
              </h3>
              <p class="text-muted">
                  {{ $web_site->web_site_type['description'] }}
              </p>

          </div>

              <div class="col-md-3 button-tools" style="padding: 8px;">
                  <!-- Delete button -->
                  @php
                      $url_button = url(config('backpack.base.route_prefix', 'admin') . '/web_site').'/'.$web_site->id;
                  @endphp
                  @includeif('vendor.backpack.crud.buttons.delete', [
                      'custom_button_url' => $url_button,
                      'custom_button_attributes' => " title='Delete contact_detail' delete-id='$web_site->id'",
                      'custom_button_class' => " pull-right  del-confirmweb"
                  ])
                  @php
                      $url_button = "";
                  @endphp

                  <!-- Edit button -->
                  @php
                      $url_button = url(config('backpack.base.route_prefix', 'admin') . '/web_site').'/'.$web_site->id.'/edit';
                  @endphp
                  @includeif('vendor.backpack.crud.buttons.update', [
                      'custom_button_url' => $url_button,
                      'custom_button_attributes' => " title='Edit Web Site' style='margin-right: 3px;' ",
                      'custom_button_class' => " pull-right "
                  ])
                  @php
                      $url_button = "";
                  @endphp




                    {{-- @if ($crud->hasAccess('delete'))
                        <button class="btn btn-xs btn-default pull-right btn-hidden del-confirmweb"
                            href="{{ url(config('backpack.base.route_prefix', 'admin') . '/web_site').'/'.$web_site->id }}"
                            type="button"
                            title="Delete contact_detail"
                            delete-id="{{ $web_site->id }}">
                            <i class="fa fa-trash"></i> {{ trans('backpack::crud.delete') }}</a>
                        </button>
                    @endif --}}
                    {{-- <a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/web_site').'/'.$web_site->id }}/edit" class="btn btn-xs btn-default pull-right  btn-hidden" style="margin-right: 5px;">
                        <i class="fa fa-edit"></i> {{ trans('backpack::crud.edit') }}
                    </a> --}}
              </div>
              <div class="note col-md-12">
                  @if ( $web_site->notes == "" )

                  @else
                      <hr>
                      <div class="well" style="padding: 1px 1px 1px 10px;;">
                          <p>{!! $web_site->notes !!}</p>
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


{{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
{{-- @section('after_scripts')
    <script type="text/javascript">
        $('.del-confirmweb').click(function(e){
          e.preventDefault();
          var delete_button = $(this);
          var delete_url = $(this).attr('href');
          var delete_id = $(this).attr('delete-id');
          console.log(delete_button);
          console.log(delete_url);
          console.log(delete_id);
        //   console.log(delete_token);
          if (confirm("{{ trans('backpack::crud.delete_confirm') }}") == true) {
              $.ajax({
                  url: delete_url,
                  type: 'DELETE',
                  success: function(result) {
                      // Show an alert with the result
                      new PNotify({
                          title: "{{ trans('backpack::crud.delete_confirmation_title') }}",
                          text: "aaa{{ trans('backpack::crud.delete_confirmation_message') }}",
                          type: "success"
                      });
                      // delete panel of contact deleted
                      $("#web-site-panel-"+delete_id).remove();
                  },
                  error: function(result) {
                      // Show an alert with the result
                      new PNotify({
                          title: "{{ trans('backpack::crud.delete_confirmation_not_title') }}",
                          text: "{{ trans('backpack::crud.delete_confirmation_not_message') }}",
                          type: "warning"
                      });
                  }
              });
          } else {
              new PNotify({
                  title: "{{ trans('backpack::crud.delete_confirmation_not_deleted_title') }}",
                  text: "{{ trans('backpack::crud.delete_confirmation_not_deleted_message') }}",
                  type: "info"
              });
          }
        });
    </script>
@endsection --}}
