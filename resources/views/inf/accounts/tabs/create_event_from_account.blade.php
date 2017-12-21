@extends('backpack::layout')

@section('header')
	<section class="content-header">
	  <h1>
	    {{ trans('backpack::crud.add') }} <span>{{ $crud->entity_name }}</span>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="{{ url(config('backpack.base.route_prefix'), 'dashboard') }}">{{ trans('backpack::crud.admin') }}</a></li>
	    <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
	    <li class="active">{{ trans('backpack::crud.add') }}</li>
	  </ol>
	</section>
@endsection

@section('content')
	@php
		$active_account_id = Request::get('active_account_id');
		$active_opportunity_id = Request::get('active_opportunity_id');
		if ( isset($active_opportunity_id) ) {
			$crud->create_fields['inf_opportunity_id']['value'] = $active_opportunity_id;
		}
		$annulle = Request::get('annulle').'#'.Request::get('tab');
		// dump($annulle);
		$crud->create_fields['inf_account_id']['value'] = $active_account_id;
	@endphp
    {{-- {{ $crud->create_fields['inf_account_id']['default'] = Request::get('active_account_id') }} --}}
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<!-- Default box -->
		@if ($crud->hasAccess('list'))
			<a href="{{ url($crud->route) }}"><i class="fa fa-angle-double-left"></i> {{ trans('backpack::crud.back_to_all') }} <span>{{ $crud->entity_name_plural }}</span></a><br><br>
		@endif
		@include('crud::inc.grouped_errors')

		  {!! Form::open(array('url' => $crud->route, 'method' => 'post', 'files'=>$crud->hasUploadFields('create'))) !!}
		  <div class="box">
		    <div class="box-header with-border">
		      <h3 class="box-title">{{ trans('backpack::crud.add_a_new') }} {{ $crud->entity_name }}</h3>
		    </div>
		    <div class="box-body row">
				<!-- load the view from the application if it exists, otherwise load the one in the package -->
  		      @if(view()->exists('vendor.backpack.crud.form_content'))
  		      	@include('vendor.backpack.crud.form_content', [ 'fields' => $crud->getFields('create'), 'action' => 'create' ])
  		      @else
				  {{-- {{ dd($crud->getFields('create')) }} --}}
  		      	@include('crud::form_content', [ 'fields' => $crud->getFields('create'), 'action' => 'create' ])
  		      @endif
		    </div><!-- /.box-body -->
		    <div class="box-footer">
                @php
					$var_annulle = config('backpack.base.route_prefix', 'admin') . '/'.$annulle;
					$crud->route = $var_annulle;
				@endphp
				{{-- {{ dd($crud->route) }} --}}
                @include('crud::inc.form_save_buttons')

		    </div><!-- /.box-footer-->

		  </div><!-- /.box -->
		  {!! Form::close() !!}
	</div>
</div>
{{-- {{ dd($crud->create_fields['inf_account_id']) }} --}}
{{-- {{ dd($crud->request->inf_account_id) }} --}}
@endsection
