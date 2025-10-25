function iniciarFormContacto(){

     var nombre,correo,asunto,mensaje,boton

     nombreContact = $("#nombreC")
     correoContact = $("#correoC")
     asuntoContact = $("#asuntoC")
     mensajeContact = $("#mensajeC")
     botonC = $("#btnEnviarC")
     var expresion = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;


     $(".contContactos .objContact").keypress(function(event){
          restaurarValoresContact()

          var keycode = (event.keyCode ? event.keyCode : event.which);
          if(keycode == '13'){
               validarVar();    
          }
     });

     botonC.click(function(){

          restaurarValoresContact()

          validarVar()

     })

     function validarVar(){

          if (nombreContact.val().trim()=="") {errorCamposContact(nombreContact,""),exit()};
          if (correoContact.val().trim()=="") {errorCamposContact(correoContact,""),exit()};
          if (asuntoContact.val().trim()=="") {errorCamposContact(asuntoContact,""),exit()};
          if (mensajeContact.val().trim()=="") {errorCamposContact(mensajeContact,""),exit()};
          if (!expresion.test(correoContact.val().trim())) {errorCamposContact(correoContact,"Invalid email format!"),exit()}
          
          // mensajeContact = "Hi, my name is "+nombreContact+"<br>"+mensajeContact
          // alert(mensajeContact)

          enviarCorreo()

     }

     function errorCamposContact(campoContact,msj){

          if (msj=="") {msj="there are spaces in blank!"};

          campoContact.css({
               'box-shadow': '0 0 7px #f13'
          });
          campoContact.focus()

          var vtop = campoContact.position().top + campoContact.height()+25
          var vleft = campoContact.position().left+2

          $(".msjErrorContact").fadeIn("fast")
          $(".msjErrorContact").css({
               top: vtop+"px",
               left: vleft+'px'
          });

          $(".msjErrorContact").text(msj)

     }

     function restaurarValoresContact(){

          $(".contContactos .objContact").removeAttr('style')
          $(".msjErrorContact").fadeOut("fast")
          $(".msjErrorContact").removeClass('exito')
          $(".msjErrorContact").removeClass('error')

     }

     function enviarCorreo(){

          $.ajax({
               url: 'php/enviarContac.php',
               type: 'GET',
               // data: $("#frmContact").serialize(),
               data: {nombre: nombreContact.val().trim(),correo:correoContact.val().trim(),asunto:asuntoContact.val().trim(),mensaje:mensajeContact.val().trim()},
               success:function(response){

                    botonC.removeAttr('style')
                    botonC.val("SEND MESSAGE")

                    var resp = response

                    if (resp==0) {
                         $(".msjErrorContact").removeClass('exito')
                         $(".msjErrorContact").addClass('error')
                         $(".msjErrorContact").text("E-mail not sent. Communicate with technical support.")
                    }else if(resp==1){
                         $(".msjErrorContact").removeClass('error')
                         $(".msjErrorContact").addClass('exito')
                         $(".msjErrorContact").text("Email Sent successfully")
                    }

                    var vtop = botonC.position().top+3
                    var vright = botonC.width()+32

                    $(".msjErrorContact").css({
                         top: vtop+'px',
                         right: vright+'px',
                         left: 'auto'
                    });

                    $(".msjErrorContact").fadeIn("fast",function(){
                         setTimeout(function(){
                              $(".msjErrorContact").fadeOut("fast")
                         },3000)
                    })

                    nombreContact.val("")
                    correoContact.val("")
                    asuntoContact.val("")
                    mensajeContact.val("")

               },
               beforeSend: function(){

                    botonC.val("")
                    botonC.css({
                         'background': '#eee url(img/load.gif) 50% 50% no-repeat',
                         'background-size':'25px'
                    });

               }
          })         

     }


}