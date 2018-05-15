@if ($crud->hasAccess('revisions') && count($entry->revisionHistory))
    @if ( Config::get('settings.create_button_label') == '0' )
        <a href="{{ url($crud->route.'/'.$entry->getKey().'/revisions') }}" class="btn btn-xs btn-info ladda-button" data-style="zoom-in">
            <i class="fa fa-history"></i>
            {{ trans('backpack::crud.revisions') }}
        </a>
    @else
        <a href="{{ url($crud->route.'/'.$entry->getKey().'/revisions') }}" class="btn btn-xs btn-info ladda-button" data-style="zoom-in">
            <i class="fa fa-history"></i>
        </a>
    @endif
@endif
