
/**
 * Codigo propiedad de PriscoSpanish
 * todos los derechos reservados
 *  enviar opciones de sesion de clases a la base de datos.
 */
 jQuery( document ).ready(function(){
     
     $('.session-row').each(function(index,item){
        $(item).click(function(event){
            event.preventDefault();
            $('#ps_session_modal').data('session',$(this).data('session'));
        });     
    });
     
     
    $('#ps_session_modal').on('show.bs.modal', function (e) {

            $.ajax({
                type: "POST",
                url: "postGetls",
                data: { 'ls':$(this).data('session'),
                        '_token':$('input[name="_token"]').val()},
                success: function(msg){
                    var o =$.parseJSON(msg);
                    $('#data-profesor').text(o.teacher); 
                    $('#data-idioma').text(o.language); 
                    $('#data-current-status').text(o.status); 
                    $('#completada_alumno').prop('checked',o.completed_T); 
                    $('#completada_profesor').prop('checked',o.completed_A);
                    $('#data-inicio').text(o.inicio);
                    $('#data-final').text(o.final);
                    $('#data-precio').text(o.precio);

                    $("#form-content").modal('hide');
                },
                error: function(){
                        alert("failure:try again later");
                }
            });
    });

    $("input#submit").click(function(){
        $.ajax({
            type: "POST",
            url: "postUpdatels", 
            data: { 'ls':$('#ps_session_modal').data('session'),
                    'st': ($('#completada_alumno').prop('checked')?1:0),
                        '_token':$('input[name="_token"]').val()},
            success: function(msg){
                    $("#thanks").html(msg); 
                    $("#form-content").modal('hide');
            },
            error: function(){
                    alert("failure:try again later");
            }
        });
    });

});