<div class="row">
    <div class="col-md-2">
        <a class="btn btn-primary btn_add_internal_note" id="internal_note_01"
            {{-- data-action_status_id="all001"  --}}
            data-grouping_id="{{ $internalNote['grouping_id'] }}"
            data-dati="{{ url(config('backpack.base.route_prefix', 'admin') . '/grouping/saveinternalnote/'.$internalNote['grouping_id']) }}"
            data-dati_blank="{{ url(config('backpack.base.route_prefix', 'admin') . '/grouping/internalnote/'.$internalNote['grouping_id']) }}"
            style="margin: 10px;">
            {{-- <span class="badge bg-teal" >{{ $actions->count() }}</span> --}}
            <i class="fa fa-refresh"></i>
            {{ ' '.trans('general.update') }}
        </a>
    </div>
    <div class="col-md-10">
        <textarea class="form-control col-md8" id="summaryckeditor" name="InternalContent"></textarea>
    </div>
</div>

<div class="row" id="refreshDetailsThread">

</div>
<script src="{{ asset('vendor/backpack/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('vendor/backpack/ckeditor/adapters/jquery.js') }}"></script>
<script>
    CKEDITOR.replace( 'summaryckeditor' );

    $(document).ready(function () {
        $(".btn_add_internal_note").click(function(e){
            e.preventDefault();
            var grouping_id = $(this).attr('data-grouping_id');
            // sendAjaxRequest($(this),'/pages/test/');
            var content = CKEDITOR.instances.summaryckeditor.getData();
            var notifing = 0;
            if ( content == '') {
                // console.log('vuoto');
                var url = $(this).attr('data-dati_blank')
                var type = "GET";
            } else {
                // console.log(content);
                var url = $(this).attr('data-dati')
                var type = "PATCH";
                notifing = 1;
            }
            // console.log(url);
            $.ajax({
                type: type,
                url: url,
                dataType: 'html',
                data: {
                    grouping_id: grouping_id,
                    content: content,
                    access_token: $("#access_token").val()
                },
                success: function(result) {
                    if ( notifing ) {
                        new PNotify({
                            title: "{{ trans('general.grouping_thread_confirmation_title') }}",
                            text: "{{ trans('general.grouping_thread__confirmation_message') }}",
                            type: "success"
                        });
                    }
                    $('#refreshDetailsThread').html(result);
                    CKEDITOR.instances.summaryckeditor.setData('');

                },
                error: function(result) {
                    if ( notifing ) {
                        new PNotify({
                            title: "{{ trans('general.grouping_thread_confirmation_not_title') }}",
                            text: "{{ trans('general.grouping_thread_confirmation_not_message') }}",
                            type: "warning"
                        });
                    }
                }
            });
        });
    });
$(document).ready(function () {
    var accountReturnURL = document.baseURI;
    var tabhash = accountReturnURL.split('#')[1];
    if (tabhash == 'information'){
        // console.log(tabhash);
        $('#internal_note_01').trigger('click');
        // console.log(tabhash);
    }else{
        // console.log('pippo');
    }
});

</script>
