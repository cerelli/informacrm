{{-- @if ($crud->hasAccess('update')) --}}
	@php
		$url = '';
		$attributes = '';
		$class = '';

		if ( !isset($custom_button_url) ) {
			// $url = url($crud->route.'/'.$entry->getKey().'/edit');
		} else {
			if ( isset($custom_button_url) ) {
				// dump($custom_button_url);
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
			$class = ' class="btn btn-xs btn-warning " ';
		} else {
			if ( isset($custom_button_class) ) {
				$class = ' class="btn btn-xs btn-warning '.$custom_button_class.'"';
			}

		}

	@endphp
	<!-- Single edit button -->
	<a href="{!! $url !!}" {!! $class !!} {!! $attributes !!}><i class="fa fa-edit"></i>
		@if ( Config::get('settings.button_label') == '0') {{ trans('backpack::crud.edit') }}@endif
	</a>

	{{-- @if (!$crud->model->translationEnabled())

		<!-- Single edit button -->
		<a href="{!! $url !!}" {!! $class !!} {!! $attributes !!}><i class="fa fa-edit"></i>
			@if ( Config::get('settings.button_label') == '0') {{ trans('backpack::crud.edit') }}@endif
		</a>
	@else

	<!-- Edit button group -->
	<div class="btn-group">
	  <a href="{{ url($crud->route.'/'.$entry->getKey().'/edit') }}" class="btn btn-xs btn-warning">
		  <i class="fa fa-edit"></i>
		  {{ trans('backpack::crud.edit') }}
	  </a>

	  <button type="button" class="btn btn-xs btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    <span class="caret"></span>
	    <span class="sr-only">Toggle Dropdown</span>
	  </button>

	  <ul class="dropdown-menu dropdown-menu-right">
  	    <li class="dropdown-header">{{ trans('backpack::crud.edit_translations') }}:</li>
	  	@foreach ($crud->model->getAvailableLocales() as $key => $locale)
		  	<li><a href="{{ url($crud->route.'/'.$entry->getKey().'/edit') }}?locale={{ $key }}">{{ $locale }}</a></li>
	  	@endforeach
	  </ul>
	</div>

	@endif --}}
{{-- @endif --}}





{{-- <a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/contact').'/'.$contact->id }}/edit" class="btn btn-xs btn-default pull-right  " style="margin-right: 5px;">
	<i class="fa fa-edit"></i> {{ trans('backpack::crud.edit') }}
</a>


<!-- Single edit button -->
<a href="{{ url($crud->route.'/'.$entry->getKey().'/edit') }}" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i>
	@if ( Config::get('settings.button_label') == '0'){{ trans('backpack::crud.edit') }}@endif
	</a>
@else

<!-- Edit button group -->
<div class="btn-group">
  <a href="{{ url($crud->route.'/'.$entry->getKey().'/edit') }}" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i> {{ trans('backpack::crud.edit') }}</a>
  <button type="button" class="btn btn-xs btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	<span class="caret"></span>
	<span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu dropdown-menu-right">
	<li class="dropdown-header">{{ trans('backpack::crud.edit_translations') }}:</li>
	@foreach ($crud->model->getAvailableLocales() as $key => $locale)
		<li><a href="{{ url($crud->route.'/'.$entry->getKey().'/edit') }}?locale={{ $key }}">{{ $locale }}</a></li>
	@endforeach
  </ul>
</div> --}}
