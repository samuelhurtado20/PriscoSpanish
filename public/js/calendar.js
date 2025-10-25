function queryCalendario(){

     var fc = new Date()
     var nDia = fc.getDate()
     var mesActual = fc.getMonth() + 1
     var numMes = fc.getMonth()
     var anoMax = fc.getFullYear();
     var nMes = numMes + 1

     calcularMes(nMes,anoMax)

     // BOTON ATRAS PARA RETROCENER DE MES
     $(".botones").eq(0).click(function(){
          --nMes
          if (nMes<=0) {
               nMes=12
               --anoMax
          }
          calcularMes(nMes,anoMax)
     })

     // BOTON ADELANTE PARA ADELANTAR DE MES
     $(".botones").eq(1).click(function(){
          ++nMes
          if (nMes>=12) {
               nMes=1
               ++anoMax
          }
          calcularMes(nMes,anoMax)
     })

     function calcularMes(nMes,anoMax){

          $(".detalle .col").html("")
          $(".detalle .col").removeAttr('style')

          var fechaMesActual = nMes+"/1/"+anoMax //EL PRIMER DIA DE ESTE MES
          var fca = new Date(fechaMesActual)
          var nDiaSemana = fca.getDay() //NUMERO DE DIA SEGUN RANGO DE SEMANA     
          // console.log(nDiaSemana)          
          var cantDiaM = cantDiaMes(nMes,anoMax) // OBTENER CANTIDAD DE DIAS DE UN MES DETERMINADO
          var nFila=1;
          for(var i = 1; i <= cantDiaM; i++){

               $(".fila"+nFila+" .col").eq(nDiaSemana).html(i)
               if (i==nDia && nMes==mesActual) {
                    $(".fila"+nFila+" .col").eq(nDiaSemana).css({
                         'background': '#fa2',
                         color:'#fff'
                    });
               }
               ++nDiaSemana
               
               if (nDiaSemana>6) {
                    nDiaSemana=0
                    ++nFila    
               }
          }

          // Mostrar nombre del mes de el header
          var meses = new Array ("","January","February","March","April","May","June","July","August","September","October","November","December");
          nomMes=meses[nMes]
          $(".mes").html(nomMes+" "+anoMax)
          $(".mes").css('text-transform', 'uppercase');

     }

     function cantDiaMes(humanMonth, year) {
          return new Date(year || new Date().getFullYear(), humanMonth, 0).getDate();
     }

}