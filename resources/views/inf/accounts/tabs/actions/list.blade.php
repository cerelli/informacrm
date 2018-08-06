<style>
    .btn_filter_selected {
	       border-color: red;
	  }
</style>

@can ('create')
    <!-- Create button -->
    {{-- {{ dd($filter) }} --}}
    @includeif('inf.buttons.create', [
        'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/account/'.$active_account_id['id'].'/action/create'),
        'custom_button_attributes' => " title='".trans('backpack::crud.add')." ".trans('informacrm.action')."' '",
        'custom_button_class' => ""
    ])
@endcan

<a class="btn btn-app btn_tab_action_filter btn_filter_selected btnF0" data-action_status_id="0" data-account_id="{{ $active_account_id['id'] }}" data-dati="{{ url('/datatables/data/'.$active_account_id['id'].'/0') }}" style="margin: 10px;">
    <span class="badge bg-teal" >{{ $countActionStatuses->sum('actions_count') }}</span>
    <i class="fa fa-globe"></i> {{ trans('general.all') }}
</a>

@foreach ($countActionStatuses as $countActionStatus)
    {{-- {{ dd($active_account_id) }} --}}
          <a class="btn btn-app btn_tab_action_filter btnF{{ $countActionStatus->id }}" data-action_status_id="{{ $countActionStatus->id }}" data-account_id="{{ $active_account_id['id'] }}" data-dati="{{ url('/datatables/data/'.$active_account_id['id'].'/'.$countActionStatus->id) }}" style="margin: 10px;">
              <span class="badge bg-teal" style="background-color: {{ $countActionStatus->background_color }} !important; color: {{ $countActionStatus->color }} !important;">{{ $countActionStatus->actions_count }}</span>
              <i class="fa {{ $countActionStatus->icon }}"></i> {{ $countActionStatus->description }}
          </a>
@endforeach
<div class="panel panel-primary panel-heading col-md-12" >
      <table class="table table-striped table-bordered table-hover display responsive nowrap dataTable dtr-inline" id="informaTable">
          {!! $columns !!}
      </table>
</div>

@include('inf.accounts.tabs.actions.list_details', ['active_account_id' => $active_account_id['id'],'action_type' => 0])

<script>
    $(document).ready(function () {
        $(".btn_tab_action_filter").click(function(e){
            e.preventDefault();
            var ajax_table = $('#informaTable').DataTable();
            var current_url = ajax_table.ajax.url();

            var statusIdOLD = current_url.substr(current_url.lastIndexOf('/') + 1);;
            var new_url = $(this).attr('data-dati');
            var statusIdNEW = new_url.substr(new_url.lastIndexOf('/') + 1);;
            ajax_table.ajax.url(new_url).load();
            $(".btnF"+statusIdOLD).toggleClass("btn_filter_selected");
            $(".btnF"+statusIdNEW).toggleClass("btn_filter_selected");
            // console.log(statusId);
            // var action_status_id = $(this).attr('data-action_status_id');
            // var account_id = $(this).attr('data-account_id');
            // $.ajax({
            //     type: "GET",
            //     url: $(this).attr('data-dati'),
            //     dataType: 'html',
            //
            //     success: function(result) {
            //         $('#informaTable').html(result);
            //     },
            //     error: function(result) {
            //         alert('error');
            //     }
            // });
        });
    });
</script>
