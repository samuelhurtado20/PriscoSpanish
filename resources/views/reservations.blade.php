@extends('layouts.dashboard')

@push('csss')
<link rel="stylesheet" href="fullcalendar-2.6.1/fullcalendar.min.css"/>
@endpush

@section('content')

<div style="min-height:1.2em;"></div>

<div class="content">

    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h1>Reservations</h1>
        </div>
        
    </div>
    
    <div class="row">
        
        <div class="col-md-3 col-md-offset-1">
            <div>
                <?php
                /*
                   // con este codigo se iran revisando una a una las variables
                   // devueltas por paypal para mostrar un mensaje al usuario
                   success
                   error
                @if (session('error'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                */
                ?>

                @if (session('error'))
                    <div class="alert alert-failure">
                        {{ session('status') }}
                    </div>
                @endif

                 @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <h2>{{$ofertas->nombre}}</h2>
                <div class="reservation-step">
                    <h3>Step1:</h3>
                    <p>
                         Choose your package
                    </p>    
                </div>
                

                    <form action="{{url('payment')}}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="lesson1price" id="lesson1price" value="{{$ofertas->precio_individual_20}}">
                        <input type="hidden" name="lesson1price" id="lesson2price" value="{{$ofertas->precio_individual_60}}">
                        <input type="hidden" name="lesson1price" id="lesson3price" value="{{$ofertas->precio_paquete_b}}">
                                                                                
                        {{--campos de objeto Oferta: id, usuario, idioma, nombre, descripcion, precio_individual_20, precio_individual_30, precio_individual_60, precio_paquete_a, precio_paquete_b, created_at, updated_at--}}
                        <input type="hidden" name="offer" value="{{$ofertas->id}}">
                        <div class="radio">
                          <label>
                            <input type="radio" name="lesson" id="lesson1" value="option1" data-max-events="1">

                                20 minutes Test Session {{$ofertas->precio_individual_20}} USD.
                          </label>
                        </div>

                        <div class="radio">
                          <label>
                            <input type="radio" name="lesson" id="lesson2" value="option2" data-max-events="1" checked>
                               60 minutes Learning Session {{$ofertas->precio_individual_60}} USD
                          </label>
                        </div>

                        <div class="radio">
                          <label>
                            <input type="radio" name="lesson" id="lesson3" value="option3" data-max-events="5">
                                5 x 60 minutes Lessons Package {{$ofertas->precio_paquete_b}} USD
                          </label>
                        </div>

                        <input type="submit" class="btn btn-primary " value="Buy Now!">
                    </form>
            </div>
            
            <div class="reservation-step">
                <h3>Step2:</h3>
                <p>
                     Drag and drop your lessons to the Calendar on the right.
                </p>    
            </div>
            
            <div id='external-events'>
                    <h4>Sessions</h4>
                    <div id="event_60" class='fc-event event_60' data-duration="00:60" data-color="#0f0" >60 Minutes</div>
                    <div id="event_20" class='fc-event event_20' data-duration="00:20" data-color="#00f">20 Minutes</div>
                    <p>
                        <input type='checkbox' id='drop-remove' />
                        <label for='drop-remove'>remove after drop</label>
                    </p>
            </div>
            
            <div>
                <h4>Selected Sessions</h4>
                <p>
                    These are your selected sessions, you can remove them by using
                    the button on the right and jum to the event by clicking the
                    event date.
                </p>
                <div>
                    <ul id="selectedSessions">

                    </ul>
                    
                </div>
            </div>
            
        </div>
        <div class="col-md-6 c">
            <div>
                {!! $calendar->calendar() !!}
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script src="fullcalendar-2.6.1/lib/jquery-ui.custom.min.js"></script>
    <script src="fullcalendar-2.6.1/lib/moment.min.js"></script>
    <script src="fullcalendar-2.6.1/fullcalendar.js"></script>
    
    
    <script type="text/javascript">
     var ps_calendar_EventReceiveHandler;
     //para pruebas $('.fc-event').each(function(index,item){ console.log($(item).data()); });   
    $(document).ready(function() {
        var CALENDAR_ID = '#calendar-{!! $calendar->getId() !!}';
        //var today = new moment();
        //var max_date = (new moment()).add(90,'days');
        
       // console.log(today.format(),' ',max_date.format() );
        
        $('#external-events .fc-event').each(function() {

                // store data so the calendar knows to render an event upon drop
                var event_color = $(this).data('color');
                $(this).data('event', {
                        title: $.trim($(this).text()), // use the element's text as the event title
                        stick: true, // maintain when user navigates (see docs on the renderEvent method)
                        allDay:false,
                        overlap:false,
                        durationEditable:false,
                        //defaultTimedEventDuration:{minutes:2},
                        //end:'T02:00:00',
                        forceEventDuration:true,
                        color:event_color,
                        //start:temp_time.format(),
                        //end:temp_time.add(30,'minutes').format()
                });

                // make the event draggable using jQuery UI
                $(this).draggable({
                        zIndex: 999,
                        revert: true,      // will cause the event to go back to its
                        revertDuration: 0,  //  original position after the drag
                });

               
               if(!$(this).hasClass('event_60')){
                   $(this).hide();
               }
        });
        
        $('#lesson2').click(function(e){
            $('#event_20').hide();
            $('#event_60').show();
        });
        $('#lesson3').click(function(e){
            $('#event_20').hide();
            $('#event_60').show();
        });
        $('#lesson1').click(function(e){
            $('#event_60').hide();
            $('#event_20').show();
        });
        
        $('input:radio[name="lesson"]').change(
            function(){
                $(CALENDAR_ID).fullCalendar('removeEvents',function(eventObj){
                    return 'undefined'===typeof(eventObj.id);
                });
                $('#selectedSessions').empty();
            }
        );

        ps_calendar_EventReceiveHandler = function(event){
            
            var eventosDia = $(CALENDAR_ID).fullCalendar("clientEvents",
                function(evob){ return evob.rendering !='background' &&  (event.start.format("YYYYMMDD") === evob.start.format("YYYYMMDD")); }
            );
            var eventosTotales = $(CALENDAR_ID).fullCalendar("clientEvents",
                function(evob){ return evob.rendering !='background'; }
            );
    
    
                {{--
                   //--------------------------------
                   //  verificar si se ha alcanzado el limite de eventos para el caso
                   // del paquete de 5 eventos o de 1 evento de 60 minutos o de 20 minutos
                --}}
                var selected_sessions = $("#selectedSessions li").length; 
                var max_sessions = $(':radio[name="lesson"]:checked').data("max-events");     
                //console.log(" selected-sessions:", selected_sessions, " max-sessions:" ,max_sessions, " eventos.lenght:",eventosDia.length);
                {{--  permitir solo el numero de eventos del paquete elegido --}}
                //var calEvents = $(CALENDAR_ID).fullCalendar("clientEvents").length;
                var calEvents = eventosTotales.length;
                if( calEvents > max_sessions){
                    $(CALENDAR_ID).fullCalendar("removeEvents",event._id); 
                    return;
                }
                {{--   Permitir solo un evento por dia --}}
                  if( eventosDia.length >1){
                    $(CALENDAR_ID).fullCalendar("removeEvents",event._id); 
                  }else{
                    var sd = event.start.format("YYYY-MM-DD") ;
                    var st = event.start.format("h:mm:ss a"); 
                    var et = event.end.format("h:mm:ss a"); 
                    //console.log(sd,st,et,event._id);
                    var link_id= "ev_" + event._id;
                    var remov_id= "rm_" + event.start.format("YYYYMMDD");
                    var c = "<span>" + sd  + "</span>";
                        c += "<span>" + st + " - " + et  + "</span>";
                    var btn = "<button id=\""+ remov_id +"\" data-ev=\"" + event._id + "\"   type=\"button\" class=\"btn btn-default\" aria-label=\"Left Align\"><span class=\"glyphicon glyphicon-remove-sign\" aria-hidden=\"true\"></span></button>"; 
                    var cont = "<a id=\"" + link_id + "\"data-ev-date=\""+  event.start +"\" data-ev=\"" + event._id + "\"  href=\"#\">"+
                            c +"</a>" + btn;
                      $("#selectedSessions").append("<li>"+ cont  +"</li>"); 
                      $("#"+link_id).click(function(e){
                           e.preventDefault();
                //console.log("click a: ",$(this));'
                          $(CALENDAR_ID).fullCalendar( "gotoDate", $(this).data("ev-date") );
                       }); 
                      $("#"+remov_id).click(function(e){
                            e.preventDefault();
                           $(CALENDAR_ID).fullCalendar( "removeEvents", $(this).data("ev") );
                            $(this).parent("li").remove();
                       }); 
                  }
                }
        
    });            
    </script>
    {!! $calendar->script() !!}
@endpush