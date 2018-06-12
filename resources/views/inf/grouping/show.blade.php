@extends('backpack::layout')

{{-- @foreach ($entry->actions as $action)
	{{ $action->action_status }}
@endforeach --}}
{{-- {{ dump($entry) }} --}}
@section('header')
	<section class="content-header">
	  <h1>
		<i class="fa {{ $entry->grouping_type->icon }}"></i>
        <span class="text-capitalize">{{ $entry->grouping_type->description.' ['.$entry->id.']' }}</span>
		{{-- <div class="row col-md-12" style="margin-left: 2px;"> --}}

		{{-- </div> --}}
        {{-- <small>{{ trans('backpack::crud.edit').' '.$entry->grouping_type->description }}.</small> --}}
	  </h1>
	  <div class="pull-right" >
		  @include('inf.acud',['acud' => $acud])
	  </div>
	  <ol class="breadcrumb">
	    <li><a href="{{ url(config('backpack.base.route_prefix'),'dashboard') }}">{{ trans('backpack::crud.admin') }}</a></li>
	    <li><a href="{{ url($crud->route) }}?grouping_type_id={{ $entry->grouping_type->id }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
	    <li class="active">{{ trans('backpack::crud.edit') }}</li>
	  </ol>
	</section>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12 ">
		<!-- Default box -->
		@if ($crud->hasAccess('list'))
			<a href="{{ url($crud->route) }}?grouping_type_id={{ $entry->grouping_type->id }}"><i class="fa fa-angle-double-left"></i> {{ trans('general.back_to_all_groupings') }} <span>{{ $entry->grouping_type->description }}</span></a><br><br>
		@endif

		@include('crud::inc.grouped_errors')

		  <form method="post"
		  		action="{{ url($crud->route.'/'.$entry->getKey()) }}"
				@if ($crud->hasUploadFields('update', $entry->getKey()))
				enctype="multipart/form-data"
				@endif
		  		>
		  {!! csrf_field() !!}
		  {!! method_field('PUT') !!}

		  <div class="box box-primary" style="border-top-color: {{ $entry->grouping_type->background_color }} !important; border-top-width: 3px;">
		    <div class="box-header with-border">
				{{-- @if ( $entry->account_id > 0 ) --}}
					{{-- <span><b>{{ trans('general.account') }}:&nbsp</b>{!! $entry->account->getShowAccountLink() !!}&nbsp;</span> --}}
					<div class="row">
						<div class="col-md-8">
							@if ( $entry->account_id > 0 )

							{{-- ****************ACCOUNT*************** --}}
							<h2 class="name text-light-blue">{!! $entry->account->getShowAccountLink() !!}</h2>
							@endif
						</div>
						<div class="button-tools  col-md-4">
							<!-- Delete button -->
							@includeif('vendor.backpack.crud.buttons.delete', [
								'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/grouping').'/'.$entry->id,
								'custom_button_attributes' => "  title='Delete grouping' delete-id='$entry->id' ",
								'custom_button_class' => " pull-right  del-confirmgrouping"
							])

							<!-- Edit button -->
							@includeif('vendor.backpack.crud.buttons.update', [
								'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/grouping').'/'.$entry->id.'/edit_group',
								'custom_button_attributes' => " id='btn_edit_grouping' title='".trans('backpack::crud.edit')." ".trans('informacrm.grouping')."'  style='margin-right: 3px;' ",
								'custom_button_class' => " pull-right "
							])
						</div>

					</div>
				{{-- @else --}}
					{{-- <span><b>{{ trans('general.account') }}:&nbsp</b>{{ trans('general.no_account') }}&nbsp;</span> --}}
					{{-- <h1 class="name text-light-blue">{!! $entry->account->getShowAccountLink() !!}</h1> --}}
				{{-- @endif --}}
				<div class="row">
					<div class="col-md-12">
						{{-- ****************STATUS*************** --}}
						@if ( isset($entry->grouping_status) )
							<span class="label label-default" style="background-color:{{ $entry->grouping_status->background_color }}; color:{{ $entry->grouping_status->color }}">{{ $entry->grouping_status->description }}</span>
						@endif
					</div>
				</div>
		    </div>
		    <div class="box-body display-flex-wrap " style="display: flex;flex-wrap: wrap;">
				<div class="row col-md-12">
					{{-- ****************TITLE*************** --}}
					{{-- <div class="col-md-12"> --}}
						{{-- <div class="col-md-2">
							<h3>{{ trans('general.title') }}: </h3>
						</div> --}}
						<div class="col-md-12">
							@if ($crud->model->translationEnabled())
								<!-- Single button -->
								<div class="btn-group pull-right">
								  <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									{{trans('backpack::crud.language')}}: {{ $crud->model->getAvailableLocales()[$crud->request->input('locale')?$crud->request->input('locale'):App::getLocale()] }} <span class="caret"></span>
								  </button>
								  <ul class="dropdown-menu">
									@foreach ($crud->model->getAvailableLocales() as $key => $locale)
										<li><a href="{{ url($crud->route.'/'.$entry->getKey().'/edit') }}?locale={{ $key }}">{{ $locale }}</a></li>
									@endforeach
								  </ul>
								</div>
								{{-- <h3 class="box-title" style="line-height: 30px;">{{ trans('backpack::crud.edit') }}</h3> --}}
								<h3 class="box-title" style="line-height: 30px;">{{ $entry->title }}</h3>
							@else
								{{-- <h3 class="box-title">{{ trans('backpack::crud.edit') }}</h3> --}}
								<h3 class="box-title">{{ $entry->title }}</h3>
							@endif
						</div>
					{{-- </div> --}}
					{{-- <div class="col-md-12"> --}}
						{{-- <div class="col-md-2">
							<h4>{{ trans('general.description') }}: </h4>
						</div> --}}
						<div class="well col-md-12" style="padding: 2px;">
							<p>{!! $entry->description !!}</p>
						</div>
					{{-- </div> --}}
				</div>


		      <!-- load the view from the application if it exists, otherwise load the one in the package -->
		      {{-- @if(view()->exists('vendor.backpack.crud.form_content'))
		      	@include('vendor.backpack.crud.form_content', ['fields' => $fields, 'action' => 'edit'])
		      @else
		      	@include('crud::form_content', ['fields' => $fields, 'action' => 'edit'])
		      @endif --}}
		    </div><!-- /.box-body -->

            <div class="box-footer">
				<div class="tab-container col-md-12">
  			  	<div class="nav-tabs-custom" id="form_tabs">
  			  		<ul class="nav nav-tabs" role="tablist">
  			  			<li role="presentation" class="active">
  			  					<a href="#tab_information" aria-controls="tab_information" role="tab" data-toggle="tab" data-tab="tab_information">{{ trans('informacrm.information') }}</a>
  			  			</li>
  			  			{{-- <li role="presentation" class="">
  			  					<a href="#tab_actions" aria-controls="tab_actions" role="tab" data-toggle="tab">{{ trans('informacrm.actions') }}</a>
  			  			</li> --}}
						<li role="presentation" class="tab_actions_click">
								<a href="#tab_actions" data-dati="{{ url(config('backpack.base.route_prefix', 'admin') . '/grouping_tab_actions/'.$entry->id) }}" data-grouping_id="{{ $entry->id }}" data-tab="tab_actions" aria-controls="tab_actions" role="tab" data-toggle="tab">{{ trans('informacrm.actions') }}</a>
						</li>
  			  		</ul>
  			  	</div>
  			  </div>
			  <div class="tab-content col-md-12">
			  	<div role="tabpanel" class="tab-pane active" id="tab_information">

					<button id="show">+</button>
					Note interne
					{{-- @include('inf.grouping.thread', ['informations' => $entry]) --}}
					@php
						// $testModel = new App\Models\Groupings\Grouping_thread;

						// $testModel = Grouping_threadCrudController::groupingInternalNote();
						// dd($crud->create_fields['thread']);
						$internalNote['grouping_id'] = $entry->id;
						// dd($passFields);
					@endphp
					<div class="row hidden" id="insertInternalNote">
						@include('inf.grouping.thread', ['internalNote' => $internalNote])
					</div>
					<div class="row" id="refreshDetailsThread">

					</div>
			  	</div>
				<div role="tabpanel" class="tab-pane" id="tab_actions">
					{{-- @include('inf.accounts.tabs.actions', ['actions' => $entry->actions]) --}}
				</div>
				{{-- <div role="tabpanel" class="tab-pane" id="tab_actions">
			  		@include('inf.grouping.actions_timeline')
			  	</div> --}}
			  </div>
		    </div><!-- /.box-footer-->
			<div class="timeline-footer row">

			</div>
		  </div><!-- /.box -->


		  </form>
	</div>
</div>

<script src="{{ asset('vendor/adminlte') }}/bower_components/jquery/dist/jquery.min.js"></script>
<script>
function readyFn( jQuery ) {
	var accountReturnURL = document.baseURI;
	var tabhash = accountReturnURL.split('#')[1];
	// console.log(tabhash);
	switch (tabhash) {
    case 'actions':
		// console.log('1');
        $('[data-tab="tab_actions"]').trigger("click");
        break;
    case 'information':
		// console.log('2');
		// $('#show').trigger("click");
		$('#internal_note_01').trigger('click');
		break;
	default:
		// console.log('3');
		$('#internal_note_01').trigger('click');
		// $('#show').trigger("click");
	}
}
$( window ).on( "load", readyFn );

$(document).ready(function(e) {

	$("#show").click(function(e){
		e.preventDefault();
		$("#insertInternalNote").toggleClass("hidden");
	});

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
				// $('#show').trigger("click");
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

$('[data-tab="tab_actions"]').click(function(e) {
	var grouping_id = $(this).attr('data-grouping_id');
	// console.log(grouping_id);
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
			// $('.btn_tab_action_filter').trigger("click");
		},
		error: function(result) {
			alert('error');
		}
	});
});
</script>
@endsection
