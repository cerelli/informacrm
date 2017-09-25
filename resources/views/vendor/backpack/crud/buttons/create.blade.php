{{-- {{ dd($crud->hasAccess('create')) }} --}}
@if ($crud->hasAccess('create'))
	@php
		$url = '';
		$attributes = '';
		$class = '';
		if ( !isset($custom_button_url) ) {
			$url = url($crud->route.'/create');
		} else {
			if ( isset($custom_button_url) ) {
				$url = $custom_button_url;
			}
		}
		if ( !isset($custom_button_attributes) ) {
			$attributes = '';
		} else {
			if ( isset($custom_button_attributes) ) {
				$attributes = $custom_button_attributes;
			}
		}
		if ( !isset($custom_button_class) ) {
			$class = ' class="btn btn-primary ladda-button" ';
		} else {
			if ( isset($custom_button_class) ) {
				$class = ' class="btn btn-primary ladda-button '.$custom_button_class.'"';
			}
		}

	@endphp
{{-- {{ dump(isset($custom_button_class)) }} --}}
	<a href="{!! $url !!}" {!! $class !!} data-style="zoom-in" {!! $attributes !!}>
		<span class="ladda-label">
			<i class="fa fa-plus"></i>
			@if ( Config::get('settings.create_button_label') == '0') {{ trans('backpack::crud.add') }} {{ $crud->entity_name }}@endif
		</span>
	</a>

{{--


	<a href="{!! $custom_button_url !!}" {!! $class !!} data-button-type="delete" {!! $attributes !!}><i class="fa fa-trash"></i>
		@if ( Config::get('settings.create_button_label') == '0') {{ trans('backpack::crud.add') }}@endif
	</a>



	@if ( !isset($custom_button_url) )
		<a href="{{ url($crud->route.'/create') }}" class="btn btn-primary ladda-button" data-style="zoom-in"><span class="ladda-label"><i class="fa fa-plus"></i>
			@if ( Config::get('settings.create_button_label') == '0') {{ trans('backpack::crud.add') }} {{ $crud->entity_name }}@endif
		</span></a>
	@else
		<a href="{!! $custom_button_url !!}" class="btn btn-primary ladda-button" data-style="zoom-in"><span class="ladda-label"><i class="fa fa-plus"></i>@if ( Config::get('settings.create_button_label') == '0') {{ trans('backpack::crud.add') }} {{ $crud->entity_name }}@endif
		</span></a>
	@endif --}}
@endif
