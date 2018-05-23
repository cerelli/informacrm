<small><i>
    @if ( isset($acud['assigned_by']) )
        {{ trans('general.assigned_by') }}&nbsp {{ $acud['assigned_by'] }}&nbsp;
        @if ( isset($acud['assigned_to']) )
            {{ trans('general.to') }}&nbsp {{ $acud['assigned_to'] }}&nbsp;
            @if ( isset($acud['assigned_at']) )
                {{ trans('general.aca_at') }}&nbsp {{ $acud['assigned_at'] }}&nbsp;
            @endif
        @endif
    @else
        @if ( isset($acud['assigned_to']) )
            {{ trans('general.assigned_to') }}&nbsp {{ $acud['assigned_to'] }}&nbsp;
            @if ( isset($acud['assigned_at']) )
                {{ trans('general.aca_at') }}&nbsp {{ $acud['assigned_at'] }}&nbsp;
            @endif
        @endif
    @endif


    @if ( isset($acud['created_by']) )
        {{ trans('general.created_by') }}&nbsp {{ $acud['created_by'] }}&nbsp;
        @if ( isset($acud['created_at']) )
            {{ trans('general.aca_at') }}&nbsp{{ $acud['created_at'] }}&nbsp;
        @endif
    @endif


    @if ( isset($acud['updated_by']) )
        {{ trans('general.updated_by') }}&nbsp {{ $acud['updated_by'] }}&nbsp;
        @if ( isset($acud['updated_at']) )
            {{ trans('general.aca_at') }}&nbsp {{ $acud['updated_at'] }}&nbsp;
        @endif
    @endif
</i></small>
