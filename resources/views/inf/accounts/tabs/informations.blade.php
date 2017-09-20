<div class="row">
    <div class="well" style="margin-left: 20px; margin-right: 20px;">
        <p>{!! $entry['notes'] !!}</p>
    </div>
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
