
/**
 * Codigo propiedad de PriscoSpanish
 * todos los derechos reservados
 *  enviar opciones de sesion de clases a la base de datos.
 */
 jQuery( document ).ready(function(){
 		
 
	/* carga del calendario */
	function calendarLoad(params){
		$.ajax({
            	type: "GET",
            	url: "./calendar/calendar.php"+params, 
            	dataType: 'html',
            	success: function(msg){
            		$("#booking_calendar").html(msg)
            		calendarInit()
            	},
            	error: function(){
               	 	$("#horario").html("Please try again later")
            	}
        	})
	}
	
	function calendarInit(){
			$('#calendar-back').click(function(e){
				  e.preventDefault()
				  calendarLoad($(this).attr('href'))
			})
			
			$('#calendar-forward').click(function(e){
				  e.preventDefault()
				  calendarLoad($(this).attr('href'))
			})
			
			$('#outer_calendar .green, #outer_calendar .part_booked').each(function(index,item){
			    $(this).click(function(e){
			    	e.preventDefault()
			    	//console.log($(this).attr('href'));
			    	calendarLoad($(this).attr('href'))
			    })
			})
			
			$('#calendar_script').remove();
    		$.getScript("./calendar/calendar.js", function() {
      			$('script:last').attr('id', 'calendar_script')
    		});
			
	}
	
    	
    calendarLoad('')
      

})