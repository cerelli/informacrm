@extends('backpack::layout')

@section('header')
	<section class="content-header">
	  <h1>
	    {{ trans('backpack::crud.edit') }} <span>{{ $crud->entity_name }}</span>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="{{ url(config('backpack.base.route_prefix'),'dashboard') }}">{{ trans('backpack::crud.admin') }}</a></li>
	    <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
	    <li class="active">{{ trans('backpack::crud.edit') }}</li>
	  </ol>
	</section>
@endsection

@section('content')
	@php
		  $active_account_id=Request::get('active_account_id');
		  $active_contact_id=Request::get('active_contact_id');
		  $crud->create_fields['inf_contact_id']['value'] = $active_contact_id;
		  $this->crud->entry['active_account_id'] = $active_account_id;
	@endphp
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<!-- Default box -->
		{{-- $crud->route = {{ "config('backpack.base.route_prefix', 'admin') . '/account').'/'.$entry->inf_account_id.'#contacts'" }} --}}
		{{-- {{ dd($crud) }} --}}
		@if ($crud->hasAccess('list'))
			<a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/account').'/'.$active_account_id.'#contacts' }}"><i class="fa fa-angle-double-left"></i> {{ trans('backpack::crud.back_to_all') }} <span>{{ $crud->entity_name_plural }}</span></a><br><br>
		@endif

		@include('crud::inc.grouped_errors')

		  {!! Form::open(array('url' => $crud->route.'/'.$entry->getKey(), 'method' => 'put', 'files'=>$crud->hasUploadFields('update', $entry->getKey()))) !!}
		  <div class="box">
		    <div class="box-header with-border">
		    	@if ($crud->model->translationEnabled())
			    	<!-- Single button -->
					<div class="btn-group pull-right">
					  <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    {{trans('backpack::crud.language')}}: {{ $crud->model->getAvailableLocales()[$crud->request->input('locale')?$crud->request->input('locale'):App::getLocale()] }} <span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu">
					  	@foreach ($crud->model->getAvailableLocales() as $key => $locale)
						  	<li><a href="{{ url($crud->route.'/'.$entry->getKey().'/edit') }}?locale={{ $key }}">{{ $locale }}pp</a></li>
					  	@endforeach
					  </ul>
					</div>
					<h3 class="box-title" style="line-height: 30px;">{{ trans('backpack::crud.edit') }}</h3>
				@else
					<h3 class="box-title">{{ trans('backpack::crud.edit') }}</h3>
				@endif
		    </div>
		    <div class="box-body row">
		      <!-- load the view from the application if it exists, otherwise load the one in the package -->
		      @if(view()->exists('vendor.backpack.crud.form_content'))
		      	@include('vendor.backpack.crud.form_content', ['fields' => $fields, 'action' => 'edit'])
		      @else
		      	@include('crud::form_content', ['fields' => $fields, 'action' => 'edit'])
		      @endif
		    </div><!-- /.box-body -->

            <div class="box-footer">
				@php
					$var_annulle = config('backpack.base.route_prefix', 'admin') . '/account/'.$active_account_id.'#contacts';
					$crud->route = $var_annulle;
				@endphp
                @include('crud::inc.form_save_buttons')
				{{-- <a href="{{ url($crud->route) }}" class="btn btn-default"><span class="fa fa-ban"></span> &nbsp;{{ trans('backpack::crud.cancel') }}</a> --}}
		    </div><!-- /.box-footer-->
		  </div><!-- /.box -->
		  {!! Form::close() !!}
	</div>
</div>
@endsection
