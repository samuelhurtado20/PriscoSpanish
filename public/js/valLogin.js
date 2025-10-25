function iniciarValLogin(){

    //ocultar mensaje de error de login
    $(".errorValLogin").hide();

    //Restablecer valores del login
    $(".iptSesion").keypress(valoresLoginDefecto);

    //mostrar cuadro de login como popup
/*
    $(".loginSesion").click(function(event){


        $("#ventanaTransparente").fadeIn("fast");
        $("#ventanaTransparente").height($(window).height);
        $("#cerrarSesion").fadeIn("fast");
        $("#loginUsuario form").fadeIn("fast");
        $("#correo").focus();
    })

    //ocultar cuadro popup de login
    $("#cerrarSesion").click(function(){


        $("#ventanaTransparente").fadeOut("fast");
        $("#loginUsuario form").fadeOut("fast");
        $("#cerrarSesion").fadeOut("fast");
        $("#registroFacebook").fadeOut("fast")
        $(".contVideo").fadeOut("fast")

        valoresLoginDefecto();
    });
*/
    //llamar la funcion de validarSesion para realizar el registro
    $("#iniciarSesion").click(validarSesion);


    //llamar la funcion de validarSesion con el evento keypress de los input
    $("#frmInicioSesion .iptSesion").keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            validarSesion();    
        }
    });


    //cerrar mensaje de error
    $("#cerrarError").click(function(){
        $("#mensajeError").animate({top: -100},"fast");
        $("#ventanaTransparente").fadeOut("fast");
    });

}

function valoresLoginDefecto(){
    $("#correo").removeAttr('style')
    $("#clave").removeAttr('style')
    $("#msgError").fadeOut("fast");
    $("#bannerErrorLogin").fadeOut("fast")
    // $("#msgError").css({
    //     top: '0',
    //     left: '0'
    // });
}

function validarSesion(){

    var correo,clave;

    valoresLoginDefecto();

    correo = $("#correo");
    clave = $("#clave");

    var msgError = $("#msgError"); 

    var posicion1 = $("#correo").position().top -5;
    var posicion2 = $("#clave").position().top -5;

    var expresion = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;

    if (correo.val().trim() == "") {

        correo.css("box-shadow","0px 0px 3px red");
        correo.css("border","1px solid #f00")
        correo.focus();
        msgError.css({
            top: posicion1+47,
            left: correo.position().left
            
        });
        msgError.fadeIn("fast");
        msgError.html("You must enter an email!")


    }else if(clave.val().trim() == ""){
        clave.css("box-shadow","0px 0px 3px red");
        clave.css("border","1px solid #f00")
        clave.focus();
        msgError.css({
            top: posicion2+47,
            left: clave.position().left
            
        });
        msgError.fadeIn("fast");
        msgError.html("You must enter a password!")
        

    }else if (expresion.test(correo.val().trim())) {
                   
        login(correo.val(),clave.val())
    
    }else {
        correo.css("box-shadow","0px 0px 3px red");
        correo.css("border","1px solid #f00")
        correo.focus()
        msgError.css({
            top: posicion1+47,
            left: correo.position().left
            
        });
        msgError.fadeIn("fast");
        msgError.html("Invalid email format!")

    }

}

function login(correo,clave){

    $.ajax({
        url: "php/login.php?correo="+correo+"&clave="+clave,
        type:  "get",

        beforeSend: function(){
            $("#iniciarSesion").val("")
            $("#iniciarSesion").css({
                'background': '#eee url(img/load.gif) no-repeat',
                'background-size':'25px',
                'background-position':'50% 50%'
            });
        },
        success:  function(response) {
            
            var res = response;

            console.log(res)

            if (res==0) {
                $("#bannerErrorLogin").fadeIn("fast");
                $("#bannerErrorLogin p").text("Query Failed!.")
            }else if(res==1){
                $("#bannerErrorLogin").fadeIn("fast");
                $("#bannerErrorLogin p").text("invalid email or password!.")
            }else if(res==2){
                
                location.href="./"

            }

            $("#iniciarSesion").removeAttr('style')
            $("#iniciarSesion").val("Log In")

        }
    })

}