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
		<!-- THE ACTUAL CONTENT -->
		<div class="box col-md-12">
			<div class="box-header with-border col-md-12">
				<div class="row fullname-buttontools col-md-12">
					<div class="row fullname col-md-9">
						<h1 class="name text-light-blue">
							{{  ($entry->inf_title_id > 0)  ? $entry->title->description : ''  }}  {{ $entry->name1 }} {{ $entry->name2 }}
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
				<div class="row account-types col-md-12">
					<!-- account types -->
					@include('vendor.backpack.crud.fields.label_multiple',['field' => $crud->create_fields['account_types']])
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
						<li role="presentation" class="">
								<a href="#tab_events" aria-controls="tab_events" role="tab" data-toggle="tab">{{ trans('informacrm.events') }}</a>
						</li>
						<li role="presentation" class="">
								<a href="#tab_opportunities" aria-controls="tab_opportunities" role="tab" data-toggle="tab">{{ trans('informacrm.opportunities') }}</a>
						</li>
						<li role="presentation" class="">
								<a href="#tab_documents" aria-controls="tab_documents" role="tab" data-toggle="tab">{{ trans('informacrm.documents') }}</a>
						</li>
						<li role="presentation" class="">
								<a href="#tab_service_tickets" aria-controls="tab_service_tickets" role="tab" data-toggle="tab">{{ trans('informacrm.service_tickets') }}</a>
						</li>
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
				<div role="tabpanel" class="tab-pane" id="tab_events">
					@include('inf.accounts.tabs.events', ['events' => $entry->events])
				</div>
				<div role="tabpanel" class="tab-pane" id="tab_opportunities">
					{{-- @include('inf.accounts.tabs.informations', ['informations' => $entry]) --}}
				</div>
				<div role="tabpanel" class="tab-pane" id="tab_documents">
					{{-- @include('inf.accounts.tabs.informations', ['informations' => $entry]) --}}
				</div>
				<div role="tabpanel" class="tab-pane" id="tab_service_tickets">
					{{-- @include('inf.accounts.tabs.informations', ['informations' => $entry]) --}}
				</div>
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
@endsection

@section('after_scripts')
	<script src="{{ asset('vendor/backpack/crud/js/crud.js') }}"></script>
	<script src="{{ asset('vendor/backpack/crud/js/show.js') }}"></script>
	@include('inf.accounts.js')
@endsection
