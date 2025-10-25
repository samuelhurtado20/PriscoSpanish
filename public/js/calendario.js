function cargarCalendario(){

    var f = new Date(fechaMesActual)
    var primerDia = diasSemana[f.getDay()]
    var primerDiaN = f.getDay();

    // numMes = numMes.replace("0","") - 1
    

    

    diass = new Array(cantMes);
    var d = primerDiaN;
    var dN = 0;
    for (var i = 0; i < diass.length; i++) {
        dN++;
        diass[i] = d
        d++;

        if (d>=7) {
            d=0
        }
        
    };

    var semanas = new Array("Primera Semana","Segunda Semana","Tercera Semana","Cuarta Semana")

    var sem;

    if (numSemana ==1) {sem = semanas[0],mostrarDias(1,7)};
    if (numSemana ==2) {sem = semanas[1],mostrarDias(8,14)};
    if (numSemana ==3) {sem = semanas[2],mostrarDias(15,21)};
    if (numSemana ==4) {sem = semanas[3],mostrarDias(22,cantMes)};

    $(".mes").html(sem +" de "+meses[numMes])

}

function mostrarDias(d,h){

    document.write("<div id='tabla'><div id='fila'><div id='celda'>Horas</div>")
    var diaActual;
    nDia = new Array(cantMes)
    for(var i = d-1; i < h; i++){
        diaActual = i+1;
        nDia[i]=i+1;
        document.write("<div id='celda' class='dias'>"+diasSemana[diass[i]]+"("+nDia[i]+")</div>")
        
    };
        var cDias =$(".dias").length

        var ccDias = new Array(cDias)

    document.write("</div>")
    
    for (var i = 0; i < horas.length; i++) {
        document.write("<div id='fila' class='fila'><div id='celda' class='horas'>"+horas[i]+"</div>");
        for(var j=0;j<cDias;j++){
            document.write("<div id='celda' class='celdas'></div>")
        }
        document.write("</div>");
    
    };
    document.write("</div>")
}

function cantDiaMes(humanMonth, year) {
  return new Date(year || new Date().getFullYear(), humanMonth, 0).getDate();
}
