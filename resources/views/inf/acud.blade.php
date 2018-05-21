{{-- <div class="pull-right"> --}}
{{-- {{ dd($acud) }} --}}
    <small>
        @if ( isset($acud['assigned_by']) )
            <strong>{{ trans('general.assigned_by') }}&nbsp</strong> {{ $acud['assigned_by'] }}&nbsp;
            @if ( isset($acud['assigned_to']) )
                {{ trans('general.to') }}&nbsp {{ $acud['assigned_to'] }}&nbsp;
                @if ( isset($acud['assigned_at']) )
                    {{-- <strong>{{ trans('general.aca_at') }}&nbsp</strong> {{ $crud->acud['assigned_at'] }}&nbsp; --}}
                    {{ trans('general.aca_at') }}&nbsp {{ $acud['assigned_at'] }}&nbsp;
                @endif
            @endif
        @else
            @if ( isset($acud['assigned_to']) )
                {{ trans('general.assigned_to') }}&nbsp {{ $acud['assigned_to'] }}&nbsp;
                @if ( isset($acud['assigned_at']) )
                    {{-- <strong>{{ trans('general.aca_at') }}&nbsp</strong> {{ $crud->acud['assigned_at'] }}&nbsp; --}}
                    {{ trans('general.aca_at') }}&nbsp {{ $acud['assigned_at'] }}&nbsp;
                @endif
            @endif
        @endif


        @if ( isset($acud['created_by']) )
            <strong>{{ trans('general.created_by') }}&nbsp</strong> {{ $acud['created_by'] }}&nbsp;
            @if ( isset($acud['created_at']) )
                {{ trans('general.aca_at') }}&nbsp{{ $acud['created_at'] }}&nbsp;
            @endif
        @endif


        @if ( isset($acud['updated_by']) )
            <strong>{{ trans('general.updated_by') }}&nbsp</strong> {{ $acud['updated_by'] }}&nbsp;
            @if ( isset($acud['updated_at']) )
                {{ trans('general.aca_at') }}&nbsp {{ $acud['updated_at'] }}&nbsp;
            @endif
        @endif
    </small>
{{-- </div> --}}
