function iniciarQueryNotif(){

     $("#chkSelect").click(function(event){ 
          event.stopPropagation();

          if ($("#chkSelect").is(":checked")) {
               $(".detalle-fila").css('background', '#F9F7CD');
               
          }else{
               $(".detalle-fila").removeAttr('style')
          }

          // alert("Dfgdfgdfgdfgfdg")
     })

     $("#btnSelect").click(function(event){
          event.stopPropagation();

          $(".mnuSelect").slideToggle("fast")
          // alert("gggg")
     })

     $(window).click(function(){
          $(".mnuSelect").removeAttr('style')   
     })
}