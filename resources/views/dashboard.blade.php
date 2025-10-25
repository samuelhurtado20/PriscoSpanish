@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
<!--
           <div id="fondoOscuro">
                <p id="cerrarVideo"></p>
                <div id="contVideoLeccion">
                    <iframe src="" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
  -->          
  
 <!-- -->           
            <div id="contInicio">
        <section id="datosUsuario">
            <div id="perfilUsuario" class="panelesUsuario">
                <div id="imgUser">
                    <img src="<?php //echo  $_SESSION["urlImgUsuario"]; ?>" alt="">
                </div>
                <div id="datos">
                    <p>Welcome,</p>
                    <h2>{{{ $user->name }}}</h2>
                    <a  id="editPerfil" class="btn btn-default" href="{{ url('/profile') }}" role="button">Edit Profile</a>
                    <!-- <button id="editPerfil"  >Edit Profile</button> -->
                    <a id="editMetas" class="btn btn-primary" href="{{ url('/goals') }}">Edit your goals!</a>
                    
                </div>
            </div>
            <div id="progresoUsuario" class="panelesUsuario">
                <aside>
                    <div class="panelesProgreso">
                        <p>Account Setting</p>
                        <input type="text" value="{{ sprintf('%u%%', 0) }}" class="dial" data-width="70" data-thickness=".4" data-fgColor="#008BE8" data-bgColor="#EEEEEE" data-cursor=false data-displayInput="false" data-readOnly=true>
                        <div id="valorProgreso">{{ sprintf('%u%%', 0) }}</div>

                    </div>

                    <div class="panelesProgreso">
                        <p>Taken Tests</p>
                        <input type="text" value="{{ sprintf('%u%%', $exams_current) }}" class="dial" data-width="70" data-thickness=".4" data-fgColor="#24CAA1" data-bgColor="#EEEEEE" data-cursor=false data-displayInput="false" data-readOnly=true>
                        <div id="valorProgreso">{{ sprintf('%u%%', $exams_current) }}</div>

                    </div>

                    <div class="panelesProgreso">
                        <p>Group Sessions</p>
                        <input type="text" value="{{ sprintf('%u%%', $group_sessions_current) }}" class="dial" data-width="70" data-thickness=".4" data-fgColor="#BA18FA" data-bgColor="#EEEEEE" data-cursor=false data-displayInput="false" data-readOnly=true>
                        <div id="valorProgreso">{{ sprintf('%u%%', $group_sessions_current) }}</div>

                    </div>

                    <div class="panelesProgreso">
                        <p>Private Sessions</p>
                        <input type="text" value="{{sprintf('%u%%', $private_sessions_current)}}" class="dial" data-width="70" data-thickness=".4" data-fgColor="#FAA018" data-bgColor="#EEEEEE" data-cursor=false data-displayInput="false" data-readOnly=true>
                        <div id="valorProgreso">{{sprintf('%u%%', $private_sessions_current)}}</div>

                    </div>

                </aside>
                <div style="clear:both;"></div>
            </div>
        </section>
                
        <section id="acdLecciones">
            <div id="encabezado">
                <h1>Lessons</h1>
                <div id="botonesFiltro">
                    
                    <div id="contBotones">
                        <button id="free" class="btnLecciones">Free Videos</button>
                        <button id="full" class="btnLecciones">Full Videos</button>
                    </div>
                    <div style="clear:both;"></div>
                </div>
                <div style="clear:both;"></div>
                <div class="linSep"></div>
            </div>
            <div id="contLecciones">

                <?php 
                    // ver la pagina inicio.php del proyecto original
                    // aqui va la carga de contenido de los videos
                ?>
                
                <br>
                <button class="btnCargar">Load More</button>

            </div>
        </section>
        
                
                <section>
                @if($user->profesor)
                 	@include('dashboard.teacher',['oferta_sesiones' => $oferta_sesiones])
                @else
                	@include('dashboard.alumno')
                @endif 
                </section>
    </div>
            
            
            
            
        </div>
    </div>
</div>



@push('scripts')    
    <script src="js/jquery.color.js"></script>
    <script src="js/jquery.Jcrop.js"></script>
    <script src="js/jquery.knob.js"></script>
 
    <script>
        $(function() {
            $(".dial").knob();
            
            var video,boton;

            $(".lecciones").hover(function(){

                video = $(this).index();
                boton = $(this).index();

                
                $(".imgV").eq(video).css("opacity","1");
                $(".botonesT").fadeOut("fast");


                $(".imgV").eq(video).css("opacity","0.4");
                $(".botonesT", this).fadeIn("fast");

               
            },function(){
                $(".imgV").eq(video).css("opacity","1");
                $(".botonesT", this).fadeOut("fast");
            });

            $(".reproducir").click(function(){
                // var video = $(".reproducir").index()
            
                // ASIGNAR VIDEO
                var url = $(".url").eq(boton).text()
                $("iframe").attr('src', url);
                $("#fondoOscuro").fadeIn("fast");               

            });

            $("#cerrarVideo").click(function(){
                $("#fondoOscuro").fadeOut("fast");
                // $("iframe").attr('src', '');
            });
        });
    </script>
@endpush

@endsection
