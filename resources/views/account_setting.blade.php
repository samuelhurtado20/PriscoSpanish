@extends('layouts.dashboard')
@section('content')



@push('csss')
    <link rel="stylesheet" href="css/setting.css">
@endpush

<!-- contenido -->

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-2">
             @include('form-account-image',['usuario'=>$user])
        </div>    
            
        <div class="col-md-4 col-md-offset-1">
             <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#details" aria-controls="details" role="tab" data-toggle="tab">Account Detail</a></li>
                <li role="presentation">
                    <a href="#settings" aria-controls="setting" role="tab" data-toggle="tab">Accout Setting</a></li>
            </ul>


            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="details">
                    @include('form-account-detail',['usuario'=>$user])
                </div>

                <div role="tabpanel" class="tab-pane" id="settings">
                    @include('form-account-settings')
                </div>
            </div>
        
        </div>


    </div>
    
</div>

@endsection

@push('scripts')    
<script>


</script>
@endpush