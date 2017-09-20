
	<script>
	$('.del-confirmcontact').click(function(e){
	  e.preventDefault();
	  var delete_button = $(this);
	  var delete_url = $(this).attr('href');
	  var delete_id = $(this).attr('delete-id');
	//   console.log(delete_button);
	//   console.log(delete_url);
	//   console.log(delete_id);
	//   console.log("qui");
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
				  $("#contact-panel-"+delete_id).remove();
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
	$(document).ready(function($) {

	  $('.del-confirmcontactdetails').click(function(e){
		e.preventDefault();
		var delete_button = $(this);
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
  $('.del-confirmweb').click(function(e){
	e.preventDefault();
	var delete_button = $(this);
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
  $('.del-confirmaddress').click(function(e){
  e.preventDefault();
  var delete_button = $(this);
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
			  $("#addresses-panel-"+delete_id).remove();
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
