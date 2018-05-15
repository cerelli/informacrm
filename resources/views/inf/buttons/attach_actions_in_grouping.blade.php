{{-- {{ dd($crud->hasAccess('create')) }} --}}
{{-- @if ($crud->hasAccess('create')) --}}
	@php
		$url = '';
		$attributes = '';
		$class = '';
		$idCreateButton = '';
		if ( !isset($custom_button_class_name) ) {
			// $url = url($crud->route.'/'.$entry->getKey());
		} else {
			if ( isset($custom_button_class_name) ) {
				$idCreateButton = '.'.$custom_button_class_name;
			}

		}
		if ( !isset($custom_button_url) ) {
			// $url = url($crud->route.'/create');
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
	<a href="{!! $url !!}" {!! $class !!} data-style="zoom-in" {!! $attributes !!}>
		<span class="ladda-label">
			<i class="fa fa-link"></i>
			{{-- @if ( Config::get('settings.create_button_label') == '0') {{ trans('backpack::crud.add') }} {{ $crud->entity_name }}@endif --}}
		</span>
	</a>
