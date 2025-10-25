//FUNCION PARA AJUSTAR PROPORCIONES DE UNA IMAGEN
function ajustarImg(img){

     
     img.height(300)

     while(img.width()<300){

          img.height(img.height()+10)

     }

          var pos = $(".imgPerfil img").position().top
          // console.log(pos)

     if (pos<=0) {
          img.vCenter();
     };

}

//PLUGIN PARA CENTRAR IMAGENES POR "nucklearproject" MODIFICADO POR "usuariojm21"

$.fn.vCenter = function(){
    this.each(function(){
        parent_height = $(this).parent().height();
        image_height = $(this).height();
        top_margin = (parent_height - image_height)/2;

        parent_width = $(this).parent().width();
        image_width = $(this).width();
        left_margin = (parent_width - image_width)/2;

    });
 
    return this.each(function() {
        // $(this).css( 'margin-top' , top_margin);
        $(this).css({
             'margin-top': top_margin,
             'margin-left': left_margin
        });
    });
 
 
}

//FIN DE PLUGIN


function iniciarQuery_setting(){

     var heightImg;
     var archivo

     $(".imgPerfil img").attr('src', '');

     $(".imgPerfil img").attr('src', url_usuario);

     ajustarImg($(".imgPerfil img"))

     // var contWindow = $(".configImg").html()
     // // console.log(contWindow)
     // $(".configImg").html("")


     // $(".cerrarVentana").click(function(){
     //      $(".configImg").html("")
     //      $(".configImg").fadeOut("fast")
     // })

     
     $(".cambiarFoto").click(function(e){
          e.preventDefault();

          $("#file").click()
     })

     $('input[type=file]').change(function() {
  

          var file = (this.files[0].name).toString(); //ESTE METODO ARROJA SOLO EL NOMBRE DEL ARCHIVO
          archivo = this.files[0]
          
          // var file = $(this).val() //SI SE BUSCA MOSTRAR EL TEXTO DEL ARCHIVO DE ESTA MANERA, EL RESULTADO VARIARA DEPENDIENDO DEL NAVEGADOR
          var reader = new FileReader();

          reader.onload = function(e){

               $('.imgPerfil img').attr('src', e.target.result);

               var img = $('.imgPerfil img');

               ajustarImg(img)

          }

          reader.readAsDataURL(this.files[0]);

          // $(".contImg img").Jcrop()


          // $('.contImg img').Jcrop({
          //      // onSelect:    showCoords,
          //      bgColor:     'white',
          //      bgOpacity:   .4,
          //      // setSelect:   [ 280, 280, 100, 100 ],
          //      aspectRatio: 16 / 16
          // },function(){
          //      // $(".contImg img")      
          // });


     });


     $(".tabWindow").click(function(){
          var pos = $(this).index()
          
          $(".tabWindow").removeClass('selected')
          $(".contTab").fadeOut("fast")

          switch(pos){
               case 0:
                    // $(".cont_formulario_detalle").fadeIn("fast")
                    // $(".cont_formulario_ajustes").fadeOut("fast")

                    $(".tabWindow").eq(0).addClass('selected')
                    $(".contTab").eq(0).fadeIn("fast")

                    restablecer()
                    restablecerValores()

               break
               case 1:

                    $(".tabWindow").eq(1).addClass('selected')
                    $(".contTab").eq(1).fadeIn("fast")

                    restablecer()
                    restablecerValores()

               break
          }

     })


     var nombreUsuario = $("#txtNombre")
     var apellidoUsuario = $("#txtApellido")
     var sexoUsuario = $("#txtSexo")
     var direccionUsuario = $("#txtDireccion")
     var ciudadUsuario = $("#txtCiudad")
     var estadoUsuario = $("#txtEstado") 
     var codigoPostalU = $("#txtCodigoPostal") 
     var paisUsuario = $("#txtPais") 
     var zonaHoraria = $("#txtZonaHoraria") 
     var contactoSkype = $("#txtContSkype")
     var file = $("#file")
     var imgUsuario

     nombreUsuario.val(nombre)
     apellidoUsuario.val(apellido)
     sexoUsuario.val(sexo)
     imgUsuario = url_usuario
     $(".imgPerfil img").attr('src', imgUsuario);
     direccionUsuario.val(direccion)
     ciudadUsuario.val(ciudad)
     estadoUsuario.val(estado)
     codigoPostalU.val(codigoP)
     paisUsuario.val(pais)
     zonaHoraria.val(zonaH)
     contactoSkype.val(contSkype)

     $("#btnGuardar").click(function(){

          restablecer()

          validar_campos()

     })


     $(".guardarDetalles").keypress(function(event) {
          restablecer();
          var keycode = (event.keyCode ? event.keyCode : event.which);
          if(keycode == '13'){
            validar_campos()   
          }

     });


     function validar_campos(){
          if (nombreUsuario.val().trim()=="") {errorValidacion(nombreUsuario,""),exit();};
          if (apellidoUsuario.val().trim()=="") {errorValidacion(apellidoUsuario,""),exit();};
          if (direccionUsuario.val().trim()=="") {errorValidacion(direccionUsuario,""),exit();};
          if (ciudadUsuario.val().trim()=="") {errorValidacion(ciudadUsuario,""),exit();};
          if (estadoUsuario.val().trim()=="") {errorValidacion(estadoUsuario,""),exit();};
          if (codigoPostalU.val().trim()=="") {errorValidacion(codigoPostalU,""),exit();};
          if (paisUsuario.val().trim()=="") {errorValidacion(paisUsuario,""),exit();};
          if (zonaHoraria.val().trim()=="") {errorValidacion(zonaHoraria,""),exit();};
          if (contactoSkype.val().trim()=="") {errorValidacion(contactoSkype,""),exit();};
          // if (file.val().trim()=="") {errorValidacion(file,""),exit();};

          guardar_img()
     }

     function errorValidacion(campo,msj){
          campo.focus()
          campo.css({
               'border': '1px solid red',
               'box-shadow': '0 0 2px red'
          });
          $(window).scrollTop(0)
          $(".contErrorCuenta").fadeIn('fast');
          
     }

     function restablecer(){
          $(".formConfigCuenta input").removeAttr('style')
          $(".formConfigCuenta select").removeAttr('style')
          $(".contErrorCuenta").hide()
     }

     function guardar_img(){

          if ($("#file").val().trim()=="") {

               $(".contErrorCuenta").removeAttr('style')

               $(".contErrorCuenta p").html("<b>Sorry! </b> Image missing profile.");

               $(".contErrorCuenta").fadeIn('fast',function(){
                    setTimeout(function(){
                         $(".contErrorCuenta").fadeOut("fast")
                    },4000)
               });

               exit();
          };

          var formData = new FormData($("#formCuenta")[0]);

          $.ajax({

               url: 'php/uploadImg.php',
               type: "POST",
               data: formData,
               contentType: false,
               processData: false,
               success: function(response){

                    $("#btnGuardar").val("Setting Save");
                    $("#btnGuardar").removeAttr('style');
                    // console.log(response)
                    var resp = response;

                    if (resp==0) {
                         
                         $(".contErrorCuenta").removeAttr('style')

                         $(".contErrorCuenta p").html("<b>Sorry! </b> Unable to upload image.");

                         $(".contErrorCuenta").fadeIn('fast',function(){
                              setTimeout(function(){
                                   $(".contErrorCuenta").fadeOut("fast")
                              },4000)
                         });

                    }else{
                         $("#rutaImg").val(resp)
                         guardarDatosPersonales()
                    }

               },
               beforeSend: function(){

                    $("#btnGuardar").val("")
                    $("#btnGuardar").css("background","#ddd url('img/load.gif') no-repeat")
                    $("#btnGuardar").css("background-size","25px")
                    $("#btnGuardar").css("background-position","50% 50%")

               }
          })              

     }

     function guardarDatosPersonales(){
          // continuar registrando los demas datos

          $.ajax({
               url: 'php/guardarConfig_usuario.php',
               type: "GET",
               // data: {nombre:nombre,apellido:apellido,sexoUsuario:sexoUsuario,direccion:direccion,ciudad:ciudad,estado:estado,codigoP:codigoP,pais:pais,zonaH:zonaH,contactoSkype:contSkype,funcion:1},
               data: $("#formCuenta").serialize(),
               success: function(response){

                    $("#btnGuardar").val("Setting Save");
                    $("#btnGuardar").removeAttr('style');

                    var resp = response

                    if (resp==0) {

                         $(".contErrorCuenta").removeAttr('style')

                         $(".contErrorCuenta p").html("<b>Sorry! </b> There was an error in the query. Please contact technical support")

                         $(".contErrorCuenta").fadeIn('fast',function(){
                              setTimeout(function(){
                                   $(".contErrorCuenta").fadeOut("fast")
                              },4000)
                         });

                    }else if(resp==1){

                         $(".contErrorCuenta").css({
                              border: '1px solid #D7EAC4',
                              background: 'rgb(224,241,214)'
                         });

                         $(".contErrorCuenta p").css({
                              color: '#588A41'
                         });

                         $(".contErrorCuenta p").html("<b>Enhorabuena! </b> User details saved successfully.")

                         $(".contErrorCuenta").fadeIn('fast',function(){
                              setTimeout(function(){
                                   $(".contErrorCuenta").fadeOut("fast")
                              },4000)
                         });

                    }

               },
               beforeSend: function(){

                    $("#btnGuardar").val("")
                    $("#btnGuardar").css("background","#ddd url('img/load.gif') no-repeat")
                    $("#btnGuardar").css("background-size","25px")
                    $("#btnGuardar").css("background-position","50% 50%")

               }
          })

     }

     // FUNCION PARA GUARDAR DATOS DE CONFIGURACION DE CUENTA/////////////////////////////////////////////////////////////

     var claveActual,nuevaClave,confirmarC,correoN,claveN

     claveActual = $(".txtClaveActual")
     nuevaClave = $(".txtNuevaClave")
     confirmarC = $(".txtConfirmarC")
     correoN = $(".txtCorreo")
     claveN = $(".txtClave")

     $(".btnGuardarConfig").click(function(){


          restablecerValores()

          validarConfigCuenta()
     })

     $(".guardarConfig").keypress(function(event) {
          restablecerValores();

          var keycode = (event.keyCode ? event.keyCode : event.which);
          if(keycode == '13'){
            validarConfigCuenta()   
          }

     });


     function errorValidacionConfig(campo,msj){
          if (msj=="") {
               msj="<b>Sorry! </b> There are blank fields.";
          }

          campo.focus()
          campo.css({
               'border': '1px solid red',
               'box-shadow': '0 0 2px red'
          });
          $(window).scrollTop(0)
          $("#ErrorConfigCuenta p").html(msj)
          $("#ErrorConfigCuenta").fadeIn('fast');
          
     }

     function restablecerValores(){
          $(".formConfigCuenta input").removeAttr('style')
          // $(".formConfigCuenta select").removeAttr('style')
          $("#ErrorConfigCuenta").hide()
          $("#ErrorConfigCuenta").removeAttr('style')
     }


     function validarConfigCuenta(){

          if (claveActual.val().trim()=="") {errorValidacionConfig(claveActual,""),exit();};
          if (nuevaClave.val().trim()=="") {errorValidacionConfig(nuevaClave,""),exit();};
          if (confirmarC.val().trim()=="") {errorValidacionConfig(confirmarC,""),exit();};
          if (confirmarC.val().trim()!=nuevaClave.val().trim()) {errorValidacionConfig(confirmarC,"<b>Sorry! </b> the password do not match."),exit();};

          enviarDatos(claveActual,nuevaClave)
     }

     function enviarDatos(claveActual,nuevaClave){
          $.ajax({
               url: 'php/guardarConfig_usuario.php',
               type: 'GET',
               data: $(".formCuenta2").serialize(),
               success: function(response){

                    $(".btnGuardarConfig").val("Setting Save");
                    $(".btnGuardarConfig").removeAttr('style');

                    var resp = response;
                    // console.log(resp)

                    if (resp==0) {

                         $("#ErrorConfigCuenta").removeAttr('style')

                         $("#ErrorConfigCuenta p").html("<b>Sorry! </b> There was an error in the query. Please contact technical support.")

                         $("#ErrorConfigCuenta").fadeIn('fast',function(){
                              setTimeout(function(){
                                   $("#ErrorConfigCuenta").fadeOut("fast")
                              },4000)
                         });

                    }else if (resp==2) {

                         $("#ErrorConfigCuenta").removeAttr('style')
                         errorValidacionConfig(claveActual,"<b>Sorry! </b> Incorrect  password.")

                    }else if (resp==1) {

                         $("#ErrorConfigCuenta").css({
                              border: '1px solid #D7EAC4',
                              background: 'rgb(224,241,214)'
                         });

                         $("#ErrorConfigCuenta p").css({
                              color: '#588A41'
                         });

                         $("#ErrorConfigCuenta p").html("<b>Enhorabuena! </b> Detalles de la configuracion, guardados exitosamente.")

                         $("#ErrorConfigCuenta").fadeIn('fast',function(){
                              setTimeout(function(){
                                   $("#ErrorConfigCuenta").fadeOut("fast")
                              },4000)
                         });

                    }
               },
               beforeSend: function(){

                    $(".btnGuardarConfig").val("")
                    $(".btnGuardarConfig").css("background","#ddd url('img/load.gif') no-repeat")
                    $(".btnGuardarConfig").css("background-size","25px")
                    $(".btnGuardarConfig").css("background-position","50% 50%")

               }
          })
          
          
     }

     
     }