var periodo = document.getElementById("periodo");
var div_turno = document.getElementById("div_turno");

periodo.onchange = function () {
    if (periodo.value == 0) {
        div_turno.style.display = 'none';
    } else {
        div_turno.style.display = 'block';
    }
}
