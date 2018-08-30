@if ($crud->hasAccess('show'))
	@if (!$crud->model->translationEnabled())

	<!-- Single edit button -->
	<a href="{{ url($crud->route.'/'.$entry->getKey()) }}" class="btn btn-xs btn-info"><i class="fa fa-eye"></i>
		@if ( Config::get('settings.button_label') == '0') {{ trans('backpack::crud.preview') }}@endif </a>

	@else

	<!-- Edit button group -->
	<div class="btn-group">
	  <a href="{{ url($crud->route.'/'.$entry->getKey()) }}" class="btn btn-xs btn-info"><i class="fa fa-eye"></i> @if ( Config::get('settings.button_label') == '0') {{ trans('backpack::crud.preview') }}@endif </a>
	  <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    <span class="caret"></span>
	    <span class="sr-only">Toggle Dropdown</span>
	  </button>
	  <ul class="dropdown-menu dropdown-menu-right">
  	    <li class="dropdown-header">{{ trans('backpack::crud.preview') }}:</li>
	  	@foreach ($crud->model->getAvailableLocales() as $key => $locale)
		  	<li><a href="{{ url($crud->route.'/'.$entry->getKey()) }}?locale={{ $key }}">{{ $locale }}</a></li>
	  	@endforeach
	  </ul>
	</div>

	@endif
@endif
