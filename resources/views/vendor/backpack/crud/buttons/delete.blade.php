@if ($crud->hasAccess('delete'))
	<a href="{{ url($crud->route.'/'.$entry->getKey()) }}" class="btn btn-xs btn-danger" data-button-type="delete"><i class="fa fa-trash"></i>
	@if ( Config::get('settings.button_label') == '0')
		{{ trans('backpack::crud.delete') }}
	@else

	@endif
	</a>
@endif
