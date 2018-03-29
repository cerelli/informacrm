

	<script>
	$(document).ready(function($) {
		var accountReturnURL = document.baseURI;
		var tabhash = accountReturnURL.split('#')[1];
		if (tabhash == 'actions'){
			// console.log(tabhash);
			$('[data-tab="tab_actions"]').trigger("click");
		}else{
			// console.log('pippo');
		}
	});
	// parser.href = window.location.href;


	// function returnURL() {
	// 	var accountReturnURL = document.baseURI;
	// 	var tabhash = accountReturnURL.split('#')[1];
	// 	console.log(tabhash);
	// 	// parser.href = "http://example.com:3000/pathname/?search=test#hash";
	// 	//
	// 	// parser.protocol; // => "http:"
	// 	// parser.hostname; // => "example.com"
	// 	// parser.port;     // => "3000"
	// 	// parser.pathname; // => "/pathname/"
	// 	// parser.search;   // => "?search=test"
	// 	// parser.hash;     // => "#hash"
	// 	// parser.host;     // => "example.com:3000"
	// 	var url_string = accountReturnURL;
	// 	var url = new URL(url_string);
	// 	var c = url.searchParams.get("call_url");
	// 	console.log(c);
	//     alert(c);
	// }
	//
	// $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
	// 	accountReturnURL = document.baseURI // activated tab
 //  		document.getElementById("active_tab").value = accountReturnURL;
	// });
	//
	//
	$('[data-tab="tab_actions"]').click(function(e) {
		var account_id = $(this).attr('data-account_id');
		// console.log(account_id);
		$.ajax({
			type: "GET",
			url: $(this).attr('data-dati'),
			dataType: 'html',
			data: {
				// account_id: account_id, // < note use of 'this' here
				access_token: $("#access_token").val()
			},
			success: function(result) {
				$('#tab_actions').html(result);
			},
			error: function(result) {
				alert('error');
			}
		});
	});

	$('a.btn.btn-app.btn_action_1').click(function(e) {
		e.preventDefault();
		console.log('pippo');

	});

	$('#btn_edit_account').click(function(e) {
		e.preventDefault()
		var currentURL = $(location).attr('href');
		var tabhash = currentURL.split('#')[1];
		var pp = "{{ url(config('backpack.base.route_prefix', 'admin') . '/account').'/'.$entry->id.'/edit?call_url=' }}"+tabhash;
		var test = currentURL+"{{ '?call_url='.Request::path()}}";
		// console.log(pp);
		window.open(pp,"_self");
	});

	$('.del-confirmaccount').click(function(e){
    e.preventDefault();
    var delete_button = $(this);
    var delete_url = $(this).attr('href');
    var delete_id = $(this).attr('delete-id');
	var after_url = "{{ url(config('backpack.base.route_prefix', 'admin') . '/account') }}";
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
  			  // return to account list
			  window.open(after_url,"_self");
  	// 		  $("#addresses-panel-"+delete_id).remove();
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
				  console.log('qui');
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

  $('.del-confirmevent').click(function(e){
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
				$("#event-panel-"+delete_id).remove();
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

  $('.del-confirmopportunity').click(function(e){
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
			  $("#opportunity-panel-"+delete_id).remove();
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

  $('.del-confirmservice_ticket').click(function(e){
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
			  $("#service_ticket-panel-"+delete_id).remove();
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

  //***************************************************************************************

  </script>
