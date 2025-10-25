/*var posicionSlider = 0;
var intv;
var pos = 0;
*/

var i=0;
var control;

$(document).ready(iniciarSlider);

function iniciarSlider(){

    //$("#registroUsuario").hide();

    //$("#registroUsuario").fadeIn("fast");

    $(window).load(animateFlechasDir);

    animateTituloSlide();
    asignarImagen();

    $(".controles li").click(moverSlides);

    clearInterval(control);

    control = setInterval(moverSlides,5000);
}


function moverSlides(){

    //$(".tituloSlider").slideUp();
    animateTituloSlide2();


    var boton;

    if ($(this).parent().hasClass('controles')) {
        boton = $(this).index();        
                
        switch(boton){
            case 1:            
                --i;   
            break

            case 0:
                i++;
            break
        }

        clearInterval(control);
        control = setInterval(moverSlides,7000);
 
    }else{
        
        i++;
    }

    //console.log(i);
    if (i==$(".slides").length) {
        i = 0;
        //console.log("igual a slides "+i);
    }else if(i<0){
        i=$(".slides").length -1;
        //console.log("menor a slides "+i);
    }

    $(".slides").hide();
    $(".slides").eq(i).fadeIn('slow',function(){
        animateTituloSlide();
        animateFlechasDir();
    });
}


function animateTituloSlide(){
    $(".tituloSlider").animate({
        'margin-top': '120px',
        'opacity': '1'
    },700);

    

    //$(".descSlide").fadeIn(1000);
    setTimeout(function(){
        $(".descSlide").animate({
        'left': '0',
        'opacity': '1'
        },500);
    },700)
}


function animateTituloSlide2(){
    $(".tituloSlider").animate({
        'margin-top': '-50px'
    },1);

    $(".descSlide").css("left","-50px");
    $(".descSlide").css("opacity","0");

    $(".controles .atras").css('left','-10px');
    $(".controles .atras").css('opacity','0');

    $(".controles .adelante").css('right','-10px');
    $(".controles .adelante").css('opacity','0');

    /*$(".descSlide").animate({
        'left': '-500px',
        'opacity': '0'
    },1);*/


    //$(".descSlide").hide();
}

function animateFlechasDir(){
        $(".controles .atras").animate({
            'left': '10px',
            'opacity': '1'
        });

        $(".controles .adelante").animate({
            'right': '10px',
            'opacity': '1'
        });

}

function asignarImagen(){
    var width =$('.slider').width();
    $('.slides').each(function(index,elemento){
        var url = $(elemento).data('background');
        $(elemento).css('width',width+'px');
        $(elemento).css('background-image','url('+url+')');
    });
}