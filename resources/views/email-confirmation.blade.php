@extends('layouts.basic')

@section('content')

<div style="min-height:1.2em;"></div>


<div class="row">
    <div class="col-md-4 col-md-offset-4">
    
 @if($success)   
        <h1>Register Sucessfull!</h1>
        <p>
            Thanks for register.     
        </p>
        <p>
        	Your email account has been validated. 
        </p>
        
        <p>
        	please go to <a href="{{ url('/') }}">www.priscospanish.com</a>
        </p>
        
@else
       <h1>Email not confirmed!</h1>
        <p>
            In order to complete your registration process, we need to verify your
            email account. An email has been sent to your registered account.
            In order to validate the registrer please check your inbox and
            complete the registration process by clicking the provided link.
        </p>

@endif
    </div>






</div>
@endsection

@push('scripts')
   
@endpush