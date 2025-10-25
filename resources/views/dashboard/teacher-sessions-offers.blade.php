
    <div class="row">
    <div class="col-md-12">
        <h1>My Session Offers <a id="agregar_sesion" href="#" class="btn btn-primary" data-toggle="modal" data-target="#ps_editar_session_modal" data-nuevo="1" data-titulo="Add Session"><span class="glyphicon glyphicon-plus"></span>  Add </a></h1>
        <hr>
    </div>
    </div>


    <div class="row">
       <div class="col-md-12">
            <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>language</th>
                        <th>description</th>
                        <th>price</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tfoot>
                  <tr>
                     <td colspan="5">
                        Message
                     </td>  
                  </tr>    

                </tfoot>    
                <tbody>
                @foreach ($oferta_sesiones as $s)
                    <tr>
                                <td>{{ $s->nombre }}</td>
                                <td>{{ $s->idioma }}</td>
                                <td>{{ $s->descripcion }}</td>
                                <td>{{ $s->precio_individual_60 }}</td>
                                <td>

                                    <div class="dropdown">
                                        <a id="dLabel" href="#" class="btn btn-warning" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="glyphicon glyphicon-cog"></span> 
                                            <span class="caret"></span>
                                        </a>


                                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                                            <li><a class="editar_sesion" href="#" data-toggle="modal" data-target="#ps_editar_session_modal" data-nuevo="0" data-titulo="Editar Sesión" data-id="{{ $s->id }}"> <span class="glyphicon glyphicon-pencil"></span> editar </a></li>
                                            <li role="separator" class="divider"></li>
                                            <li><a class="eliminar_sesion" href="#"   data-toggle="modal" data-target="#ps_eliminar_session_modal" data-id="{{ $s->id }}"> <span class="glyphicon glyphicon-minus"></span> eliminar </a></li>
                                        </ul>
                                    </div>
                                </td>
                        </tr>
                @endforeach
                </tbody>
            </table>
    	</div>
    </div>


{{-- modal editar sesion --}}
<div class="modal fade " id="ps_editar_session_modal" tabindex="-1" role="dialog" aria-labelledby="ps_editar_sesion_ModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
        <img style="max-height:40px;" class="pull-left" src="img/logo.png" alt="">

        <h4 class="modal-title" id="ps_editar_sesion_ModalLabel"><span class="glyphicon glyphicon-plus"></span> Add Session</h4>
        
        <p>Here you can add your session offer</p>
      </div>
         
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                
                <form style="width:100%;" id="accion_editar_sesion" name="accion_editar_sesion" method="post">
                	{!! csrf_field() !!}
                   <input type="hidden" name="sesion_n" value="el_Id">

                    <div class="form-group">
                        <label for="input_idioma_sesion">Language</label>
                        <select class="form-control" id="input_idioma_sesion" name="input_idioma_sesion">
                            <option value="Spanish" SELECTED>Spanish</option>
                            <option value="English">English</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="input_nombre_sesion">Name</label>
                        <input type="text" class="form-control" id="input_nombre_sesion" name="input_nombre_sesion" placeholder="Session name">
                        <span class="help-block"></span>
                    </div>

                    <div class="form-group">
                        <label for="input_nombre_sesion">20 Minutes Test Session Price (USD)</label>
                        <input type="text" class="form-control" id="input_precio_sesion" name="input_precio_sesion" placeholder="0">
                        <span class="help-block"></span>
                    </div>
                {{--
 				    <div class="form-group">
                        <label for="input_nombre_sesion_2">30 Minutes Session Price (USD)</label>
                        <input type="text" class="form-control" id="input_precio_sesion_1" name="input_precio_sesion_1" placeholder="0">
                        <span class="help-block"></span>
                    </div>
                --}}    
                    <div class="form-group">
                        <label for="input_nombre_sesion_2">60 Minutes Session Price (USD)</label>
                        <input type="text" class="form-control" id="input_precio_sesion_2" name="input_precio_sesion_2" placeholder="0">
                        <span class="help-block"></span>
                    </div> 
                {{--    
                    <div class="form-group">
                        <label for="input_precio_sesion_paquete_1">5 x 30 Minutes Session Package Price (USD)</label>
                        <input type="text" class="form-control" id="input_precio_sesion_paquete_1" name="input_precio_sesion_paquete_1" placeholder="0">
                        <span class="help-block"></span>
                    </div> 
                --}}   
                     <div class="form-group">
                        <label for="input_precio_sesion_paquete_2">5 x 60 Minutes Session Package Price (USD)</label>
                        <input type="text" class="form-control" id="input_precio_sesion_paquete_2" name="input_precio_sesion_paquete_2" placeholder="0">
                        <span class="help-block"></span>
                    </div> 
                    
                    <div class="form-group">
                        <label for="input_descripcion_sesion">Description</label>
                        <textarea class="form-control" id="input_descripcion_sesion" name="input_descripcion_sesion" placeholder="Description" cols="45" rows="5"></textarea>
                        <span class="help-block"></span>
                    </div>
 
                </form>
         
            </div>
        </div><!-- /row -->
			
      </div>
      
      <div class="modal-footer">
          <div class="row">
            <div class="col-md-12">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input class="btn btn-success" type="submit" value="Save Changes!" id="submit">
            </div>
          </div>         
      </div><!-- ./footer -->

    </div>
  </div>
</div>


{{-- modal eliminar sesion --}}

<div class="modal fade" id="ps_eliminar_session_modal" tabindex="-1" role="dialog" aria-labelledby="ps_eliminar_sesion_ModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
        <img style="max-height:40px;" class="pull-left" src="img/logo.png" alt="">
        <hr>
        <h4 class="modal-title" id="ps_eliminar_sesion_ModalLabel"><span class="glyphicon glyphicon-minus"></span> Delete Session</h4>
      </div>
      
      <div class="modal-body">
          <div class="row">
                <div class="col-md-12">
                    <p>
                    please check below to confirm.
                    </p>
                    <form id="accion_eliminar_sesion" name="accion_eliminar_sesion" method="post">
                           <input type="hidden" name="sesion_n" value="el_Id">

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="confirmar_eliminacion">I'm Sure
                                </label>
                            </div>
                        </form>
                </div>
          </div>

      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input class="btn btn-success" type="submit" value="Delete" id="eliminar_sesion_submit">
      </div>
      
    </div>
  </div>
</div>

{{-- Alerta de tarea completada satisfactoriamente --}}

<div class="modal fade" id="success_alert" tabindex="-1" role="dialog" aria-labelledby="success_alert_ModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
        <img style="max-height:40px;" class="pull-left" src="img/logo.png" alt="">
        <hr>
        <h4 class="modal-title" id="success_alert_ModalLabel"><span class="glyphicon glyphicon-minus"></span> Task completed</h4>
      </div>
      
      <div class="modal-body">
          <div class="row">
                <div class="col-md-12">
                    <p>Task Successfull</p>
                </div>
          </div>

      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Dismiss</button>
      </div>
      
    </div>
  </div>
</div>

{{-- alerta de error --}}

<div class="modal fade" id="error_alert" tabindex="-1" role="dialog" aria-labelledby="error_alert_ModalLabel">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
    
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
        <img style="max-height:40px;" class="pull-left" src="img/logo.png" alt="">
        <hr>
        <h4 class="modal-title" id="error_alert_ModalLabel"><span class="glyphicon glyphicon-minus"></span> Task Failed</h4>
      </div>
      
      <div class="modal-body bg-danger">
          <div class="row">
                <div class="col-md-12 ">
                   <p>The requested operation can't be executed. Please try again later.</p>
                   <p>If the failure persists please contact the site administrator.</p>
                </div>
          </div>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Dismiss</button>
      </div>
      
    </div>
  </div>
</div>

