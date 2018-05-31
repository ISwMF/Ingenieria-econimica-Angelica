var a = ""; //pasa variables que estan en loadDoc
var b = "";
var c = "";
var d = "";
var e = "";
var f = "";

function loadDoc() {

  a = arguments[0]; //pasa variables que estan en loadDoc
  b = arguments[1];
  c = arguments[2];
  d = arguments[3];
  e = arguments[4];
  f = arguments[5];


  var xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var respuesta = this.responseText;

      var cambiorespuesta = JSON.parse(respuesta);
      document.getElementById('pv').value = cambiorespuesta.periodovencido;
      document.getElementById('na').value = cambiorespuesta.nominalanual;
      document.getElementById('ea').value = cambiorespuesta.efectivoanual;
    }
  };
  xhttp.open("GET", "calcular.php?plazo=" + b + "&Periocidad=" + c + "&ea=" + d + "&na=" + e + "&pv=" + f, true); //?=envia variables
  xhttp.send();


  //TABLAAAAAAAAAAAA
  window.setTimeout(ajax2, 500);

}

function ajax2() {
  var product = document.getElementById("pv").value;
  var xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var respuesta = this.responseText;

      document.getElementById('amortizacion').innerHTML = this.responseText; //innerHTML = lo que imprima en el php lo imprime en html
    }
  };
  xhttp.open("GET", "tabla.php?prestamo=" + a + "&Producto=" + product + "&Periocidad=" + c + "&plazo=" + b, true); //?=envia variables
  xhttp.send();
}

function ajax3() {

  var mora = arguments[0];
  var diapago = arguments[1];

  var table = document.getElementById('table');
  var fechaCuota = table.rows[(parseInt(arguments[0]) + 1)].cells[1].innerHTML;
  var separar = fechaCuota.split("/");
  fechaCuota = separar[2] + "-" + separar[1] + "-" + separar[0];
  var saldo = table.rows[parseInt(arguments[0])].cells[2].innerHTML;
  saldo = hacerNumeroPorqueJSnoPuede(saldo);
  alert(saldo);
  var CuotaFija = table.rows[2].cells[3].innerHTML;
  CuotaFija = hacerNumeroPorqueJSnoPuede(CuotaFija);
  var xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var respuesta = this.responseText;

      var cambiorespuesta = JSON.parse(respuesta);

      document.getElementById('diasmora').value = cambiorespuesta.diasmora;
      document.getElementById('interesp').value = cambiorespuesta.interesp;
      document.getElementById('interesm').value = cambiorespuesta.interesm;
    }
  };
  xhttp.open("GET", "mora.php?NumCuota=" + mora + "&Fecha=" + diapago + "&FechaCuota=" + fechaCuota + "&Saldo=" + saldo + "&CuotaFija=" + CuotaFija, true); //?=envia variables
  xhttp.send();

  window.setTimeout(ajax4, 500);
}

function hacerNumeroPorqueJSnoPuede() {
  numero = arguments[0];
  var respuesta = "";
  for (var i = 0; i < numero.length; i++) {
    if (numero[i] >= '0' && numero[i] <= '9') {
      respuesta = respuesta + numero[i];
    } else if (numero[i] == ',') {
      respuesta = respuesta + ".";
    }
  }
  return respuesta;
}

function ajax4() {

  var cuota = document.getElementById("mora").value;
  var data = document.getElementById("diapago").value;
  var table = document.getElementById('table');
  var CuotaFija = table.rows[2].cells[3].innerHTML;
  CuotaFija = hacerNumeroPorqueJSnoPuede(CuotaFija);
  var interesdmora = document.getElementById('interesm').value;

  var xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var respuesta = this.responseText;

      document.getElementById('tablademorado').innerHTML = this.responseText; //innerHTML = lo que imprima en el php lo imprime en html
    }
  };
  xhttp.open("GET", "mora.php?cuota1=" + cuota + "&diadepago1=" + data + "&CuotaFija1=" + CuotaFija + "&interesdmora1=" + interesdmora, true); //?=envia variables
  xhttp.send();
}
