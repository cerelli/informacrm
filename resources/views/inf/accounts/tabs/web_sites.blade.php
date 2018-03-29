<!-- Create button -->
@includeif('vendor.backpack.crud.buttons.create', [
    'custom_button_url' => url(config('backpack.base.route_prefix', 'admin').'/account/'.$entry->id.'/web_site/create'),
    'custom_button_attributes' => " title='".trans('backpack::crud.add')." ".trans('informacrm.web_site')."' ",
    'custom_button_class' => ""
])
<hr>
@foreach ($web_sites->chunk(3) as $chunk)
    <div class="row">
        @foreach ($chunk as $web_site)
            <div class="col-md-4" id="web-site-panel-{{ $web_site->id }}">
                <div class="panel panel-primary panel-heading col-md-12" style="padding-left: 0px; padding-right: 0px; padding-bottom: 0px;">
                    <div class="row col-md-12" style="margin-left: 0px;margin-right: 0px;padding-left: 0px;padding-right: 0px;">
                        <div class="row col-md-12" style="margin-left: 0px;margin-right: 0px;padding-right: 0px;padding-left: 0px;">
                            <div class="panel-title col-md-9">
                                <p class="text-muted">
                                    {{ $web_site->web_site_type['description'] }}
                                </p>
                                <h3 class="profile-username">
                                    <a href="{!! $web_site->url !!}" target="_blank">{{ $web_site->url }}</a>
                                </h3>
                            </div>
                            <div class="col-md-3 button-tools" style="padding: 8px;">
                                <!-- Delete button -->
                                @includeif('inf.buttons.delete', [
                                    'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/account/'.$web_site->account_id.'/web_site').'/'.$web_site->id,
                                    'custom_button_attributes' => " title='Delete contact_detail' delete-id='$web_site->id' ",
                                    'custom_button_class' => " pull-right  del-confirmweb",
                                    'custom_button_class_name' => "del-confirmweb"
                                ])

                                <!-- Edit button -->
                                @includeif('vendor.backpack.crud.buttons.update', [
                                    'custom_button_url' => url(config('backpack.base.route_prefix', 'admin') . '/account/'.$web_site->account_id.'/web_site').'/'.$web_site->id.'/edit',
                                    'custom_button_attributes' => " title='Edit Web Site' style='margin-right: 3px;' ",
                                    'custom_button_class' => " pull-right "
                                ])
                            </div>
                        </div>
                        <div class="note col-md-12" style="padding-bottom: 15px;">
                            @if ( $web_site->notes == "" )

                            @else
                                <div class="well" style="padding: 1px 1px 1px 10px; margin-bottom: 0px;">
                                    <p>{!! $web_site->notes !!}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>          <!-- /.panel panel-primary contact-->
            </div> <!-- /#contact-panel.... -->
        @endforeach
    </div>
@endforeach
