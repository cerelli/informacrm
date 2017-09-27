@extends('backpack::layout')
@section('before_styles')
{{-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script> --}}
<link rel='stylesheet' href='{{ asset('vendor/adminlte/plugins/') }}/fullcalendar/fullcalendar.css' />
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/> --}}
{{-- <link rel='stylesheet' href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.min.css" />
<link rel='stylesheet' href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.print.css" /> --}}
@endsection

@section('after_style')
    {{-- href="{{ asset('vendor/adminlte/') }}/bootstrap/css/bootstrap.min.css" --}}
    {{-- <link rel='stylesheet' href='{{ asset('vendor/adminlte/plugins/') }}fullcalendar/fullcalendar.css' />
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src='{{ asset('vendor/adminlte/plugins/') }}fullcalendar/fullcalendar.js'></script> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/> --}}
@endsection

{{-- @section('content-header')
	<section class="content-header">
	  <h1>
	    {{ trans('backpack::crud.preview') }} <span>{{ $crud->entity_name }}</span>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="{{ url(config('backpack.base.route_prefix'), 'dashboard') }}">{{ trans('backpack::crud.admin') }}</a></li>
	    <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
	    <li class="active">{{ trans('backpack::crud.preview') }}</li>
	  </ol>
	</section>
@endsection --}}

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="box box-solid">
                @include('inf.calendar.event_box_draggable')
            </div>
            <div class="box box-solid">
                @include('inf.calendar.event_box_statuses')
            </div>

            {{-- <div class="box box-solid">
                        <div class="box-header with-border">
                          <h3 class="box-title">Create Event</h3>
                        </div>
                        <div class="box-body">
                          <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                            <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                            <ul class="fc-color-picker" id="color-chooser">
                              <li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
                              <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
                              <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
                              <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
                              <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
                              <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
                              <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
                              <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
                              <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
                              <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
                              <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
                              <li><a class="text-muted" href="#"><i class="fa fa-square"></i></a></li>
                              <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
                            </ul>
                          </div>
                          <!-- /btn-group -->
                          <div class="input-group">
                            <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                            <div class="input-group-btn">
                              <button id="add-new-event" type="button" class="btn btn-primary btn-flat">Add</button>
                            </div>
                            <!-- /btn-group -->
                          </div>
                          <!-- /input-group -->
                        </div>
                      </div> --}}
        </div>

      <div class="col-md-9">
          <div class="box box-primary">
              <div class="box-body no-padding">
                  <!-- THE CALENDAR -->
                  {!! $calendar->calendar() !!}
              </div>
          </div>
      </div>
    </div>
@endsection


@section('after_styles')
	<link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/crud.css') }}">
	<link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/show.css') }}">
@endsection

@section('after_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.min.js"></script>
    {!! $calendar->script() !!}
@endsection
