

<div class="row">
    <div class="col-md-12">
            <h1>Teaching sessions</h1>
            <hr>
    </div>
</div>

    <div class="row">
       <div class="col-md-12">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Name</th>
                        <th>Language</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Student</th>
                        <th>price</th>
                    </tr>
                </thead>
  
                    <tbody>
                   
                    @foreach ($sesiones_profesor as $s)
                        <tr class="session-row" data-toggle="modal" data-target="#ps_session_modal" data-session="{{$s->id}}" style="cursor:hand;">
                            <td> {{ $s->status }}</td>
                            <td> {{ $s->offer->nombre }}</td>
                            <td> {{ $s->language }} </td>
                            <td> {{ $s->start }}</td>
                            <td> {{ $s->end }}</td>
                            <td> {{ $s->users->find($s->user_id)->first()->name }}</td>
                            <td> {{ $s->price }}</td>
                        </tr>
                    @endforeach
                    </tbody>
            </table>
    	</div>
    </div>


<!-- Modal -->
<div class="modal fade" id="ps_session_modal" tabindex="-1" role="dialog" aria-labelledby="ps_ModalLabel" data-session="">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="ps_ModalLabel">Sesion Detail</h4>
        <h3 id="data-nombre">-</h3>
        
         <div class="pull-left"> <span>Teacher:</span> <span id="data-profesor"> - </span> </div>
        
         <div  class="pull-right"> <span>Language:</span> <span id="data-idioma"> - </span> </div>
       
      </div>
      <div class="modal-body">
		<form id="accion_sesion" name="accion_sesion" method="post">
                        {!! csrf_field() !!}
		        <input type="hidden" name="sesion_n" value="el_Id">
                        <div>
                            <span>Current Status</span>
                            <span id="data-current-status"> </span>
                        </div>
                        <hr>
                        <div style="min-height:40px;" class="panel panel-default">
                            <div class="row">
                                <div class="col-md-6">
                                        <div class="checkbox">
                                        <label>
                                                <input type="checkbox" id="completada_profesor" name="completada_profesor">Completed - Teacher
                                        </label>
                                        </div>
                                </div>
                               
                                <div class="col-md-6">
                                    <div class="checkbox">
                                        <label>
                                                <input type="checkbox" id="completada_alumno" name="completada_alumno" disabled>Completed - Student
                                        </label>
                                    </div>
                                </div>
                                
                            
                            </div>
                        </div>
                </form>
			
			
            <ul class="list-group">
                    <li class="list-group-item"><span>Start</span> <span id="data-inicio"></span></li>
                    <li class="list-group-item"><span>end</span>  <span id="data-final"></span></li>
                    <li class="list-group-item"><span>Price</span> <span id="data-precio"></span></li>
            </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <input class="btn btn-success" type="submit" value="Guardar Cambios!" id="submit">
      </div>
    </div>
  </div>
</div>

