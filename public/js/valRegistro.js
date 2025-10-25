
function iniciarValRegistro(){

    $("#bannerError").hide();

    //declaracion de variables

    var nombreR,apellidoR,correoRegistro,confirmarCorreoR,claveRegistro;
    var campo;
	
    //ocultar div#mensaje de error
    //$("#mensajeError").hide();

    //funcion para evento click del boton registrar
    $("#registrar").click(validarRegistro);

    $("#frmRegistrar input").keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            validarRegistro();    
        }
    });

    //VALIDACION DE INPUTS NOMBRE Y APELLIDO

    $(function(){
        //Solo letras
        $("#nombre").validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéíóú');
        $("#apellido").validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéíóú');

        //Solo numeros
        //$("#nombre").validCampoFranz('123456789');

    });

    $("#frmRegistrar input").keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode != '13'){
            restablecerValores();    
        } 
        
    });

}

function validarRegistro(){

    nombreR = $("#nombre");
    apellidoR = $("#apellido");
    correoRegistro = $("#correoRegistro");
    confirmarCorreoR = $("#confirmarCorreo");
    claveRegistro = $("#claveRegistro");
    idFacebook = $("#idFacebook")
    var expresion = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;

    restablecerValores();

    if (nombreR.val().trim()=="") {errorValidacion(nombreR,"");exit()};
    if (apellidoR.val().trim()=="") {errorValidacion(apellidoR,"");exit()};
    if (correoRegistro.val().trim()=="") {errorValidacion(correoRegistro,"");exit()};
    if (confirmarCorreoR.val().trim()=="") {errorValidacion(confirmarCorreoR,"");exit()};
    if (claveRegistro.val().trim()=="") {errorValidacion(claveRegistro,"");exit()};
    if (confirmarCorreoR.val().trim()!=correoRegistro.val().trim()) {errorValidacion(confirmarCorreoR,"Mismatch emails!");exit()};
    if (!expresion.test(correoRegistro.val().trim())) {errorValidacion(correoRegistro,"Mail format is invalid!");exit()};
    if (!expresion.test(confirmarCorreoR.val().trim())) {errorValidacion(confirmarCorreoR,"Mail format is invalid!");exit()};

    enviarDatos(nombreR.val(),apellidoR.val(),correoRegistro.val(),claveRegistro.val(),idFacebook.val());
    // $("#frmRegistrar").submit();
      
}

function errorValidacion(campo,texto){

    restablecerValores();

    if (texto=="") {texto="There are blanks!"};

    campo.css({
        border: '1px solid red',
        'box-shadow': '0 0 2px red'
    });

    campo.focus()

    $("#bannerError").fadeIn("fast");
    $("#bannerError").html("<p>"+texto+"</p>");

}

function restablecerValores(){

    //ocultar banner de error y restablecer valores
    $("#bannerError").removeAttr('style')
    $("#bannerError").hide();
    $("#bannerError").html("<p>There are blanks!</p>");

    //Restablecer valor css de los campos confirmar correo y confirmar clave

    $("input").removeAttr('style')    
}

function enviarDatos(cNombre,cApellido,cCorreo,cClave,cIdf){

    var urlAction = $("#frmRegistrar").attr('action');
    var metodo = $("#frmRegistrar").attr('method');

    // $("#frmRegistrar").submit(function(e) {
    //     e.preventDefault;

        $.ajax({
            url: urlAction,
            type: metodo,
            // data: $("#frmRegistrar").serialize(),
            data: {nombre:cNombre,apellido:cApellido,correo:cCorreo,clave:cClave,idFacebook:cIdf},
            success: function (resp) {
                
                // console.log(resp)

                $("#registrar").val("Sing Up")
                $("#registrar").removeAttr('style')

                $("#bannerError").fadeIn("fast");

                if (resp==0) {
                    $("#bannerError").html("<p>There are blanks!</p>");
                }else if(resp==1){
                    $("#bannerError").html("<p>There was an error in the query. :)</p>");
                }else if(resp==2){
                    $("#bannerError").html("<p>User Not Available. :)</p>");
                    $("#correoRegistro").focus()
                }else if(resp==3){
                    
                    $("#bannerError").html("<p>Successful user registration!</p>");

                    $("#bannerError").css({
                        border: '1px solid #D7EAC4',
                        background: 'rgb(224,241,214)'
                    });
                    $("#bannerError p").css({
                        color: '#588A41'
                    });

                    location.href="./php/account_created";
                    
                }else{
                    console.log(resp)
                }

            },
            beforeSend: function(){
                $("#registrar").val("")
                $("#registrar").css({
                    'background': '#eee url(img/load.gif) no-repeat',
                    'background-size':'25px',
                    'background-position':'50% 50%'
                });
            },
            error: function(jqXHR,estado,error){
                // console.log(estado)
                console.log(error)
                if (error=="Not Found") {alert("No se encuentra la pagina")};
            },
            timeout: 10000
        });

    // });
}
