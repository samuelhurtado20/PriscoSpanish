$(document).ready(function() {
  

    $("#btnFacebook").click(login)
    $("#btnFacebook2").click(login)


    // $("#logout").click(facebookLogout)

    //SCRIPT PARA LOGIN CON FACEBOOK, UTILIZANDO LA SDK DE JAVASCRIPT DE FACEBOOK

    permisos= {scope: 'email, public_profile,user_friends'}

    window.fbAsyncInit = function() {
        FB.init({
          // appId      :'1628595557420334',
          appId      : '386150378245132',
          xfbml      : true,
          version    : 'v2.4'
        });

        // FUNCION QUE VERIFICA AL CARGAR LA PAGINA SI SE ESTA LOGEADO CON FACEBOOK////////////////////////

        // FB.getLoginStatus(function(response) {
        //     statusChangeCallback(response);
        // });

    };

    function checkLoginState() {
        FB.getLoginStatus(function(response) {
          statusChangeCallback(response);
        });
    }

    function statusChangeCallback(response) {

        if (response.status === 'connected') {
          
          testAPI();
        } else if (response.status === 'not_authorized') {
          
          console.log('Usted aun no esta autorizado por facebook para iniciar sesion. Vuelva a presionar el boton de login')


          
        } else {
          
          console.log('Inicia sesion con facebook')
          
        }
    }

    function testAPI() {

        // console.log("conectado")

        FB.api(
            "/me?fields=name,picture,first_name,last_name,age_range,link,gender,email",
            function(response){

            var imgF = 'http://graph.facebook.com/'+response.id+'/picture?type=large';

            var idF=response.id;
            var nombre = response.name;
            var pNombre = response.first_name;
            var apellido = response.last_name;
            var email;

            var genero ="Male";
            if (response.gender=="male") {
                genero="Male";
            }else{
                genero="Female";
            }

            if (response.email!=undefined) {
                email=response.email;
                
            }else{
                email=""
            }

            // console.log(idF)

            // Enviar Ajax
            $.ajax({
                    type: 'get',
                    url: 'php/buscarIdFacebook.php?idF='+idF,
                    success:  function (response) {
                            
                            var res = response;

                            // console.log(res)

                            if (res == 0) {
                                alert("En estos momentos es imposible completar el proceso de conexion con facebook. por favor Intente mas tarde")
                            }else if(res == 2){

                                $("#registroFacebook").fadeIn("fast");

                                $("#registroFacebook").html('<div class="bannerErrorLogin"><p>There are blanks!</p></div><div id="imgFacebook">'+
                                    '<img src="'+imgF+'" alt="">'+
                                    '</div>'+
                                    '<div id="contRegistroFacebook">'+
                                    '<h4>Hi, '+nombre+'</h4><p>One simple step more<br>PriscoSpanish: we need this information from you</p>'+
                                    '</div><div id="enlazar">'+
                                    '<div id="bordeLinea"></div>'+
                                    '<h3>Facebook connects to an existing account</h3>'+
                                    '<form action="#" name="enlazarFacebook" id="enlazarFacebook">'+
                                    '<input type="text" id="cCorreo" class="textoEnlazar" placeholder="Email" value="'+email+'" onKeyPress="validarCuentaFacebook_Kp();">'+
                                    '<input type="password" id="cClave" class="textoEnlazar" placeholder="Password" onKeyPress="validarCuentaFacebook_Kp();">'+
                                    '<input type="button" id="btnEnlazar" value="link Account" onclick="validarCuentaFacebook('+idF+');">'+
                                    '</form>'+
                                    '</div> Or <br />'+

                                    '<button id="crearCuenta" style="outline:none;">Create Account</button>'+
                                    '</div>'+
                                    '<script>$("#crearCuenta").click(function(){'+
                                    '$("#ventanaTransparente").fadeOut("fast");'+
                                    '$("#loginUsuario form").fadeOut("fast");'+
                                    '$("#cerrarSesion").fadeOut("fast");'+
                                    '$("#registroFacebook").fadeOut("fast");'+
                                    'valoresLoginDefecto();'+
                                    '$("form #idFacebook").val('+idF+');'+
                                    '$("form #nombre").val("'+pNombre+'");'+
                                    '$("form #apellido").val("'+apellido+'");'+
                                    '$("form #correoRegistro").val("'+email+'");'+
                                    '$(".msjFloat").fadeIn("fast");'+
                                    'setTimeout(function(){$(".msjFloat").fadeOut("fast")},5000);'+
                                    '$(".textoEnlazar").keypress(function(event){'+
                                        'var keycode = (event.keyCode ? event.keyCode : event.which);'+
                                        'if(keycode == "13"){'+
                                            '$("#btnEnlazar").click()' +   
                                        '}'+
                                    '});'+

                                '});'+                                
                                '</script>')

                            }else if(res==1){

                                location.href="./dashboard"

                            }
                            
                    },
                    beforeSend: function(){
                        $("#registroFacebook").html('<p class="msjLoad">Data loaging...</p>'+
                        '<div class="loadFacebook"></div>');
                        $("#registroFacebook").fadeIn("fast");
                        $("#ventanaTransparente").fadeIn("fast");
                        $("#ventanaTransparente").height($(window).height);
                        $("#cerrarSesion").fadeIn("fast");
                    }
            })

            }
        )
    }


    function login (ev){
        // writeOutput('Solicitando login...');
        isLogginProcess = true;
        FB.login(controlarStatus, permisos);
    }

    function facebookLogout(){
        FB.getLoginStatus(function(response) {
            if (response.status ==='connected') {
                FB.logout(function(response){
                    
                })
            }
        });
    }

    function controlarStatus(respuesta)
    {
        if (respuesta.authResponse)
        {

            // console.log(respuesta.status)
            if (respuesta.status === "connected"){
                
                FB.getLoginStatus(function(response) {
                    statusChangeCallback(response);
                });

                // uid = respuesta.authResponse.userID;
                // accessToken = respuesta.authResponse.accessToken;

            } 
            else if (respuesta.status === "not_authorized"){
                
                //AUN NO ESTA AUTENTICADO
            } 
            else{
                
                //AUN NO ESTA LOGUEADO
            }
        }
        else
        {
            
            if (isLogginProcess){

                isLogginProcess = false;
                FB.getLoginStatus(controlarStatus, true);
            }

            if (respuesta.status === "not_authorized"){                   

            }
            else{

            }
        }
        
    }
 

});