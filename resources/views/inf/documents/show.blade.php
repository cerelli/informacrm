@extends('backpack::layout')

@section('header')
	<section class="content-header">
	  <h1>
		<i class="fa {{ $entry->document_type->icon }}"></i>
        <span class="text-capitalize">{{ $crud->entity_name }}: {{ $entry->document_type->description.' ['.$entry->id.']' }}</span>
		{{-- <div class="row col-md-12" style="margin-left: 2px;"> --}}

		{{-- </div> --}}
        {{-- <small>{{ trans('backpack::crud.edit').' '.$entry->grouping_type->description }}.</small> --}}
	  </h1>
	  <div class="pull-right" >
		  @include('inf.acud',['acud' => $acud])
	  </div>
	  <ol class="breadcrumb">
	    <li><a href="{{ url(config('backpack.base.route_prefix'),'dashboard') }}">{{ trans('backpack::crud.admin') }}</a></li>
	    <li><a href="{{ url($crud->route) }}?document_type_id={{ $entry->document_type->id }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
	    <li class="active">{{ trans('backpack::crud.edit') }}</li>
	  </ol>
	</section>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if ($crud->hasAccess('list'))
                <a href="{{ url($crud->route) }}"><i class="fa fa-angle-double-left"></i> {{ trans('backpack::crud.back_to_all') }} <span>{{ $crud->entity_name_plural }}</span></a><br><br>
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

         <div class="box box-primary" style="border-top-color: {{ $entry->document_type->background_color }} !important; border-top-width: 3px;">
           <div class="box-header with-border">
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
                               'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/document').'/'.$entry->id,
                               'custom_button_attributes' => "  title='Delete document' delete-id='$entry->id' ",
                               'custom_button_class' => " pull-right  del-confirmdocument"
                           ])

                           <!-- Edit button -->
                           @includeif('vendor.backpack.crud.buttons.update', [
                               'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/document').'/'.$entry->id.'/edit',
                               'custom_button_attributes' => " id='btn_edit_document' title='".trans('backpack::crud.edit')." ".trans('informacrm.document')."'  style='margin-right: 3px;' ",
                               'custom_button_class' => " pull-right "
                           ])
                       </div>

                   </div>
               <div class="row">
                   <div class="col-md-12">
                       {{-- ****************STATUS*************** --}}
                       <span class="label label-default" style="background-color:{{ $entry->document_status->background_color }}; color:{{ $entry->document_status->color }}">{{ $entry->document_status->description }}</span>
                   </div>
               </div>
           </div>
           <div class="box-body display-flex-wrap " style="display: flex;flex-wrap: wrap;">
               <div class="row col-md-12">
                   {{-- ****************DESCRIPTION*************** --}}
                       <div class="well col-md-12" style="padding: 2px;">
                           <p>{!! $entry->description !!}</p>
                       </div>
               </div>
           </div><!-- /.box-body -->
         </div><!-- /.box -->
		 <div class="box box-widget">
			 <div class="box-header with-border">
				 @includeif('inf.buttons.create', [
					 'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/document/'.$entry->id.'/attachment/create'),
					 'custom_button_attributes' => " title='".trans('backpack::crud.add')." ".trans('informacrm.attachment')."' style='margin-top: 0px;'",
					 'custom_button_class' => ""
				 ])
			 </div>
			 <div class="box-body">
				@foreach ($entry->attachments as $key => $value)
					<div class="attachment-block clearfix" id='attachment-block-{{ $value->id }}'>
						<div class="col-md-10">
							{!! $value->getShowTitleLink() !!} - {{ trans('general.version') }} {{ $value->version }}
						</div>
						<div class="col_md_2">
							<!-- Delete button -->
							@includeif('inf.buttons.delete', [
                                'custom_button_url' => url(config('backpack.base.route_prefix', 'admin').'/document').'/'.$entry->id.'/attachment/'.$value->id,
                                'custom_button_attributes' => "  title='Delete attachment' delete-id='$value->id' ",
                                'custom_button_class' => " pull-right  del-confirmattachment"
                            ])

							{{-- <!-- Edit button -->
							@includeif('vendor.backpack.crud.buttons.update', [
								'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/document').'/'.$entry->id.'/a',
								'custom_button_attributes' => " id='btn_edit_document' title='".trans('backpack::crud.edit')." ".trans('informacrm.document')."'  style='margin-right: 3px;' ",
								'custom_button_class' => " pull-right "
							]) --}}
						</div>
					</div>
				@endforeach
			 </div>
		</div>
         </form>
        </div>
    </div>
@endsection




    @section('after_styles')
    <link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/crud.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/show.css') }}">
    @endsection

    @section('after_scripts')
    <script src="{{ asset('vendor/backpack/crud/js/crud.js') }}"></script>
    <script src="{{ asset('vendor/backpack/crud/js/show.js') }}"></script>
	<script>
	$(document).ready(function () {
		$('.del-confirmattachment').click(function(e){
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
