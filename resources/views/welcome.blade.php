<?php

?>
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
     <title>PriscoSpanish</title>
    
     @include('head_common')
    
    <!-- Styles -->
   
    <link rel="stylesheet" href="css/estilo.css">
    
     
     <style>
          input[type="text"],input[type="password"]{
               background: #fff !important
          }
     </style>
</head>
<body>

     <div id="ventanaTransparente"></div>

     <div class="fondo-dark"></div>

     <div class="container">

          <!-- ESTA SECCION MOSTRARA TODOS LOS ELEMENTOS QUE SERAN CARGADOS POR EL USUARIO -->

          <section class="ventana hidden">

               <div id="loginUsuario">
               <a href="#" id="cerrarSesion"></a>
               <div id="bannerErrorLogin"><p>There are blanks!</p></div>
               <form action="./" name="frmInicioSesion" id="frmInicioSesion" method="post">

                    <h2>¡Iniciar Sesión!</h2>
                    <a href="#" id="btnFacebook">Log In with Facebook</a>
                    <!-- <span id="signinButton">
                    <span
                    class="g-signin"
                    data-callback="signinCallback"
                    data-clientid="934419190953-nif8ru8qu0c8608ic3n2adtuc1d69ts2.apps.googleusercontent.com"
                    data-cookiepolicy="single_host_origin"
                    data-requestvisibleactions="http://schemas.google.com/AddActivity"
                    data-scope="https://www.googleapis.com/auth/plus.login">
                    </span>
                    </span> -->          
                    <!-- <a href="#" id="btnGoogle">Log In con Google+</a> -->
                    <div id="sep"></div>
                    <p>Please login with your email</p>
                    <input type="text" name="correo" id="correo" class="iptSesion" placeholder="Email">
                    <input type="password" name="clave" id="clave" class="iptSesion" placeholder="Password">
                    <input type="button" name="iniciarSesionUsuario" id="iniciarSesion" value="Log In">
                    <div id="sep"></div>
                    <p>Login problems for? <a href="php/password_recovery">click here</a></p>

                    <div id="msgError" class="errorValLogin"></div>

               </form>
               </div>

               <div id="registroFacebook">
                    <!-- Cuadsro de Dialogo para Enlazar cuenta de Facebook -->
                    <form action="php/variablesSesion.php" id="formDatosFacebook" method="GET">
                           <input type="hidden" name="nombre" id="nombreF">
                           <input type="hidden" name="apellido" id="apellidoF">
                           <input type="hidden" name="sexo" id="sexoF">
                           <input type="hidden" name="idF" id="idF">
                           <input type="hidden" name="correo" id="correoF">
                    </form>
               </div>


          </section> 

          <section class="ventana" id="inicio">

               <div id="cajaHeader">
                    @include('header')
               </div>

               <div class="contInicio">

                    <article>
                         <h1 class="titulo">Language learning at your own pace!</h1>

                    </article>
                    <aside>


                         <div id="registroUsuario">
                              <div class="msjFloat">Congratulations! Now you can create an account and link it to your Facebook or Google +</div>
                              <div id="bannerError"><p>There are blanks!</p></div>

                              <h1>Sign Up free!</h1>
                              <a href='#' id='btnFacebook2' class='btn btn-primary'>Log In with Facebook</a>
                             <hr>

                              <a class="btn btn-danger" href="{{url('auth/google')}}">Login in with Google</a>
                              <div id="sep" style="margin-top:15px;"></div>
                             @include('auth.register')
<?php
                             /*
                              <form action="php/insertar.php" method="GET" name="frmRegistrar" id="frmRegistrar">
                                   <input type="text" name="nombre" id="nombre" class="texto iptRegistro" placeholder="Name">
                                   <input type="text" name="apellido" id="apellido" class="texto iptRegistro" placeholder="Last Name" >
                                   <input type="text" name="correoRegistro" id="correoRegistro" class="texto iptRegistro" placeholder="Email" >
                                   <input type="text" name="confirmarCorreo" id="confirmarCorreo" class="texto iptRegistro" placeholder="Confirm Email" >
                                   <input type="password" name="claveRegistro" id="claveRegistro" class="texto iptRegistro" placeholder="Password" >
                                   <input type="hidden" name="idFacebook" id="idFacebook" >
                                   <input type="button" name="registrar" id="registrar" value="SIGN UP">
                                   <div id="sep"></div>
                                   <a href="#" class="loginSesion">I have an account</a>
                                   <div style="clear:both;"></div>

                              </form>
*/
?>
                         </div>
                        
                        
                        <div>
                           <?php // @include('auth.login'); ?>
                         
                        </div>
                         

                    </aside>

               </div>

          </section>
          <section class="ventana" id="servicio">
               <div class="contServicio cont">
                    <h2>What do we offer?</h2>

                    <div class="servicios">
                         <div class="imgServ"><img src="img/iconos/teachers.png" alt=""></div>
                         <h3><a href="#">NATIVE TEACHERS</a></h3>
                         <p>Our native Spanish teachers are fully trained, professional, and patient who are sure to boost your Spanish skills. We have teachers specializing in writing, speaking, reading, and grammar. </p>
                    </div>
                    <div class="servicios">
                         <div class="imgServ"><img src="img/iconos/horas.png" alt=""></div>
                         <h3><a href="#">CLASSES 24/7</a></h3>
                         <p>Our unique 24/7 system entails private sessions, class sessions, as well as written sessions. No matter where you are, you can take sessions anytime on any day.</p>
                    </div>
                    <div class="servicios">
                         <div class="imgServ"><img src="img/iconos/tools.png" alt=""></div>
                         <h3><a href="#">STUDY TOOLS</a></h3>
                         <p>Our study tools include lecture videos, written explanations, as well as peer-shared learning through our public forums.</p>
                    </div>
                    <div class="servicios">
                         <div class="imgServ"><img src="img/iconos/groupL.png" alt=""></div>
                         <h3><a href="#">GROUP LESSONS</a></h3>
                         <p>Our group sessions achieve more cost-effective and quality learning, as 5 to 10 students are assigned to a teacher.</p>
                    </div>

               </div>
          </section>
          <section class="ventana" id="testimonio">
               <div class="contTestimonio cont">
                    <h2>TESTIMONIALS</h2>
                    <div class="clientes left">
                         <div class="cliente">
                              <div class="imgC"><img src="img/autor.jpg" alt=""></div>
                              <h4>ADELIS PRISCO</h4>
                         </div>
                         <div class="msj">
                              <div class="contMsj">
                                   <p>I feel honored to have this website as a testimony for our 21st century Spanish learning. I am confident that our service will suit your needs and you will not only be learning but also discovering the privileges of speaking Spanish.</p>
                              </div>
                         </div>
                    </div>
                    <div class="clientes right">
                         <div class="msj">
                              <div class="contMsj">
                                   <p>Adelis has been an understanding, patient teacher that helped me achieve fluency in just 5 months. The challenge of Spanish at first seemed insurmountable, but thanks to his pedagogy I was able to improve step by step under his instruction and now I am ever more confident with speaking Spanish!</p>
                              </div>
                         </div>
                         <div class="cliente">
                              <div class="imgC"><img src="img/testi.jpg" alt=""></div>
                              <h4>ROBERT TAKASHIMA</h4>
                         </div>
                    </div>
                    <div class="clientes left">
                         <div class="cliente">
                              <div class="imgC"><img src="img/testi2.jpg" alt=""></div>
                              <h4>EWAIN WILSON</h4>
                         </div>
                         <div class="msj">
                              <div class="contMsj">
                                   <p>Adelis Prisco has not only been my Spanish teacher, but also he has been my good friend. I can´t express how thankful I am that my Spanish is now at an advanced level. You were the first example in how Spanish can bring together friendships and I will surely be making more friends using the Spanish imparted from you.</p>
                              </div>
                         </div>
                         
                    </div>
               </div>
          </section>
          <section class="ventana" id="contacto">
               <div class="contContactos cont">
                    <h2>CONTACT</h2>

                    <form action="" method="post" id="frmContact">
                         <div class="msjErrorContact exito">There are spaces in blank!</div>
                         <input type="text" id="nombreC" class="objContact" placeholder="NAME">
                         <input type="text" id="correoC" class="objContact" placeholder="EMAIL">
                         <input type="text" id="asuntoC" class="objContact" placeholder="BUSINESS"><br>
                         <textarea id="mensajeC" class="objContact" placeholder="MESSAGE" maxlength="250"></textarea><br>
                         <input type="button" class="objContact" id="btnEnviarC" value="SEND MESSAGE">
                         <div class="clear"></div>
                    </form>
               </div>
          </section>
        @include('footer')
     </div>
    
     @include('auth.login') 
    
    
     
     <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script type="text/javascript" language="javascript" src="js/validarCampos.js"></script>
    <script type="text/javascript" language="javascript" src="js/valRegistro.js"></script>
     <script type="text/javascript" language="javascript" src="js/valLogin.js"></script> 
     <script src="js/form_contacto.js"></script>
     <script type="text/javascript" src="js/animatescroll.min.js"></script>
     <script src="js/main.js"></script>
     <script>
        var vDashboard = "home"

          $(document).ready(function(){

               iniciarValRegistro();
               iniciarValLogin();
               iniciarFormContacto()

               // CONFIGURAR EFECTO PARALAX EN IMAGEN DE FONDO

               $(window).scroll(function(event) {
                    var barra = $(window).scrollTop()
                    var posicion = barra * 0.10;
              
                    $("body").css('background-position', '0 -'+posicion+"px");

                    if (barra >= 70) {

                         $("header").addClass('fija')

                         $("header").animate({
                              top: 0
                         },600)

                    }else{
                         $("header").removeClass('fija')
                         $("header").removeAttr('style')
                         $("header").stop()
                    }

               });

               // CAMBIAR VALORES AL CAMBIAR DE DIMENCION DE VENTANA
                    
               $(window).resize(function(event) {

                    if ($(window).width()>768) {
                        $("nav").removeAttr('style') 
                    }

               });

               // CONFIGURAR HEADER EN MOVIMIENTO DE SCROLL             

               $("#mnInicio").click(function(){
                    $('#inicio').animatescroll({scrollSpeed:1000});
               });

               $("#mnServicio").click(function(){
                    $('#servicio').animatescroll({scrollSpeed:1000});
               });

               $("#mnTestimonio").click(function(){
                    $('#testimonio').animatescroll({scrollSpeed:1000});
               });

               $("#mnContacto").click(function(){
                    $('#contacto').animatescroll({scrollSpeed:1000});
               });

               // EFECTO PARA ANIMAR CUADRO DE REGISTRO

               setTimeout(function(){
                    $("aside").animate({
                         opacity: '1',
                         right: '0'
                    },800);
               },1200);

               // EVENTO DE BOTON PARA DESPLIEGUE DE MENU
               $(".botonMenu").click(function(){

                    $("nav").slideToggle("slow")

               })

/*               // MOSTRAR VIDEO PROMOCIONAL
               setTimeout(function(){
                    $("#ventanaTransparente").fadeIn("fast");
                    $("#ventanaTransparente").height($(window).height);
                    $(".contVideo").fadeIn("fast")
                    $("#cerrarSesion").fadeIn("fast");
               },2000)*/

          });


            function restablecerValoresLF(){
                var ocultar = setTimeout(function(){
                    $(".bannerErrorLogin").fadeOut("fast")
                },5000)
            }

         </script>
         <script src="js/loginFacebook.js"></script>
         <script>

         (function(d, s, id){
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) {return;}
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/en_US/sdk.js";
              fjs.parentNode.insertBefore(js, fjs);
         }(document, 'script', 'facebook-jssdk'));

     </script>
</body>
</html>