@extends('layouts.dashboard')
@section('content')
<div style="min-height:1.2em;"></div>

<div class="row">
    <div class="col-md-10 col-md-offset-1">
        @include('dashboard.teacher-sessions-offers',['oferta_sesiones' => $oferta_sesiones])
    </div>
</div>


<div class="row">
    <div class="col-md-4 col-md-offset-1">
        <div id='external-events'>
            <h4>Not available time.</h4>
            <h3>Instructions</h3>
            <ul>
               <li>drag and drop the time block below, to the date you will be 
               <strong>UNAVAILABLE</strong>.</li>
               <li>You can drag the bottom of the time block to adjust duration.</li>
               <li>Remember: you are filling the times when you will not work.</li>
               <li>You can  fill up to 3 months in advance.</li>
            </ul>
           
            <div id="event_na" class='fc-event event_na' data-duration="02:00" data-color="#0f0" >Unavailable</div>
        </div>

    </div>
    <div class="col-md-6">
       @include('dashboard.teacher-availability-calendar',['calendar' => $calendar])
    </div>
</div>

<div class="row">
    <div class="col-md-10 col-md-offset-1">
        @include('dashboard.teacher-sesiones',['sesiones_profesor'=>$sesiones_profesor])
    </div>
</div>


@endsection

@push('scripts')
    <script src="js/ps_profesor.js"></script>
@endpush
