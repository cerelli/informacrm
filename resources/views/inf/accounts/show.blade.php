@extends('backpack::layout')

@section('content-header')
	<section class="content-header">
		<div class="row col-md-12">
			<h1>
	  	    {{ trans('backpack::crud.preview') }} <span>{{ $crud->entity_name }}</span>
	  	  </h1>
	  	  <ol class="breadcrumb">
	  	    <li><a href="{{ url(config('backpack.base.route_prefix'), 'dashboard') }}">{{ trans('backpack::crud.admin') }}</a></li>
	  	    <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
	  	    <li class="active">{{ trans('backpack::crud.preview') }}</li>
	  	  </ol>
		</div>
	</section>
@endsection

@section('content')
	@if ($crud->hasAccess('list'))
		<a href="{{ url($crud->route) }}"><i class="fa fa-angle-double-left"></i> {{ trans('backpack::crud.back_to_all') }} <span>{{ $crud->entity_name_plural }}</span></a><br><br>
	@endif
	<div class="row content col-md-12">
		<div class="row account-types col-md-12">
			<div class="pull-right">
				@include('inf.acud', ['acud' => $crud->acud])
			</div>
	  </div>
		<!-- THE ACTUAL CONTENT -->
		<div class="box col-md-12">
			<div class="box-header with-border col-md-12">
				<div class="row fullname-buttontools col-md-12">
					<div class="row fullname col-md-9">
						<h1 class="name text-light-blue">
							{{  ($entry->title_id > 0)  ? $entry->title->description : ''  }}  {{ $entry->name1 }} {{ $entry->name2 }}
						</h1>
					</div>
					<div class="row button-tools  col-md-3">
						<!-- Delete button -->
						@includeif('vendor.backpack.crud.buttons.delete', [
							'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/account').'/'.$entry->id,
							'custom_button_attributes' => "  title='Delete account' delete-id='$entry->id' ",
							'custom_button_class' => " pull-right  del-confirmaccount"
						])

						<!-- Edit button -->
						@includeif('vendor.backpack.crud.buttons.update', [
							'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/account').'/'.$entry->id.'/edit',
							'custom_button_attributes' => " id='btn_edit_account' title='".trans('backpack::crud.edit')." ".trans('informacrm.account')."'  style='margin-right: 3px;' ",
							'custom_button_class' => " pull-right "
						])
					</div>
				</div>
				<div class="row">
					<!-- account types -->
					{{-- {{ dd($crud->create_fields['account_types']) }} --}}
					@include('vendor.backpack.crud.fields.label_multiple',['field' => $crud->create_fields['account_types'],'action' => 'show'])
				</div>
			</div>
		  <div class="box-body">
			  <div class="tab-container col-md-12">
			  	<div class="nav-tabs-custom" id="form_tabs">
			  		<ul class="nav nav-tabs" role="tablist">
			  			<li role="presentation" class="active">
			  					<a href="#tab_information" aria-controls="tab_information" role="tab" data-toggle="tab">{{ trans('informacrm.information') }}</a>
			  			</li>
			  			<li role="presentation" class="">
			  					<a href="#tab_contacts" aria-controls="tab_contacts" role="tab" data-toggle="tab">{{ trans('informacrm.contacts') }}</a>
			  			</li>
			  			<li role="presentation" class="">
			  					<a href="#tab_web_sites" aria-controls="tab_web_sites" role="tab" data-toggle="tab">{{ trans('informacrm.web_sites') }}</a>
			  			</li>
						<li role="presentation" class="">
								<a href="#tab_addresses" aria-controls="tab_addresses" role="tab" data-toggle="tab">{{ trans('informacrm.addresses') }}</a>
						</li>
						<li role="presentation" class="tab_actions_click">
								<a href="#tab_actions" data-dati="{{ url(config('backpack.base.route_prefix', 'admin') . '/account_tab_actions/'.$entry->id) }}" data-account_id="{{ $entry->id }}" data-tab="tab_actions" aria-controls="tab_actions" role="tab" data-toggle="tab">{{ trans('informacrm.actions') }}</a>
						</li>
						{{-- <li role="presentation" class="">
								<a href="#tab_events" aria-controls="tab_events" role="tab" data-toggle="tab">{{ trans('informacrm.events') }}</a>
						</li> --}}
						<li role="presentation" class="tab_documents_click">
								<a href="#tab_documents" data-dati="{{ url(config('backpack.base.route_prefix', 'admin') . '/account_tab_documents/'.$entry->id) }}" data-account_id="{{ $entry->id }}" data-tab="tab_documents" aria-controls="tab_documents" role="tab" data-toggle="tab">{{ trans('informacrm.documents') }}</a>
						</li>
						{{-- {{ dump(App\Models\Groupings\Grouping_type::countGroupingTypes($entry->id)->get()) }} --}}
						@foreach ($entry->countGroupingTypes as $groupingType)
							{{-- {{ dump($groupingType) }} --}}
							<li role="presentation" class="tab_groupings_click">
									<a href="#tab_grouping_{{ $groupingType->id }}" data-dati="{{ url(config('backpack.base.route_prefix', 'admin') . '/account_tab_groupings/'.$entry->id.'/'.$groupingType->id) }}" data-groupingType_id="{{ $groupingType->id }}" data-account_id="{{ $entry->id }}" data-tab="tab_groupings" aria-controls="tab_groupings" role="tab" data-toggle="tab">{{ $groupingType->description }}</a>
							</li>
						@endforeach
						{{-- <li role="presentation" class="">
								<a href="#tab_opportunities" aria-controls="tab_opportunities" role="tab" data-toggle="tab">{{ trans('informacrm.opportunities') }}</a>
						</li>
						<li role="presentation" class="">
								<a href="#tab_service_tickets" aria-controls="tab_service_tickets" role="tab" data-toggle="tab">{{ trans('informacrm.service_tickets') }}</a>
						</li> --}}

						<li class="dropdown">
	  						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
		  						{{ trans('informacrm.other') }} <span class="caret"></span>
	  						</a>
	  						<ul class="dropdown-menu">
								<li role="presentation" class="">
										<a href="#tab_relations" aria-controls="tab_relations" role="tab" data-toggle="tab">{{ trans('informacrm.relations') }}</a>
								</li>
		  						<li role="presentation"><a href="#tab_time_line" aria-controls="tab_time_line" role="menuitem" tabindex="-1">{{ trans('informacrm.time_line') }}</a></li>
								<li role="presentation"><a href="#tab_permissions" aria-controls="tab_permissions" role="menuitem" tabindex="-1">{{ trans('informacrm.permissions') }}</a></li>
	  						</ul>
  						</li>
			  		</ul>
			  	</div>
			  </div>
			  <div class="tab-content col-md-12">
			  	<div role="tabpanel" class="tab-pane active" id="tab_information">
			  		@include('inf.accounts.tabs.informations', ['informations' => $entry])
			  	</div>
				<div role="tabpanel" class="tab-pane" id="tab_contacts">
			  		@include('inf.accounts.tabs.contacts', ['contacts' => $entry->contacts])
			  	</div>
				<div role="tabpanel" class="tab-pane" id="tab_web_sites">
					@include('inf.accounts.tabs.web_sites', ['web_sites' => $entry->web_sites])
				</div>
				<div role="tabpanel" class="tab-pane" id="tab_addresses">
					@include('inf.accounts.tabs.addresses', ['addresses' => $entry->addresses])
				</div>
				<div role="tabpanel" class="tab-pane" id="tab_relations">
					{{-- @include('inf.accounts.tabs.informations', ['informations' => $entry]) --}}
				</div>
				<div role="tabpanel" class="tab-pane" id="tab_actions">
					{{-- @include('inf.accounts.tabs.actions', ['actions' => $entry->actions]) --}}
					{{-- @include('inf.accounts.tabs.actions.list_internal') --}}
				</div>
				{{-- <div role="tabpanel" class="tab-pane" id="tab_events">
					@include('inf.accounts.tabs.events', ['events' => $entry->events])
				</div> --}}
				<div role="tabpanel" class="tab-pane" id="tab_documents">
					{{-- @include('inf.accounts.tabs.documents', ['opportunities' => $entry->events]) --}}
				</div>
				@foreach ($entry->countGroupingTypes as $groupingType)
					<div role="tabpanel" class="tab-pane" id="tab_grouping_{{ $groupingType->id }}">
						{{-- @include('inf.accounts.tabs.documents', ['opportunities' => $entry->events]) --}}
					</div>
				@endforeach
				{{-- <div role="tabpanel" class="tab-pane" id="tab_opportunities">
					@include('inf.accounts.tabs.opportunities', ['opportunities' => $entry->opportunities])
				</div>
				<div role="tabpanel" class="tab-pane" id="tab_service_tickets">
					@include('inf.accounts.tabs.service_tickets', ['service_tickets' => $entry->service_tickets])
				</div> --}}
				<div role="tabpanel" class="tab-pane" id="tab_time_line">
					{{-- @include('inf.accounts.tabs.informations', ['informations' => $entry]) --}}

				</div>
				<div role="tabpanel" class="tab-pane" id="tab_permissions">
					{{-- @include('inf.accounts.tabs.informations', ['informations' => $entry]) --}}
				</div>
			  </div>
		  </div><!-- /.box-body -->

		  @include('crud::inc.button_stack', ['stack' => 'bottom'])

		</div><!-- /.box -->
	</div>
@endsection


@section('after_styles')
	<link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/crud.css') }}">
	<link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/show.css') }}">

	<link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css">

	<link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/crud.css') }}">
	<link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/form.css') }}">
	<link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/list.css') }}">
@endsection

@section('after_scripts')
	<!-- DATA TABLES SCRIPT -->
	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap.min.js"></script>

	<script src="{{ asset('vendor/backpack/crud/js/crud.js') }}"></script>
	<script src="{{ asset('vendor/backpack/crud/js/show.js') }}"></script>
	@include('inf.accounts.js')

	<script>
		$(document).ready(function() {
			$('[data-tab="tab_actions"]').click(function(e) {
				var account_id = $(this).attr('data-account_id');
				// console.log($(this).attr('data-dati'));
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
		});
	</script>
@endsection


{{-- <script>
$(function() {
               $('#example1').DataTable({
               processing: true,
               serverSide: true,
               ajax: '{{ url('/admin/user_dt_ajax') }}',
               columns: [
				   { data: 'id', name: 'id' },
  				 { data: 'title', name: 'title' },
  				 { data: 'notes', name: 'notes' }
                     ]
            });
         });
</script> --}}
