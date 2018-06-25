{{-- <a href="#tab_documents" data-dati="{{ url(config('backpack.base.route_prefix', 'admin') . '/account_tab_actions/'.$entry->id) }}" data-tab="tab_actions" aria-controls="tab_actions" role="tab" data-toggle="tab">{{ trans('informacrm.actions') }}</a> --}}
{{-- @include('inf.filter.select2_multiple') --}}
<ul class="timeline" id="tab_documents_details">
    {{-- {{ dump($documents[0]->document_status->background_color) }} --}}
    <!-- timeline time label -->
    <li class="time-label">
        @if (isset($documents[0]))
            <span class="bg" style="background-color: {{ $documents[0]->document_status->background_color }} !important; color: {{ $documents[0]->document_status->color }} !important;">
                {{ $documents[0]->document_status->description }}
            </span>
        @else

        @endif

    </li>
    <!-- /.timeline-label -->

    @foreach ($documents as $document)
        <!-- timeline item -->
        <li class='document-li-{{ $document->id }}'>
            <!-- timeline icon -->
            <i class="fa {{ $document->document_status->icon }} bg" style="background-color: {{ $document->document_status->background_color }} !important; color: {{ $document->document_status->color }} !important;"></i>
            <div class="timeline-item">
                <div class="row col-md-12" style="margin-left: 2px;">
                    <div class="pull-right" id="refresh_acud{{ $document->id }}">
                        @include('inf.acud',['acud' => $document->acud])
                    </div>
                </div>
                <div class="row col-md-12" style="padding-bottom: 10px; padding-top: 5px;">
                    <div class="event-types col-md-10">
                        <!-- event types -->
                        @include('vendor.backpack.crud.fields.internal_label_multiple',['field' => $document->document_types])
                    </div>
                    <div class="button-tools  col-md-2">
                        @can ('delete')
                            <!-- Delete button -->
                            @includeif('inf.buttons.delete', [
                                'custom_button_url' => url(config('backpack.base.route_prefix', 'admin').'/account').'/'.$document->account_id.'/document/'.$document->id,
                                'custom_button_attributes' => "  title='Delete document' delete-id='$document->id' ",
                                'custom_button_class' => " pull-right  del-confirmdocument"
                            ])
                        @endcan

                        <!-- Edit button -->
                        @can ('update')
                            @includeif('inf.buttons.update', [
                                'custom_button_url' => url(config('backpack.base.route_prefix', 'admin').'/account').'/'.$document->account_id.'/document/'.$document->id.'/edit',
                                'custom_button_attributes' => " id='btn_edit_document' title='".trans('backpack::crud.edit')." ".trans('informacrm.document')."'  style='margin-right: 3px;' ",
                                'custom_button_class' => " pull-right "
                            ])
                        @endcan
                    </div>
                </div>
                <h3 class="timeline-header"><a href={{ url(config('backpack.base.route_prefix', 'admin').'/account').'/'.$document->account_id.'/document/'.$document->id }}>[{{ $document->id }}]&nbsp{!! $document->description !!}</a> </h3>

                {{-- <div class="timeline-body">
                    {!! $document->notes !!}
                </div> --}}

                <div class="timeline-footer row">

                </div>
            </div>
        </li>
        <!-- END timeline item -->
    @endforeach

</ul>



<script>

    $(document).ready(function () {
        $('[data-toggle="popover"]').popover({
            html: true,
            placement: 'auto left'
        });

        $('.del-confirmdocument').click(function(e){
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
                        // return to account list
                        $("#tab_documents_details > li.acton-li-"+delete_id).remove();
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
