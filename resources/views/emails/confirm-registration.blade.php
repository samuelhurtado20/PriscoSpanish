<?php 
  /**
    Esto es un formato para el correo que se envia para confirmar la subscripcion
    el controlador es MailController
  */
?>
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
     <title>PriscoSpanish</title>
    
     @include('head_common')
    
    <!-- Styles -->
   
    <link rel="stylesheet" href="css/estilo.css">
    
    
   
     
     <style>
          input[type="text"],input[type="password"]{
               background: #fff !important
          }
     </style>
</head>
<body>
	 <h1>PriscoSpanish - Mail Confirmation</h1>
    
    {{ $user->name }}<br>
    
    <p>
    	You are receiving this email, in order to confirm your registration process
    	at www.PriscoSpanish.com .
    	
    </p>	
   	<p>
   		To confirm your subscription, please click  the following link.
   	</p>
       <a href="{{ $confirm_url }}">{{ $confirm_url }}</a>
    
    <p>
   		You can also copy and paste the following url to your browser addresss bar.
   	</p> 
   	
   	<div>
   	{{ $confirm_url }}
   	</div>


	<p>
		If you didn't request access to PriscoSpanish site, please send us an email to
		unwanted-register@priscospanish.com.
	</p>
	
	PriscoSpanish Llc.
</body>
</html>