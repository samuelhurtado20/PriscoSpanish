

<form action="{{ url('postTeacherProfile') }}" name="teacher-profile" role="form" method="POST">
        {!! csrf_field() !!}
    
        <h2>Teacher Profile</h2>

         <div class="form-group {{ $errors->has('intro') ? ' has-error' : '' }}">
            <label for="intro">About:</label>
             <textarea class="form-control" rows="3" id="intro" name="intro" class="form-control" > {{{ $teacher_profile->about }}} </textarea>
                @if ($errors->has('intro'))
                <span class="help-block">
                    <strong>{{ $errors->first('intro') }}</strong>
                </span>
                @endif
    
        </div>
         
         
         <div class="form-group {{ $errors->has('short_intro') ? ' has-error' : '' }}">
             <label for="short_intro">Short Intro:</label>
             <textarea class="form-control" rows="3" id="short_intro" name="short_intro" class="form-control" >{{{ $teacher_profile->about_short }}}</textarea>
               @if ($errors->has('short_intro'))
                <span class="help-block">
                    <strong>{{ $errors->first('short_intro') }}</strong>
                </span>
                @endif
         </div>

         
      
         
         <div class="form-group {{ $errors->has('vid_url') ? ' has-error' : '' }}">
          <label for="address">Intro Video</label>
          <input type="text" id="vid_url"  name="vid_url" class="form-control" value="{{{$teacher_profile->videoUrl}}}">
                @if ($errors->has('vid_url'))
                <span class="help-block">
                    <strong>{{ $errors->first('vid_url') }}</strong>
                </span>
                @endif
    
            </div>
         

     <input type="submit" class="btn btn-primary" value="Save Profile">

</form>
               
