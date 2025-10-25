$(document).ready(function(){
    
    var app_id = '1017412894941181';
    var scopes = 'email, user_friends, user_online_presence';

    var btn_login ='<a href="#" id="btnFacebook" id="login" class="btn btn-primary">Log In con Facebook</a>';

    var div_session = '<div id="facebook-session">'+
                      '<strong></strong>'+
                      '<img>'+
                      '<a href="#" id="logout" class="btn btn-danger">Logout</a>'+
                      '</div>';

    window.fbAsyncInit = function() {
      FB.init({
        appId      : app_id, //variable app_id creada en la parte superior del archivo
        status     : true,
        cookie     : true,                             
        xfbml      : true,  
        version    : 'v2.1' 
      });

      FB.getLoginStatus(function(response) {
        statusChangeCallback(response, function(){

        });
      });

    };

  var statusChangeCallback = function(response,callback) {
    console.log('statusChangeCallback');
    console.log(response);

    if (response.status === 'connected') {
        getFacebookData();
    } else {

        callback(false);
      //document.getElementById('status').innerHTML = 'Please log ' +
        //'into Facebook.';
    }
  }

  var checkLoginState = function(callback) {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response,function(data){
        callback(data);
      });
    });
  }

  var getFacebookData = function(){
    FB.api('/me', function(response){
        $("#login").after(div_session);
        $("#login").remove();
        $('#facebook-session strong').text("Bienvenido: "+response.name);
        $('#facebook-session img').attr('src','http://graph.facebook.com/'+response.id+'/picture?type=large');
    }) 
  }

  var facebookLogin = function(){
    checkLoginState(function(response){
        if (!response) {
            FB.login(function(response){
                if (response.status === 'connected'){
                    getFacebookData();
                }
            }, {scope: scopes});
        }
    })
  }

  var facebookLogout = function(){
    FB.getLoginStatus(function(response) {
        if (response.status ==='connected') {
            FB.logout(function(response){
                $('#facebook-session').before(btn_login);
                $('#facebook-session').remove();
            })
        }
    });
  }


$(document).on('click','#login',function(e){
  e.preventDefault();
  facebookLogin();
})

$(document).on('click','#logout',function(e){
    e.preventDefault();
    if (confirm("¿Está seguro de cerrar la sesión?")) {
        facebookLogout();
    }else{
        return false;
    }
    
})

});