@extends('layouts.dashboard')

@section('content')

<div style="min-height:1.2em;"></div>


<div class="container">

    <div class="row">
        <div class="col-md-8 col-md-offset-4">
            <h1>My Goals</h1>
    
            <form method="post" action="{{url('/postGoals')}}"> 
                {!! csrf_field() !!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('groupSessions') ? ' has-error' : '' }}">
                            <label for="groupSessions">Group Sessions</label>
                            <input type="text" class="form-control" name="groupSessions" id="groupSessions" placeholder="0" value="{{ $goals->group_sessions_goal }}">
                           @if ($errors->has('groupSessions'))
                            <span class="help-block">
                                <strong>{{ $errors->first('groupSessions') }}</strong>
                            </span>
                            @endif
                        
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3>Current: <span class="label label-default"> {{ $goals->group_sessions_attended  or '0'}} </span></h3>
                    </div>
                </div>
                
                
                 <div class="row">
                    <div class="col-md-6">
                         <div class="form-group  {{ $errors->has('privateSessions') ? ' has-error' : '' }}">
                            <label for="privateSessions">Private Sessions</label>
                            <input type="text" class="form-control" name="privateSessions" id="privateSessions" placeholder="0" value="{{ $goals->private_sessions_goal }}">
                            @if ($errors->has('privateSessions'))
                            <span class="help-block">
                                <strong>{{ $errors->first('privateSessions') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3>Current: <span class="label label-default"> {{ $goals->private_sessions_attended or '0' }} </span></h3>
                    </div>
                </div>
                
               
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group  {{ $errors->has('takenTests') ? ' has-error' : '' }}">
                            <label for="takenTests">Tests Taken</label>
                            <input type="text" class="form-control" name="takenTests" id="takenTests" placeholder="0" value="{{ $goals->exams_goal }}">
                            @if ($errors->has('takenTests'))
                            <span class="help-block">
                                <strong>{{ $errors->first('takenTests') }}</strong>
                            </span>
                            @endif
                        
                        </div>
                    </div>
                    <div class="col-md-6">
                       <h3>Current: <span class="label label-default"> {{ $goals->exams_attended or '0' }}</span></h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <input type="submit" class="form-control btn btn-primary" value="Submit">
                    </div>
                </div>
            </form>
            
        </div>

    </div>


</div>
@endsection

@push('scripts')
   
@endpush