 
<form action="{{ url('accPostPicture') }}" name="formCImagen" method="POST" enctype="multipart/form-data">
 {!! csrf_field() !!}

     <h2>Profile Picture</h2>

    {{--   La imagen predeterminada esta en la carpeta public--}}
    <?php IF ( isset($usuario->avatar) && !empty($usuario->avatar) ): ?>
        <img src="{{url('profileImgs/'.$usuario->avatar)}}"/>
    <?php else: ?>
        <img src="{{url('/img/img_perfil.jpg')}}"/>
    <?php endif; ?>

    <hr>
    <div class="form-group">
        <div class="btn btn-default">
            <label for="profilePicture">Upload Image:</label>

            <input type="file" id="profilePicture" name="profilePicture" accept="image/*">
        </div>
        
        
        @if ($errors->has('profilePicture'))
            <span class="help-block">
                <strong>{{ $errors->first('profilePicture') }}</strong>
            </span>
        @endif
    </div>

  
    
     <input type="submit" class="btn btn-primary" value="Save Picture">

</form>