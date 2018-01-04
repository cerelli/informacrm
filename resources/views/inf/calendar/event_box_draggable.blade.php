
            <div class="box-header with-border">
              <h4 class="box-title">{{ trans('informacrm.event_types') }}</h4>
            </div>
            <div class="box-body">
              <!-- the events type-->
              @php
                  $event_types = App\Models\Event_type::all();
                //   dd($event_types);
              @endphp
               <div id="external-events">
              @foreach ($event_types as $event_type)
                      <div class="external-event ui-draggable ui-draggable-handle" style="background-color: {{ $event_type->background_color }}; border-color: rgb(0, 166, 90); color: {{ $event_type->color }}; position: relative;"><span class="fa {{ $event_type->icon }}"></span> {!! $event_type->description !!}                      </div>
              @endforeach
              {{-- <div id="external-events"><div class="external-event ui-draggable ui-draggable-handle" style="background-color: rgb(0, 166, 90); border-color: rgb(0, 166, 90); color: rgb(255, 255, 255); position: relative;">prova</div>
                <div class="external-event bg-green ui-draggable ui-draggable-handle" style="position: relative; z-index: auto;  right: auto; height: 30px; bottom: auto; left: 0px; top: 0px;">Lunch</div>
                <div class="external-event bg-yellow ui-draggable ui-draggable-handle" style="position: relative;">Go home</div>
                <div class="external-event bg-aqua ui-draggable ui-draggable-handle" style="position: relative;">Do homework</div>
                <div class="external-event bg-light-blue ui-draggable ui-draggable-handle" style="position: relative;">Work on UI design</div>
                <div class="external-event bg-red ui-draggable ui-draggable-handle" style="position: relative;">Sleep tight</div>
 --}}

                {{-- <div class="checkbox">
                  <label for="drop-remove">
                    <input type="checkbox" id="drop-remove">
                    remove after drop
                  </label>
                </div> --}}
              </div>
            </div>
            <!-- /.box-body -->
