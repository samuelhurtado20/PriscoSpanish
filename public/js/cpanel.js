function iniciarQuery(p){

     var Mnuvisible = 0;
     var IdiVisible = 0;

    mediaQuery();

    // alert(window.location.pathname)

    if ($(window).width()<1024) {
        $("#btnMnu").css("display","inline-block");
    }

    // INICIO DE FUNCIONES PARA EL COMPORTAMIENTO DE LOS MENUS PRINCIPAL
        //COMPORTAMIENTO DE MENUS PRINCIPALES EXECTO EL MENU SESSIONS

    $(".menus").click(function(){
        var posicion = $(this).index();
        //console.log(posicion);
        posicion++;


        switch(posicion){
            case 1:
                cambiarPagina("inicio.php");
            break
            case 2:
                cambiarPagina("actualizar.php");
            break
            // case 3:

            //     cambiarPagina("private_sessions.php");
            // break
            case 4:
                // RESOURCES
            break
            case 5:
                //cambiarPagina("perfil.php?s="+usuario);
                //PERFIL DE USUARIO
            break
        }
                

    });

        //COMPORTAMIENTO DE SUBMENUS
    //deshabilitar los enlaces
    $(".subMenus a").click(function(e){
        e.preventDefault();
        //return false;
    });

    $(".subMenus").click(function(){
        var posicion = $(this).index();
        posicion++;

        switch(posicion){
            case 1:
                cambiarPagina("group_sessions.php");
            break
            case 2:
                cambiarPagina("private_sessions.php");
            break

        }
    })
    
    //sub menu perfil -> alumnos sub menu perfil-> profesor
    $(".btnPerfil").next('.subMnu').find('.subMenus').off('click');
    $(".btnPerfil").next('.subMnu').find('.subMenus').each(function(index,item){
        $(this).find('a').first().click(function(e){
            //alert($(this).attr('href'));
            cambiarPagina($(this).attr('href'));
        });
    });
//-------------------------------

    if (p=='') {
        cambiarPagina("inicio.php");
    }else if(p=='dashboard'){

        cambiarPagina("inicio.php")
    }else{

        cambiarPagina(p+".php");
    }

        //FUNCION PARA CAMBIAR PAGINA DEPENDIENDO DE LA SELECCION DEL MENU

    function cambiarPagina(pagina){

        $.ajax({
                //data: parametros,
                url: pagina,
                type:  'get',
                beforeSend: function () {
                        $("#contenido").html("<img id='load' style='position:absolute; margin-top:20%; margin-left: 45%; width: 48px; height: 48px;' src='img/load.gif'>");
                },
                success:  function (response) {
                        $("#contenido").html(response);
                }
        });
    }

        //COMPORTAMIENTO DEL BOTON DEL MENU QUE APARECE EN LA VERSION MOVIL DE LA PAGINA

    $("#btnMnu").click(function(event) {
        event.stopPropagation();
        
        if ($("#btnMnu").hasClass('cerrarBarra')) {

            $("#btnMnu").removeClass('cerrarBarra')

            // mover_barra("-250px")
            mover_barra("-"+$("#mnuLateral").width())

        }else{

            $("#btnMnu").addClass('cerrarBarra')

            mover_barra("0")

        }

    });

        //FUNCION PARA MOVER LA BARRA DEL MENU LATERAL EN LA VERSION MOVIL

    function mover_barra(por){

        $("#mnuLateral").animate({
            'margin-left': por
        },500);

        $("#barraLateralMnu").animate({
            'margin-left': por
        },500);

    }

    //FIN DE FUNCIONES PARA EL COMPORTAMIENTO DE MENUS PRINCIPAL
    

    var contador = 1;

    $(window).resize(function(){

        mediaQuery();

    });


    //CERRAR TODOS LOS MENUS
    $(window).click(function(){

        $(".mnuDesplegableOpciones").hide()
        $(".subMnu").hide() 
        mover_barra("-250px")
        $("#btnMnu").removeClass('cerrarBarra')

    })



    $(".abrirCerrarMnu").click(function(event){
        event.stopPropagation();

        $(".mnuDesplegableOpciones").hide()

        var indexMnu = $(this).index()
        var indexSubMnu=0;
        if(indexMnu==3){indexSubMnu=0}
        if(indexMnu==4){indexSubMnu=1}
        if(indexMnu==5){indexSubMnu=2}
        if(indexMnu==6){indexSubMnu=3}

        $(".mnuDesplegableOpciones").eq(indexSubMnu).fadeIn('fast')
    })

    $(".mnuDesplegableOpciones").click(function(event){
        event.stopPropagation();
        $(".mnuDesplegableOpciones").hide()
    })

    $(".btnSession").click(function(event){
        event.stopPropagation()
        $(".mnuDesplegableOpciones").hide()

        //$(".subMnu").fadeIn("fast")
         $(this).next('ul .subMnu').first().fadeIn("fast")
    })

    $(".btnPerfil").click(function(event){ 
        event.stopPropagation()
        $(".mnuDesplegableOpciones").hide()
        
        $(this).next('ul .subMnu').first().fadeIn("fast")
    })
//FUNCIONES BARRA LATERAL

    $(".btnSession2").click(function(event){
        event.stopPropagation()
        $(".mnuDesplegableOpciones").hide()

        $(".subMnu").slideToggle("fast")
    })

    $("#barraLateralMnu").click(function(event){
        event.stopPropagation()
    })

    $("#mnuLateral").click(function(event){
        event.stopPropagation()
    })
}


function mediaQuery(){
    // console.log($(window).width());
    $("#mnuDespSesion").css("display","none");                 

    if ($(window).width()>1024) {
        $("#mnuLateral").attr('style', '');
        $("#btnMnu").removeClass('cerrarBarra')
        $("#barraLateralMnu").attr('style', '');
        $("#contenido").attr('style', '');
        contador = 1;

        $("#btnMnu").css("display","none");


    }else{
        $("#btnMnu").css("display","inline-block");

    }
}


// function activarLoader(){
//     setInterval(function(){
//         $("#load").css("transform","rotate(180deg)");
//     },500);
// }