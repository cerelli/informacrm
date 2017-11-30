<div class="m-t-10 m-b-10 p-l-10 p-r-10 p-t-10 p-b-10">
	<div class="row">
		<div class="col-md-12">
            <div class="panel-title col-md-12">
                @php
                    $title = trans('informacrm.opportunity_creation')." ". \Carbon\Carbon::parse($entry->created_at)->format('d/m/Y');
                    if ( isset($entry->expiration_date) ) {
                        $title .= " - ".trans('informacrm.opportunity_expiration_date')." ".\Carbon\Carbon::parse($entry->expiration_date)->format('d/m/Y');
                    } else {

                    }
                    $title .=  "<br>".trans('informacrm.opportunity_value').": ". number_format($entry->value, 2, ',', '.')." €.";
                @endphp
                <h3 class="profile-username col-md-9">
                    {!! $title !!}

                </h3>
            </div>
            <div class="note col-md-12" style="margin-top: 5px; padding-bottom: 15px;">
                <div class="well" style="padding: 1px 1px 1px 10px; margin-bottom: 0px;">
                    <p>{!! $entry->description !!}</p>
                </div>
                @if ( $entry->result_description == "" )

                @else
                    {!! '<br><span style="font-size: 80%; margin-right: 3px; color: '.$entry->opportunity_result->color.'; background-color: '.$entry->opportunity_result->background_color.'" class="label label-default">
                            <i class= "fa  '.$entry->opportunity_result->icon.'"></i> '.$entry->opportunity_result->description.'
                        </span><br>' !!}
                    <div class="well" style="padding: 1px 1px 1px 10px; margin-bottom: 0px;">
                        <p>{!! $entry->result_description !!}</p>
                    </div>
                @endif

                {{-- <hr style="margin-bottom: 2px;margin-top: 2px; border-color: #0016f5;"> --}}
            </div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
