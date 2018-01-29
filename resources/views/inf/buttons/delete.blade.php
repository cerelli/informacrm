{{-- @if ($crud->hasAccess('delete')) --}}
	@php
		$url = '';
		$attributes = '';
		$class = '';
		if ( !isset($custom_button_url) ) {
			// $url = url($crud->route.'/'.$entry->getKey());
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
			$class = ' class="btn btn-xs btn-danger " ';
		} else {
			if ( isset($custom_button_class) ) {
				$class = ' class="btn btn-xs btn-danger '.$custom_button_class.'"';
			}

		}

	@endphp
{{-- {{ dump($custom_button_url) }} --}}
	<a href='{!! $url !!}' {!! $class !!} data-button-type="delete" {!! $attributes !!}><i class="fa fa-trash"></i>
		@if ( Config::get('settings.button_label') == '0') {{ trans('backpack::crud.delete') }}@endif
	</a>

	{{-- @if ( !isset($custom_button_url) )
		<a href="{{ url($crud->route.'/'.$entry->getKey()) }}" class="btn btn-xs btn-danger" data-button-type="delete"><i class="fa fa-trash"></i>
			@if ( Config::get('settings.button_label') == '0') {{ trans('backpack::crud.delete') }}@endif
		</a>
	@else
		<a href="{!! $custom_button_url !!}" class="btn btn-xs btn-danger" data-button-type="delete" {!! $custom_button_attributes !!}><i class="fa fa-trash"></i>
			@if ( Config::get('settings.button_label') == '0') {{ trans('backpack::crud.delete') }}@endif
		</a>
	@endif --}}
{{-- @endif --}}
