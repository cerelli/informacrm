

<a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/contact_detail/create?active_account_id='.$entry->id.'&active_contact_id='.$contact->id) }}" class="btn btn-xs btn-default" style="margin-right: 5px;">
    <i class="fa fa-plus-square-o"></i> {{ trans('backpack::crud.add') }}
</a>
@foreach ($contact_details as $key => $contact_detail)
    <li class="list-group-item" id="contact-detail-li-{{ $contact_detail->id }}">
        <div class="col-md-12 button-tools" style="padding: 8px;">
              @if ($crud->hasAccess('delete'))
                  <button class="btn btn-xs btn-default pull-right btn-hidden del-confirmcontactdetails"
                      href="{{ url(config('backpack.base.route_prefix', 'admin') . '/contact_detail').'/'.$contact_detail->id }}"
                      type="button"
                      title="Delete contact_detail"
                      delete-id="{{ $contact_detail->id }}">
                      <i class="fa fa-trash"></i> {{ trans('backpack::crud.delete') }}</a>
                  </button>
              @endif
              <a href='{{ url(config("backpack.base.route_prefix", "admin") . "/contact_detail/".$contact_detail->id."/edit?active_account_id=".$entry->id."&active_contact_id=".$contact->id) }}' class="btn btn-xs btn-default pull-right  btn-hidden" style="margin-right: 5px;">
                  <i class="fa fa-edit"></i> {{ trans('backpack::crud.edit') }}
              </a>
        </div>
        <div class="details" id="contact_detail_panel_{{ $contact_detail->id }}">
          <i title= "{{ $contact_detail->contact_detail_type['description'] }}" class="fa {{ $contact_detail->contact_detail_type['icon'] }}"></i>
          <i title= "{{ $contact_detail->communication_type['description'] }}" class="fa {{ $contact_detail->communication_type['icon'] }}"></i>
          {{ $contact_detail->value }}
          <br/>
      </div>
      @if ( $contact_detail->notes == "" )

      @else
          <div class="well" style="padding: 1px 1px 1px 10px;;">
              <p>{!! $contact_detail->notes !!}</p>
          </div>
      @endif
    </li>
@endforeach

{{-- @section('after_scripts')
    <script type="text/javascript">
      $(document).ready(function($) {

        $('.del-confirmcontactdetails').click(function(e){
          e.preventDefault();
          var delete_button = $(this);
          var delete_url = $(this).attr('href');
          var delete_id = $(this).attr('delete-id');
          console.log(delete_button);
          console.log(delete_url);
          console.log(delete_id);
          console.log("qui1");
        //   console.log(delete_token);
          if (confirm("{{ trans('backpack::crud.delete_confirm') }}") == true) {
              $.ajax({
                  url: delete_url,
                  type: 'DELETE',
                  success: function(result) {
                      // Show an alert with the result
                      new PNotify({
                          title: "{{ trans('backpack::crud.delete_confirmation_title') }}",
                          text: "{{ trans('backpack::crud.delete_confirmation_message') }}",
                          type: "success"
                      });
                      // delete panel of contact deleted
                      $("#contact-detail-li-"+delete_id).remove();
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
    });
    </script>
@endsection --}}
