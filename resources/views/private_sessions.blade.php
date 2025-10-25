@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            
           <div id="contenedorLecciones">
                <div id="presentacionLecciones">
                    <div  id="fondoO"></div>
                    <div id="tutores">
                        <p id="cerrarTutor"></p>

                        <div id="listaTutores">


                            <?php 
                            /*
                                $cant=1;

                                while ($cant<=1) {
                                */
                            ?>

                                <div class="contT">
                                    <a href="#">
                                        <div class="tutor">
                                            <div class="fondoTitulo"></div>
                                            <img src="img/autor.png" alt="">

                                        </div>
                                        <span>Adelis Prisco</span>
                                    </a>
                                </div>

                            <?php
                            /*
                                $cant=$cant+1;
                                }
                                */
                            ?>

                        </div>
                    </div> 

                    <div id="mensajeTituloLeccion">
                        <!-- <h1>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h1> -->
                        <h1>Language learning anytime, and anywhere</h1>
                        <a class="btn btn-warning" href="{{url('/reservations')}}" id="reservarAhora">Book now your Private Lesson</a>
                    </div>

                    <button id="fAbajo"></button>
                    <label for="fAbajo" id="tutoress">Conoce a tus Profesores</label>
                </div>

    <div id="textoPresentacion">
        <div id="imgTestimonio">
            <img src="img/autor.png" alt="">
        </div>
        <p><label>"</label>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum commodi sed deserunt soluta sapiente in itaque voluptatibus, ratione dicta totam excepturi perferendis, facilis at ab repellendus quas, optio corporis consequatur. <span>Founder.</span></p>
    </div>

    </div>
            
            
            
            
        </div>
    </div>
</div>


@push('scripts')    

    <script>

        $(document).ready(function() {
            $(".btnComprar").click(function(){
                // $("#descReserva").animate({"margin-left":"30px","opacity":"1"},700);
                    $.ajax({
                //data: parametros,
                            url: "/jose",
                            type:  'get',
                            beforeSend: function () {
                                    $("#contenido").html("<img id='load' style='position:absolute; margin-top:20%; margin-left: 45%; width: 64px; height: 64px;' src='img/Preloader.gif'>");
                            },
                            success:  function (response) {
                                    $("#contenido").html(response);
                            }
                    });
            });

            $("#fAbajo").hover(function(){$("#tutoress").fadeIn("fast")},function(){$("#tutoress").fadeOut("fast")})

            $("#fAbajo").click(function(){
                $("#tutores").fadeIn("fast")
                $("#mensajeTituloLeccion").fadeOut("fast")
                $(this).hide()
            })

            $("#cerrarTutor").click(function(){
                $("#tutores").fadeOut("fast")
                $("#fAbajo").fadeIn("fast")
                $("#mensajeTituloLeccion").fadeIn("fast")
            })

           


        });

        
    </script>
@endpush

@endsection
