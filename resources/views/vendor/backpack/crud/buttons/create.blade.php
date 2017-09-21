@if ($crud->hasAccess('create'))
	@if ( !isset($custom_button_url) )
		@if ($crud->hasAccess('create'))
			<a href="{{ url($crud->route.'/create') }}" class="btn btn-primary ladda-button" data-style="zoom-in"><span class="ladda-label"><i class="fa fa-plus"></i>
				@if ( Config::get('settings.create_button_label') == '0') {{ trans('backpack::crud.add') }} {{ $crud->entity_name }}@endif
				</span></a>
		@endif
	@else
		@if ($crud->hasAccess('create'))
			<a href="{{ $custom_button_url }}" class="btn btn-primary ladda-button" data-style="zoom-in"><span class="ladda-label"><i class="fa fa-plus"></i>@if ( Config::get('settings.create_button_label') == '0') {{ trans('backpack::crud.add') }} {{ $crud->entity_name }}@endif
			</span></a>
		@endif
	@endif
@endif
