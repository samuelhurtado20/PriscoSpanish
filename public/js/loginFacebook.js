$(document).ready(function() {
  

    $("#btnFacebook").click(login)
    $("#btnFacebook2").click(login)


    // $("#logout").click(facebookLogout)

    //SCRIPT PARA LOGIN CON FACEBOOK, UTILIZANDO LA SDK DE JAVASCRIPT DE FACEBOOK

    permisos= {scope: 'email, public_profile,user_friends'}

    window.fbAsyncInit = function() {
        FB.init({
          appId      : '386150378245132',
          // appId      :'1628595557420334',
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

                $("#nombreF").val(pNombre)
                $("#apellidoF").val(apellido)
                $("#sexoF").val(genero)
                $("#urlImgF").val(imgF)
                $("#idF").val(idF)
                $("#correoF").val(email)


                var datos = $("#formDatosFacebook").serialize()

                $.ajax({
                    type:'GET',
                    url:'php/variablesSesion.php',
                    data:datos,
                    success:function(response){
                        // console.log(response)
                        location.href="./dashboard"
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