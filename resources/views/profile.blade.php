@extends('layouts.dashboard')

@section('content')

<div class="container">


    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Profile</h1>
            
            <div>
                <p>See my public profile:</p>
                
                <?php if ( isset($public_profile_id) && !empty($public_profile_id) ):  ?>
                    <a href="{{ url('/profiles/'.$public_profile_id) }}" target="_blank" >{{ url('/profiles/'.$public_profile_id) }} <span class="glyphicon glyphicon-new-window"></span></span></a>
                <?php else: ?>
                    <p class="text-danger">Your profile Id doesn't exists, please contact support</p>
                <?php endif; ?>    
            </div>
            @if($is_teacher)
                @include('form-account-teacher-profile',['teacher_profile'=>$teacher_profile]);
            @endif
        </div>

    </div>
    
</div>

@endsection

@push('scripts')
   
@endpush