function global_funcion(){

     var estadoLeccion=1;

     cargarTabla(1,20);

     $(".menuTab li").click(function(){
          var index = $(this).index()
          
          $(".menuTab li").css("border-bottom","0")
          $(this).css('border-bottom', '3px solid #444');

     })


     $(".leccionesPendientes").click(function(){
          cargarTabla(1,20)
          estadoLeccion = 1;
     });
     $(".leccionesTomadas").click(function(){
          cargarTabla(2,20)
          estadoLeccion = 2;
     });
     $(".leccionesCanceladas").click(function(){
          cargarTabla(0,20)
          estadoLeccion = 3;
     });

     $("#mostrarResultado").change(function(){
          var cantidadN = $(this).val()
          // alert(estadoLeccion)
          cargarTabla(estadoLeccion,cantidadN)

     })

}

function cargarTabla(tipoLeccion,cantidadN){

     $.ajax({
          url: 'php/lecciones_reservadas.php',
          type: 'GET',
          data: {email: correo_e,estado_l:tipoLeccion,cantidadN:cantidadN},
          success: function(response){
               
               tabla = $("#detalle");
               tabla.html("")

               if (response==0) {
                    console.log("Hubo un problema con la consulta")
               }else if(response==2){
                   tabla.html('<div class="rowLecciones detalle"><h3>No hay notificaciones!</h3></div>')
               }else{
                    // console.log("El resultado es: "+response)
                    tabla.html(tabla.html()+response)
               }
          },
          beforeSend: function(){
               // console.log("procesando...")
               tabla = $("#detalle");
               tabla.html('<div class="rowLecciones detalle"><img src="img/load.gif" alt=""></div>')
          }
     })
     
}