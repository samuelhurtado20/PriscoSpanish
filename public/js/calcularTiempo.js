// Función para calcular las hora, los días y las semanas transcurridas entre dos fechas y dos horas

//Este plugin a sido desarrollado por Jose Mendez, aunque partiendo de scripts tomados de la web//
//--------------------------Visita CodeUsers.com----------------------------------//

//ADVERTENCIA!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//LA FECHA QUE SE RECIBIRA COMO ARGUMENTO SERA EN EL SIGUIENTE FORMATO "AÑO/MES/DIA" POR EJ. "1900/12/31"
//LA HORA SERA EN EL SIGUIENTE FORMATO "HORA:MINUTO" POR EJ. "23:59"

function calcularTiempo(fecha,hora){
    var f = new Date();
    var horaActual = f.getHours()+":"+f.getMinutes()
    var mes = f.getMonth()+1
    var fechaActual = f.getFullYear()+"/"+mes+"/"+f.getDate()

    fechaHoraActual = fechaActual + " " + horaActual

    var fechaHoraRegistro = fecha +" "+ hora

    var vdias,vhora

    vdias = restaFechas(fecha,fechaActual)
    vhora = calcularHoras(fechaHoraActual,fechaHoraRegistro)
    vSem = calcularSemanas(fecha,fechaActual)

    var retorno;

    if (vdias < 1) {
        if (vhora==0) {
            var a = new Date(fechaHoraActual)
            var b = new Date(fechaHoraRegistro)
            vhora = ((a-b)/1000/60);
            
            if (vhora< 1) {
                retorno = "Recientemente"
                
            }else if(vhora < 2){
                retorno = "Hace "+vhora+" Minuto"
                
            }else{
                retorno = "Hace "+vhora+" Minutos"
            }
        }else if (vhora == 1){
            retorno = "Hace "+vhora+" Hora"
            
        }else if(vhora > 1){
            retorno = "Hace "+vhora+" Horas"
            
        }
    }else if(vdias < 2){
        retorno = "Hace "+vdias+" Dia"
        
    }else if(vdias < 8){
        retorno = "Hace "+vdias+" Dias"
        
    }else if(vSem < 2){
        retorno = "Hace "+vSem+" Semana"
    }else{
        retorno = "Hace "+vSem+" Semanas"
    }

    return retorno

}

function restaFechas(f1,f2){

    var aFecha1 = f1.split('/'); 
    var aFecha2 = f2.split('/'); 
    var fFecha1 = Date.UTC(aFecha1[0],aFecha1[1]-1,aFecha1[2]); 
    var fFecha2 = Date.UTC(aFecha2[0],aFecha2[1]-1,aFecha2[2]);

    var dif = fFecha2 - fFecha1;
    var dias = Math.floor(dif / (1000 * 60 * 60 * 24)); 
    return dias;
}

function calcularHoras(h1,h2){
    var a = new Date(h1); //actual
    var b = new Date(h2); //anterior
    //La diferencia se da en milisegundos así que debes dividir entre 1000
    var horas = ((a-b)/1000/60/60);
    return parseInt(horas)
}

function calcularSemanas(f1,f2){

    var aFecha1 = f1.split('/'); 
    var aFecha2 = f2.split('/'); 
    var fFecha1 = Date.UTC(aFecha1[0],aFecha1[1]-1,aFecha1[2]); 
    var fFecha2 = Date.UTC(aFecha2[0],aFecha2[1]-1,aFecha2[2]);

    var dif = fFecha2 - fFecha1;
    var dias = Math.floor(dif / (1000 * 60 * 60 * 8)); 
    return parseInt(dias / 24);
}