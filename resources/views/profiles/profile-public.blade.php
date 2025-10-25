@extends('layouts.dashboard')

@section('content')

<div class="container">

@if( $not_found )
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Public Profile</h1>

            <h1>Example heading <span class="label label-info"> Profile not found</span></h1>
        </div>

    </div>
@else
     <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Public Profile</h1>
            
            <div>

                <h2>Teacher Profile</h2>

                <p>{{{ $teacher_profile->about }}}</p>
                 <p>{{{ $teacher_profile->about_short }}}</p>
                 <p>{{{ $teacher_profile->videoUrl }}}</p>

            </div>
            
        </div>

    </div>
    
@endif    
</div>

@endsection

@push('scripts')
   
@endpush