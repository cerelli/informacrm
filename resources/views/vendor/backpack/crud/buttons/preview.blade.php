@if ($crud->hasAccess('show'))
	<a href="{{ url($crud->route.'/'.$entry->getKey()) }}" class="btn btn-xs btn-info"><i class="fa fa-eye"></i>
	@if ( Config::get('settings.button_label') == '0')
		{{ trans('backpack::crud.preview') }}
	@else

	@endif
	</a>
@endif
