<div class="row col-md-12">
    <div class="note col-md-12" style="padding-bottom: 15px;">
        @if ( $entry->notes == "" )

        @else
            <div class="well" style="padding: 1px 1px 1px 10px; margin-bottom: 0px;">
                <p>{!! $entry->notes !!}</p>
            </div>
        @endif
    </div>
    <div class="row col-md-12">
        <div class="form-group col-md-6">
            <div class="form-group col-md-6">
                <label>{{ trans('informacrm.vat_number') }}:</label>
            </div>
            <div class="form-group col-md-6">
                <p>{{ $entry['vat_number'] }}</p>
            </div>
        </div>
        <div class="form-group col-md-6">
            <div class="form-group col-md-6">
                <label>{{ trans('informacrm.fiscal_code') }}:</label>
            </div>
            <div class="form-group col-md-6">
                <p>{{ $entry['fiscal_code'] }}</p>
            </div>
        </div>
    </div>
</div>
