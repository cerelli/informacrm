<!-- Delete button -->
@includeif('inf.buttons.delete', [
    'custom_button_url' => url(config('backpack.base.route_prefix', 'admin').'/document').'/'.$attachment->document_id.'/attachment/'.$attachment->id,
    'custom_button_attributes' => "  title='Delete attachment' delete-id='$attachment->id' ",
    'custom_button_class' => " pull-right  del-confirmattachment ".$attachment->deleteButton
])
@includeif('inf.buttons.attachment_unlock', [
    'custom_button_url' => url(config('backpack.base.route_prefix', 'admin').'/document').'/'.$attachment->document_id.'/attachment_unlock/'.$attachment->id,
    'custom_button_attributes' => "  title='".trans('general.attachment_unlock')."' id='$attachment->id' style='margin-right: 3px;'",
    'custom_button_class' => " pull-right  unlock-attachment lock-".$attachment->id." ".$attachment->unlockButton
])
@includeif('inf.buttons.attachment_lock', [
    'custom_button_url' => url(config('backpack.base.route_prefix', 'admin').'/document').'/'.$attachment->document_id.'/attachment_lock/'.$attachment->id,
    'custom_button_attributes' => "  title='".trans('general.attachment_lock')."' id='$attachment->id' style='margin-right: 3px;'",
    'custom_button_class' => " pull-right  lock-attachment unlock-".$attachment->id." ".$attachment->lockButton
])


{{-- <!-- Edit button -->
@includeif('vendor.backpack.crud.buttons.update', [
    'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/document').'/'.$entry->id.'/a',
    'custom_button_attributes' => " id='btn_edit_document' title='".trans('backpack::crud.edit')." ".trans('informacrm.document')."'  style='margin-right: 3px;' ",
    'custom_button_class' => " pull-right "
]) --}}
