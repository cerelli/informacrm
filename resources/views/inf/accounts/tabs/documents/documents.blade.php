<div class="box box-primary" style="border-top-color: {{ config('informa.config.documents_color') }} !important; border-top-width: 3px;">
    {{-- <i class="fa {{ config('informa.config.actions_icon') }} bg" style="background-color: {{ config('informa.config.actions_color') }} !important; "></i> --}}
    <div class="box-header">
        <nav class="navbar navbar-default navbar-filters">
            <div id="success">

            </div>
            <div class="container-fluid">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                {{-- <a class="navbar-brand" href="#">{{ trans('backpack::crud.filters') }}</a> --}}
                @can ('create')
                    <!-- Create button -->
                    {{-- {{ dd($filter) }} --}}
                    @includeif('inf.buttons.create', [
                        'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/account/'.$active_account_id['id'].'/document/create'),
                        'custom_button_attributes' => " title='".trans('backpack::crud.add')." ".trans('informacrm.document')."' style='margin-top: 20px;'",
                        'custom_button_class' => ""
                    ])
                @endcan
              </div>
              @foreach ($countDocumentStatuses as $countDocumentStatus)
                        <a class="btn btn-app btn_tab_document_filter" data-document_status_id="{{ $countDocumentStatus->id }}" data-account_id="{{ $active_account_id['id'] }}" data-dati="{{ url(config('backpack.base.route_prefix', 'admin') . '/account_tab_documents/'.$active_account_id['id'].'/'.$countDocumentStatus->id) }}" style="margin: 10px;">
                            <span class="badge bg-teal" style="background-color: {{ $countDocumentStatus->background_color }} !important; color: {{ $countDocumentStatus->color }} !important;">{{ $countDocumentStatus->documents_count }}</span>
                            <i class="fa {{ $countDocumentStatus->icon }}"></i> {{ $countDocumentStatus->description }}
                        </a>
              @endforeach
            </div><!-- /.container-fluid -->
        </nav>
    </div>
    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: auto;">
        <div class="box-body">
            {{-- //include details tab_actions --}}
            {{-- @include('inf.accounts.tabs.actions.details', ['opportunities' => $entry->events]) --}}
            <div class="row" style="background-color: #ecf0f5;">
                <div class="col-md-12">
                    {{-- {{ dump($documents[0]->document_status->color) }} --}}
                    @include('inf.accounts.tabs.documents.details', ['documents' => $documents])
                </div>
            </div>
        </div>
    </div>
</div>





<script>
    $(document).ready(function () {
        $(".btn_tab_document_filter").click(function(e){
            e.preventDefault();
            var document_status_id = $(this).attr('data-document_status_id');
            var account_id = $(this).attr('data-account_id');
            // sendAjaxRequest($(this),'/pages/test/');
            // console.log(action_status_id);
            $.ajax({
                type: "GET",
                url: $(this).attr('data-dati'),
                dataType: 'html',
                data: {
                    account_id: account_id,
                    document_status_id: document_status_id, // < note use of 'this' here
                    access_token: $("#access_token").val()
                },
                success: function(result) {
                    $('#tab_documents_details').html(result);
                },
                error: function(result) {
                    alert('error');
                }
            });
        });
    });
</script>
