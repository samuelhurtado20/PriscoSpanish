
/**
 * Codigo propiedad de PriscoSpanish
 * todos los derechos reservados
 */
 jQuery( document ).ready(function(){

     $('#agregar_sesion').click(function(){
            $('input#submit').unbind('click');
            $("input#submit").click(function(){
 		    
                $.ajax({
                    type: "POST",
                    url: "postAddSession", 
                    data: $('#accion_editar_sesion').serialize(),
                    success: function(msg){
                             $('#ps_editar_session_modal').modal('hide');
                              location.reload();
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
                });	
        });
         
     });
        
        
        $('a.editar_sesion').each(function(index,item){
          
          $(item).click(function(event){
                event.preventDefault();
                var ps_post_data={'id':$(this).data('id'),
                    '_token':$('input[name="_token"]').val()};

                
                $.ajax({
                    type: "POST",
                    url: "postGetSessionOffer", 
                    data: ps_post_data,
                    success: function(msg){
                           
                            var o =$.parseJSON(msg);
                            $('input[name="sesion_n"]').val(o.id);
                            $('#input_nombre_sesion').val(o.nombre);
                            $('#input_descripcion_sesion').val(o.descripcion);
                            $('#input_precio_sesion').val(o.precio_individual_20);
                            $('#input_precio_sesion_1').val(o.precio_individual_30);
                            $('#input_precio_sesion_2').val(o.precio_individual_60);
                            $('#input_precio_sesion_paquete_1').val(o.precio_paquete_a);
                            $('#input_precio_sesion_paquete_2').val(o.precio_paquete_b);
                            $("#input_idioma_sesion").val(o.idioma);
                            $('input#submit').unbind('click');
                            $('input#submit').click(function(e){
                                e.preventDefault();
                                var t = $('#accion_editar_sesion').serializeArray();
                                t.push({name: "id", value: $('input[name="sesion_n"]').val()});
                                console.log($.param(t));
                                //return;
                                $.ajax({
                                    type: "POST",
                                    url: "postUpdateSessionOffer", 
                                    data: $.param(t),
                                    success: function(msg){
                                        console.log(msg);
                                             $('#ps_editar_session_modal').modal('hide');
                                              //location.reload();
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
                                });	
                            });
                            
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
                });
              
          });  
            	
           
        });
        
        
        
        $('a.eliminar_sesion').each(function(index,item){
            $(item).click(function(event){
                event.preventDefault();
                var ps_post_data={'id':$(this).data('id'),
                    '_token':$('input[name="_token"]').val()};
                $('#eliminar_sesion_submit').data(ps_post_data);
            });     
        });
        

        $('#eliminar_sesion_submit').click(function(){
            
            var ps_post_data={'id':$(this).data('id'),
                    '_token':$('input[name="_token"]').val()};
            $.ajax({
                    type: "POST",
                    url: "postRemSessionOffer", 
                    data: ps_post_data,
                    success: function(msg){
                           
                            var o =$.parseJSON(msg);
 
                            if(1 === o.result){
                                $('a.editar_sesion').filter(function() { 
                                    return $(this).data("id") === ps_post_data.id;
                                }).parents('tr').first().remove();
                                $('#ps_eliminar_session_modal').modal('hide');
                            }else{
                                 $('#ps_eliminar_session_modal').modal('hide');
                                 $('#error_alert').modal().toggle();
                            }
                            
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
                });
            
        });
        
        //$('#ps_editar_session_modal').on('hidden.bs.modal', function (e) {
 		//    $('#success_alert').modal()
		//})
    
  

});//--