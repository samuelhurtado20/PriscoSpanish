function validaUsuarioFacebook(idF,nombre,apellido,sexo){

     var emailFacebookL,
claveFaceL,
btnLoginFacebook,
emailFacebook,
cEmailFacebook,
claveFacebook,
btnRegistrarFace

     emailFacebookL = $("#emailFacebookL")
     claveFaceL = $("#claveFaceL")
     btnLoginFacebook = $("#btnLoginFacebook")
     emailFacebook = $("#emailFacebook")
     cEmailFacebook = $("#cEmailFacebook")
     claveFacebook = $("#claveFacebook")
     btnRegistrarFace = $("#btnRegistrarFace")
     var expresion = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;


     // FUNCIONES GENERALES

     function errorValid(campoF,msj,tipoForm){

          if (msj=="") {msj="There are spaces in blank!"};

          campoF.focus()
          campoF.css({
               border: '1px solid #f13',
               'box-shadow': ' 0 0 3px #f13'
          });

          $(".msjResultadoFacebook").text(msj)

          var vtop = campoF.position().top + campoF.height()+35
          var vleft = campoF.position().left+2

          if (tipoForm==1) {
               $("#resultLogin").fadeIn()
               $("#resultLogin").css({
                    top: vtop+"px",
                    left: vleft+'px'
               });
          }else if (tipoForm==2) {
               $("#resultRegistro").fadeIn()
               $("#resultRegistro").css({
                    top: vtop+"px",
                    left: vleft+'px'
               });
          }
     }

     function restablecerTodoF(){
          $(".registrarFacebook input").removeAttr('style')
          $(".registrarFacebook .msjResultadoFacebook").removeClass('error')
          $(".registrarFacebook .msjResultadoFacebook").removeClass('listo')
          $(".msjResultadoFacebook").hide()
     }


     // SCRIPTS PARA LOGIN DE FACEBOOK////////////////////////////////////////////////////

     $(".inputLoginF").keypress(function(event) {
          restablecerTodoF()
          var keycode = (event.keyCode ? event.keyCode : event.which);
          if(keycode == '13'){
               valLogin();    
          }
     });

     btnLoginFacebook.click(function(){
          restablecerTodoF()
          valLogin()

     })

     function valLogin(){

          // validar formulario de login para cuenta de facebook

          if (emailFacebookL.val().trim()=="") {errorValid(emailFacebookL,"",1),exit()};
          if (claveFaceL.val().trim()=="") {errorValid(claveFaceL,"",1),exit()};
          if (!expresion.test(emailFacebookL.val().trim())) {errorValid(emailFacebookL,"Invalid email format",1),exit()};

          loginUsuarioF()

     }

     function loginUsuarioF(){

          $.ajax({
               url: "php/enlazarFacebook.php",
               type:  "get",
               data:{correo:emailFacebookL.val().trim(),clave:claveFaceL.val().trim(),idF:idF},
               beforeSend: function(){
                    btnLoginFacebook.val("")
                    btnLoginFacebook.css({
                    'background': '#eee url(img/load.gif) no-repeat',
                    'background-size':'25px',
                    'background-position':'50% 50%'
                    });
               },
               success:  function(response) {

                    var res = response;

                    if (res==0) {
                         $("#resultLogin").addClass('error')
                         errorValid(btnLoginFacebook,"Sorry , there are problems with your query",1)
                    }else if (res=="0.1") {
                         $("#resultLogin").addClass('error')
                         errorValid(btnLoginFacebook,"Invalid email or password",1)
                    }else if (res=="0.2") {
                         $("#resultLogin").addClass('error')
                         errorValid(btnLoginFacebook,"This account is already linked",1)
                    }else if (res=="1") {
                         // $("#resultLogin").addClass('Listo')
                         // errorValid(btnLoginFacebook,"Listo, Perfecto",1)
                         location.href="./dashboard"
                    }

                    var vtop = btnLoginFacebook.position().top+15
                    var vleft = btnLoginFacebook.position().left+btnLoginFacebook.width()+63

                    $("#resultLogin").css({
                         'top':vtop+"px",
                         'left':vleft+"px"
                    })

                    btnLoginFacebook.removeAttr('style')
                    btnLoginFacebook.val("LOG IN")

               }
          })

     }

     // SCRIPTS PARA REGISTRO CON FACEBOOK////////////////////////////////////////////////////

     $(".inputRegF").keypress(function(event) {
          restablecerTodoF()
          var keycode = (event.keyCode ? event.keyCode : event.which);
          if(keycode == '13'){
               valRegistro();    
          }
     });


     $("#btnRegistrarFace").click(function(){
          
          restablecerTodoF()
          valRegistro()
     })


     function valRegistro(){

          // validar formulario de registro para cuenta de facebook

          if (emailFacebook.val().trim()=="") {errorValid(emailFacebook,"",2),exit()};
          if (cEmailFacebook.val().trim()=="") {errorValid(cEmailFacebook,"",2),exit()};
          if (claveFacebook.val().trim()=="") {errorValid(claveFacebook,"",2),exit()};
          if (cEmailFacebook.val().trim()!=emailFacebook.val().trim()) {errorValid(cEmailFacebook,"The email does not match",2),exit()};
          if (!expresion.test(emailFacebook.val().trim())) {errorValid(emailFacebook,"Invalid email format",2),exit()};

          completarRegistroF()
     }

     function completarRegistroF(){

          // alert(emailFacebook.val())

          $.ajax({
               url: "php/registroFacebook.php",
               type:  "GET",
               data:{correo:emailFacebook.val().trim(),clave:claveFacebook.val().trim(),idF:idF,nombre:nombre,apellido:apellido,sexo:sexo},
               success: function(response){

                    var res = response;
                    // console.log(res)

                    if (res==0) {
                         $("#resultRegistro").addClass('error')
                         errorValid(btnRegistrarFace,"Sorry , there are problems with your query",2)
                    }else if (res=="0.1") {
                         $("#resultRegistro").addClass('error')
                         errorValid(btnRegistrarFace,"This account already exists",2)
                    }else if (res=="0.2") {
                         $("#resultRegistro").addClass('error')
                         errorValid(btnRegistrarFace,"This account is already linked",2)
                    }else if (res=="1") {
                         // $("#resultRegistro").addClass('Listo')
                         // errorValid(btnRegistrarFace,"Listo, Perfecto",2)
                         location.href="./dashboard"
                    }

                    var vtop = btnRegistrarFace.position().top+13
                    var vleft = btnRegistrarFace.position().left+btnRegistrarFace.width()+63

                    $("#resultRegistro").css({
                         'top':vtop+"px",
                         'left':vleft+"px"
                    })

                    btnRegistrarFace.removeAttr('style')
                    btnRegistrarFace.val("SING UP")

               },
               beforeSend: function(){

                    btnRegistrarFace.val("")
                    btnRegistrarFace.css({
                         'background': '#eee url(img/load.gif) no-repeat',
                         'background-size':'25px',
                         'background-position':'50% 50%'
                    });

               }
          })
        
     }

}