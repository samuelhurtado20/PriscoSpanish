 <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
        {!! csrf_field() !!}
       <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

            <div class="col-md-12">
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name">

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
     
        <div class="form-group{{ $errors->has('apellido') ? ' has-error' : '' }}">

            <div class="col-md-12">
                <input type="text" class="form-control" name="apellido" value="{{ old('apellido') }}" placeholder="Last Name">

                @if ($errors->has('apellido'))
                    <span class="help-block">
                        <strong>{{ $errors->first('apellido') }}</strong>
                    </span>
                @endif
            </div>
        </div>
     
       <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

            <div class="col-md-12">
                <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
     
     
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <!-- <label class="col-md-4 control-label">Last Name</label> -->

            <div class="col-md-12">
                <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="password">

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>
     
        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">

            <div class="col-md-12">
                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">

                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>
        </div>

       <input type="hidden" name="idFacebook" id="idFacebook" >
     
        <div class="form-group">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-btn fa-user"></i>SIGN UP
                </button>
            </div>
        </div>
 
       <div id="sep"></div>
       <a href="#" class="loginSesion" data-toggle="modal" data-target="#loginModal">I have an account</a>

       <div class="clearfix"></div>

  </form>