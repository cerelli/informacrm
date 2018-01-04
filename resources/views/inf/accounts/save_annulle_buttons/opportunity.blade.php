<div class="box-footer">
    @php
    $call_url = Request::get('call_url');
    $call = Request::get('call');
    switch ($call) {
        case 'events_calendar':
            $var_annulle = config('backpack.base.route_prefix', 'admin') . '/'.$call_url;
            // $redirect_location = redirect(config('backpack.base.route_prefix', 'admin').'/'.$call_url);
            break;
        case 'account':
            $var_annulle = config('backpack.base.route_prefix', 'admin').'/'.$call_url.'#opportunities';
            break;
        default:
            $var_annulle = config('backpack.base.route_prefix', 'admin').'/'.$call_url.'#opportunities';
            break;
    }
    // $call_url = Request::get('call_url');
        // $var_annulle = config('backpack.base.route_prefix', 'admin') . '/'.$call_url;
        $crud->route = $var_annulle;
    @endphp
    {{-- @php
        $var_annulle = config('backpack.base.route_prefix', 'admin') . '/account/'.$entry->account_id.'#addresses';
        $crud->route = $var_annulle;
    @endphp --}}
    @include('crud::inc.form_save_buttons')
</div><!-- /.box-footer-->
