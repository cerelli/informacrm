<div class="box-header with-border">
  <h4 class="box-title">{{ trans('informacrm.event_statuses') }}</h4>
</div>
<div class="box-body">
  <!-- the event statuses-->
  @php
      $event_statuses = App\Models\Event_status::all();
  @endphp
   <div id="external-events">
  @foreach ($event_statuses as $event_status)
    <div class="external-event ui-draggable ui-draggable-handle" style="background-color: {{ $event_status->background_color }}; border-color: rgb(0, 166, 90); color: {{ $event_status->color }}; position: relative;"><span class="fa {{ $event_status->icon }}"></span> {!! $event_status->description !!}
    </div>



  @endforeach
  </div>
</div>
{{-- </div> --}}
