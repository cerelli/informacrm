@if ($crud->hasAccess('delete'))
	@php
		$url = '';
		$attributes = '';
		$class = '';
		// $redirect = url($crud->route);
		if ( !isset($custom_button_url) ) {
			$url = url($crud->route.'/'.$entry->getKey());
		} else {
			if ( isset($custom_button_url) ) {
				$url = $custom_button_url;
			}
		}
		if ( !isset($custom_button_attributes) ) {
			$attributes = '';
		} else {
			if ( isset($custom_button_attributes) ) {
				$attributes = $custom_button_attributes;
			}
		}
		if ( !isset($custom_button_class) ) {
			$class = ' class="btn btn-xs btn-danger " ';
		} else {
			if ( isset($custom_button_class) ) {
				$class = ' class="btn btn-xs btn-danger '.$custom_button_class.'"';
			}
		}
	@endphp
	<a href="javascript:void(0)" onclick="deleteEntry(this)" data-route="{!! $url !!}"
		@if ( $class == '') class="btn btn-xs btn-danger" @else {!! $class !!} @endif
		 data-button-type="delete" {!! $attributes !!}><i class="fa fa-trash"></i>
		@if ( Config::get('settings.button_label') == '0') {{ trans('backpack::crud.delete') }}@endif </a>
@endif

<script>
	var redirect = "{{url($crud->route)}}";
	if (typeof deleteEntry != 'function') {
	  $("[data-button-type=delete]").unbind('click');

	  function deleteEntry(button) {
	      // ask for confirmation before deleting an item
	      // e.preventDefault();
	      var button = $(button);
	      var route = button.attr('data-route');
	      var row = $("#crudTable a[data-route='"+route+"']").parentsUntil('tr').parent();
		  // var path = route) }};
		  console.log(redirect);
	      if (confirm("{{ trans('backpack::crud.delete_confirm') }}") == true) {
	          $.ajax({
	              url: route,
	              type: 'DELETE',
	              success: function(result) {
	                  // Show an alert with the result
	                  new PNotify({
	                      title: "{{ trans('backpack::crud.delete_confirmation_title') }}",
	                      text: "{{ trans('backpack::crud.delete_confirmation_message') }}",
	                      type: "success"
	                  });

	                  // Hide the modal, if any
	                  $('.modal').modal('hide');
	                  // Remove the row from the datatable
	                  row.remove();
					  window.location.href = redirect;

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
	      	  // Show an alert telling the user we don't know what went wrong
	          new PNotify({
	              title: "{{ trans('backpack::crud.delete_confirmation_not_deleted_title') }}",
	              text: "{{ trans('backpack::crud.delete_confirmation_not_deleted_message') }}",
	              type: "info"
	          });
	      }
      }
	}

	// make it so that the function above is run after each DataTable draw event
	// crud.addFunctionToDataTablesDrawEventQueue('deleteEntry');
</script>
