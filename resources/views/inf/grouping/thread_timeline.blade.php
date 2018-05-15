{{-- {{ $threads }} --}}


<div class="row" id="refreshDetailsOld" style="background-color: #ecf0f5;margin-top: 5px;">
<ul class="timeline" id="tab_actions_details" style="margin-top: 5px; margin-left: 5px;">
    {{-- {{ dd($threads) }} --}}
    @foreach ($threads as $thread)
        <!-- timeline item -->
        <li class="time-label">
            @if (isset($thread))
                @php
                    $title = ucwords(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $thread->created_at)->format('d/m/Y H:i').' ('.$thread->created_at->diffForHumans()).')'
                @endphp
                <span class="bg">
                    {{ $title }}
                </span>
            @else

            @endif
        </li>
        <li class='thread-li-{{ $thread->id }}'>
            <!-- timeline icon -->
            <i class="fa fa fa-comment bg bg-aqua"></i>
            <div class="timeline-item">
                <div class="row col-md-12" style="padding-bottom: 10px; padding-top: 5px;">

                </div>
                <div class="timeline-header col-md-12">
                    <!-- event types -->
                    {{ trans('general.created_by') }} {!! $thread->user_created_by['name'] !!}
                </div>
    
                <div class="timeline-body">
                    {!! $thread->description !!}
                </div>

                <div class="timeline-footer row">
                    <div class="row col-md-12" style="margin-left: 2px;">
                        <div class="pull-left" id="refresh_acud{{ $thread->id }}">
                            {{-- @include('inf.acud',['acud' => $action->acud]) --}}
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <!-- END timeline item -->
    @endforeach

</ul>
</div>
