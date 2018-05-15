{{-- @if ($crud->hasAccess('delete')) --}}
	@php
		$url = '';
		$attributes = '';
		$class = '';
		$idAssignButton = '';
		if ( !isset($custom_button_class_name) ) {
			// $url = url($crud->route.'/'.$entry->getKey());
		} else {
			if ( isset($custom_button_class_name) ) {
				$idAssignButton = '.'.$custom_button_class_name;
			}

		}
		if ( !isset($custom_button_url) ) {
			// $url = url($crud->route.'/'.$entry->getKey());
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
			$class = ' class="btn btn-xs btn-info " ';
		} else {
			if ( isset($custom_button_class) ) {
				$class = ' class="btn btn-xs btn-info '.$custom_button_class.'"';
			}

		}

	@endphp
	<a href='{!! $url !!}' {!! $class !!} data-button-type="assign" {!! $attributes !!}><i class="fa fa-hand-o-right"></i>
		@if ( Config::get('settings.button_label') == '0') {{ trans('general.assign') }}@endif
	</a>

<script>
$('{{$idAssignButton}}').click(function(e){
  e.preventDefault();
  var assign_button = $(this);
  var delete_url = $(this).attr('href');
  var delete_id = $(this).attr('delete-id');
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
