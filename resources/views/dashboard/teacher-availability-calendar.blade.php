@push('csss')
<link rel="stylesheet" href="fullcalendar-2.6.1/fullcalendar.min.css"/>
@endpush

<h1>Availability Calendar</h1>
<hr>
<div>
    {{-- para scripts ver teacher.blade.php --}}
    {!! $calendar->calendar() !!}
</div>
@push('scripts')

    <script src="fullcalendar-2.6.1/lib/jquery-ui.custom.min.js"></script>
    <script src="fullcalendar-2.6.1/lib/moment.min.js"></script>
    <script src="fullcalendar-2.6.1/fullcalendar.js"></script>
    
    
    <script type="text/javascript">
    var ps_calendar_EventDropHandler;
    var ps_calendar_EventResizeHandler;
    var ps_calendar_EventReceiveHandler;
    var ps_calendar_EventRenderHandler;
    
    $(document).ready(function() {
        var CALENDAR_ID = '#calendar-{!! $calendar->getId() !!}';
        $('#external-events .fc-event').each(function() {

                // store data so the calendar knows to render an event upon drop
                var event_color = $(this).data('color');
                $(this).data('event', {
                        title: $.trim($(this).text()), 
                        stick: true, 
                        allDay:false,
                        overlap:false,
                        durationEditable:true,
                        forceEventDuration:true,
                        color:event_color,
                });

                $(this).draggable({
                        zIndex: 999,
                        revert: true,      // will cause the event to go back to its
                        revertDuration: 0,  //  original position after the drag
                });

        });
        
        $("input#events_na").click(function(e){
            e.preventDefault();
            saveCalendarEvents();
        });
        
        ps_calendar_EventDropHandler = function (event, delta, revertFunc, jsEvent, ui, view){
            saveCalendarEvent(event);
        };
        
        ps_calendar_EventResizeHandler = function( event, delta, revertFunc, jsEvent, ui, view ) { 
            saveCalendarEvent(event);
        };
        
        ps_calendar_EventReceiveHandler = function( event, delta, revertFunc, jsEvent, ui, view ) { 
            saveCalendarEvent(event);
        };
        
        ps_calendar_EventRenderHandler =  function(event, element, view ) {
            var a = element.append( "<span class='closeon glyphicon glyphicon-remove'></span>" );
            $(a).click(function() {
               $(CALENDAR_ID).fullCalendar('removeEvents',event._id);
               removeCalendarEvent(event);
            });
        };
        
        
        function saveCalendarEvent(event){
            
            var eventData = {
                    id:     event.id,
                    title:  event.title,
                    start:  event.start.format('YYYY-MM-DD HH:MM:SS'),
                    end:    event.end.format('YYYY-MM-DD HH:MM:SS'),
                    allDay: event.allDay,
                };
            var postData= {_token: $(':input[name="_token"]').val() ,evento:JSON.stringify(eventData)};    

            $.ajax({
            	type: "POST",
            	url: "postSaveEvent", 
            	data: postData,
            	success: function(msg){
                    if($.isNumeric(msg)){
                        event.id=msg;
                    }
                        //console.log(msg);
                	 //$('#ps_editar_session_modal').modal('hide');
                         // location.reload();
            	},
            	error: function(msg){
            	   var o = msg.responseJSON;
            	   if( msg.status === 422 ) {  
            	     $.each( o, function( key, value ) {
            	         $('#' + key ).parent('div').removeClass('has-error');
            	         $('#' + key +' + span').text('');
 
                	     $('#' + key ).parent('div').addClass('has-error'); 
                	     $('#' + key +' + span').text(value[0]);
                     });
                  }
            	}
            });	//ajax    
        }
        
        
        function saveCalendarEvents(){
            var clientevents =  $(CALENDAR_ID).fullCalendar( 'clientEvents');
            var ev_ar=[];
            for(var i=0;i<clientevents.length;i++){
                var eventData = {
                                    id: clientevents[i].id,
                                    title: clientevents[i].title,
                                    start: clientevents[i].start.format('YYYY-MM-DD HH:MM:SS'),
                                    end:   clientevents[i].end.format('YYYY-MM-DD HH:MM:SS'),
                                    allDay: clientevents[i].allDay,
                                }

                ev_ar.push(eventData);
            }

            var postData= {_token: $(':input[name="_token"]').val() ,events:JSON.stringify(ev_ar)};
            console.log(postData);

            $.ajax({
            	type: "POST",
            	url: "postSaveEvents", 
            	data: postData,
            	success: function(msg){
                    //console.log(msg);
                	 //$('#ps_editar_session_modal').modal('hide');
                         // location.reload();
            	},
            	error: function(msg){
            	   var o = msg.responseJSON;
            	   if( msg.status === 422 ) {  
            	     $.each( o, function( key, value ) {
            	         $('#' + key ).parent('div').removeClass('has-error');
            	         $('#' + key +' + span').text('');
 
                	     $('#' + key ).parent('div').addClass('has-error'); 
                	     $('#' + key +' + span').text(value[0]);
                     });
                  }
            	}
            });	//ajax
        }
    
        function removeCalendarEvent(event){
            var eventData = {
                    id:     event.id,
                    title:  event.title,
                    start:  event.start.format('YYYY-MM-DD HH:MM:SS'),
                    end:    event.end.format('YYYY-MM-DD HH:MM:SS'),
                    allDay: event.allDay,
                };
            var postData= { _token: $(':input[name="_token"]').val() ,
                            evento:JSON.stringify(eventData)};    

            $.ajax({
            	type: "POST",
            	url: "postRemoveEvent", 
            	data: postData,
            	success: function(msg){
                    //console.log(msg);
                	 //$('#ps_editar_session_modal').modal('hide');
                         // location.reload();
            	},
            	error: function(msg){
            	   var o = msg.responseJSON;
            	   if( msg.status === 422 ) {  
            	     $.each( o, function( key, value ) {
            	         $('#' + key ).parent('div').removeClass('has-error');
            	         $('#' + key +' + span').text('');
 
                	     $('#' + key ).parent('div').addClass('has-error'); 
                	     $('#' + key +' + span').text(value[0]);
                     });
                  }
            	}
            });	//ajax    
        }
    });
    </script>
    {!! $calendar->script() !!}
@endpush    


