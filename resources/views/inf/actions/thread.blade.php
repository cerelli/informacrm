<div class="row">
    <div class="col-md-2">
        <a class="btn btn-primary btn_add_internal_note" id="internal_note_01"
            {{-- data-action_status_id="all001"  --}}
            data-action_id="{{ $internalNote['action_id'] }}"
            data-dati="{{ url(config('backpack.base.route_prefix', 'admin') . '/action/saveinternalnote/'.$internalNote['action_id']) }}"
            data-dati_blank="{{ url(config('backpack.base.route_prefix', 'admin') . '/action/internalnote/'.$internalNote['action_id']) }}"
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

{{-- <div class="row" id="refreshDetailsThread">

</div> --}}
<script src="{{ asset('vendor/backpack/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('vendor/backpack/ckeditor/adapters/jquery.js') }}"></script>
<script>
    CKEDITOR.replace( 'summaryckeditor' );

// $(document).ready(function () {
//     var accountReturnURL = document.baseURI;
//     var tabhash = accountReturnURL.split('#')[1];
//     if (tabhash == 'information'){
//         // console.log(tabhash);
//         $('#internal_note_01').trigger('click');
//         // console.log(tabhash);
//     }else{
//         // console.log('pippo');
//     }
// });

</script>
