
<div style="min-height:1.2em;"></div>


<div class="row">
    <div class="col-md-12">

      <!-- tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" ><a href="#sesiones" aria-controls="sesiones" role="tab" data-toggle="tab">Sesiones</a></li>
        <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages <span class="badge">100</span></a> </li>
        <li role="presentation" class="active"><a href="#estado_cuenta" aria-controls="estado_cuenta" role="tab" data-toggle="tab">Estado Cuenta</a></li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane" id="sesiones">
          @include('dashboard.alumno-sesiones',['sesiones' => $sesiones,'session_constants'=> $session_constants ])
        </div>
        <div role="tabpanel" class="tab-pane" id="messages">

        </div>

       <div role="tabpanel" class="tab-pane  active" id="estado_cuenta">
            @include('dashboard.estado-cuenta') 
        </div>
      </div>

    </div>

</div>

@push('scripts')
    <script src="js/ps_alumno.js"></script>
@endpush