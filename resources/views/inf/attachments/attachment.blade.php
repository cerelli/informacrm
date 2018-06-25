<div class="col-md-10">
    {!! $attachment->getShowTitleLink() !!} - {{ trans('general.version') }} {{ $attachment->version }}
    <span id="refresh_attach_status{{ $attachment->id }}">
         {!! $attachment->getExtractionInfo() !!}
    </span>
</div>
<div class="col_md_2" id="refresh_attach_buttons{{ $attachment->id }}">
    @php
        $attachment['document_id'] = $entry->id;
    @endphp
    @include('inf.attachments.buttons',['attachment' => $attachment])
</div>

@section('after_scripts')
    <script>
    $(document).ready(function () {
        function refresh_attach_buttons(attachment_id){
            // e.preventDefault();
            $(".lock-"+attachment_id).toggleClass("hidden");
            $(".unlock-"+attachment_id).toggleClass("hidden");
            // var url_ok = url+'/buttons';
            // console.log('pippo');
            // $.ajax({
            //     url: url_ok,
            //     type: 'PATCH',
            // })
            // .done(function(result) {
            //     $('#refresh_attach_buttons'+attachment_id).html(result);
            //     console.log("success");
            // })
            // .fail(function() {
            //     console.log("error");
            // })
            // .always(function() {
            //     console.log("complete");
            // });
        }

        $('.unlock-attachment').click(function(e){
            e.preventDefault();
            var unlock_button = $(this);
            var unlock_url = $(this).attr('href');
            var attachment_id = $(this).attr('id');
            console.log('uno');
            if (confirm("{{ trans('general.unlock_confirm') }}") == true) {
                $.ajax({
                    url: unlock_url,
                    type: 'PATCH',
                    success: function(result) {
                        if ( result == 0 ) {
                            new PNotify({
                                title: "{{ trans('informacrm.unlock_confirmation_not_title') }}",
                                text: "{{ trans('informacrm.unlock_confirmation_not_message') }}",
                                type: "warning"
                            });
                        } else {
                            // Show an alert with the result
                            // console.log('ok');
                            new PNotify({
                                title: "{{ trans('informacrm.unlock_confirmation_title') }}",
                                text: "{{ trans('informacrm.unlock_confirmation_message') }}",
                                type: "success"
                            });
                            // console.log(result);
                            $('#refresh_attach_status'+attachment_id).html('');
                            // $('#refresh_attach_buttons'+attachment_id).html(result);
                            refresh_attach_buttons(attachment_id);
                            // return to account list
                            // $("#attachment-block-"+delete_id).remove();

                        }
                    },
                    error: function(result) {
                        // Show an alert with the result
                        new PNotify({
                            title: "{{ trans('informacrm.unlock_confirmation_not_title') }}",
                            text: "{{ trans('informacrm.unlock_confirmation_not_message') }}",
                            type: "warning"
                        });
                    }
                });
            } else {
                new PNotify({
                    title: "{{ trans('informacrm.lock_confirmation_not_locked_title') }}",
                    text: "{{ trans('informacrm.lock_confirmation_not_locked_message') }}",
                    type: "info"
                });
            }
        });

        $('.lock-attachment').click(function(e){
            e.preventDefault();
            var lock_button = $(this);
            var lock_url = $(this).attr('href');
            var attachment_id = $(this).attr('id');
            // console.log('qui');
            if (confirm("{{ trans('general.lock_confirm') }}") == true) {
                $.ajax({
                    url: lock_url,
                    type: 'PATCH',
                    success: function(result) {
                        if ( result == 0 ) {
                            new PNotify({
                                title: "{{ trans('informacrm.lock_confirmation_not_title') }}",
                                text: "{{ trans('informacrm.lock_confirmation_not_message') }}",
                                type: "warning"
                            });
                        } else {
                            // Show an alert with the result
                            // console.log(result);
                            new PNotify({
                                title: "{{ trans('informacrm.lock_confirmation_title') }}",
                                text: "{{ trans('informacrm.lock_confirmation_message') }}",
                                type: "success"
                            });
                            $('#refresh_attach_status'+attachment_id).html(result);
                            // $('#refresh_attach_buttons'+attachment_id).html(result);
                            refresh_attach_buttons(attachment_id);
                            // return to account list
                            // $("#attachment-block-"+delete_id).remove();

                        }
                    },
                    error: function(result) {
                        // Show an alert with the result
                        new PNotify({
                            title: "{{ trans('informacrm.lock_confirmation_not_title') }}",
                            text: "{{ trans('informacrm.lock_confirmation_not_message') }}",
                            type: "warning"
                        });
                    }
                });
            } else {
                new PNotify({
                    title: "{{ trans('informacrm.lock_confirmation_not_locked_title') }}",
                    text: "{{ trans('informacrm.lock_confirmation_not_locked_message') }}",
                    type: "info"
                });
            }
        });

        $('.del-confirmattachment').click(function(e){
            e.preventDefault();
            var delete_button = $(this);
            var delete_url = $(this).attr('href');
            var delete_id = $(this).attr('delete-id');
            // console.log('qui');
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
                        $("#attachment-block-"+delete_id).remove();
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
@endsection
