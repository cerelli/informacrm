<!-- Create button -->
@includeif('vendor.backpack.crud.buttons.create', [
    'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/action/create?active_account_id='.$entry->id).'&annulle=account/'.$entry->id.'&tab=actions',
    'custom_button_attributes' => " title='".trans('backpack::crud.add')." ".trans('informacrm.actions')."' ",
    'custom_button_class' => ""
])
<hr>
@foreach ($actions->chunk(2) as $chunk)
    <div class="row">
        @foreach ($chunk as $action)
            {!! $action->title !!}
        @endforeach
    </div>
@endforeach
