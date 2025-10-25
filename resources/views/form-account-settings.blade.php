 
<form action="{{ url('accSettings') }}" name="formCuenta2" class="formCuenta2" method="POST">
 {!! csrf_field() !!}

     <h2>Change Password</h2>

    <div class="form-group">
         <label for="txtClaveActual">current Password:</label>
         <input type="password" class="form-control" name="claveActual" id="claveActual">
        @if ($errors->has('claveActual'))
            <span class="help-block">
                <strong>{{ $errors->first('claveActual') }}</strong>
            </span>
        @endif
        
    </div>
    
    <div class="form-group">
        <label for="txtNuevaClave">New Password:</label>
         <input type="password" class="form-control" name="nuevaClave" id="nuevaClave">
         @if ($errors->has('nuevaClave'))
            <span class="help-block">
                <strong>{{ $errors->first('nuevaClave') }}</strong>
            </span>
        @endif
    </div>
    
    <div class="form-group">     
        <label for="nuevaClave_confirmation">Confirm Password:</label>
        <input type="password" class="form-control" name="nuevaClave_confirmation" id="nuevaClave_confirmation" >
         @if ($errors->has('nuevaClave_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('nuevaClave_confirmation') }}</strong>
            </span>
        @endif
    </div>
    
    <input type="hidden" name="funcion" value="2">

<!--                          <br>
     <h2>Notifications <p>Set the destination to send you emails</p></h2>
     <hr>
     <br>

     <label for="txtCorreo">Email:</label>
     <input type="text" id="txtCorreo" class="txtCorreo seccionNotif"><br>
     <label for="txtClave">Password:</label>
     <input type="password" id="txtClave" class="txtClave seccionNotif"><br> -->

     <input type="submit" class="btn btn-primary" value="Setting Save">

</form>