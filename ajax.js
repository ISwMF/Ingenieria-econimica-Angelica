function loadDoc() {

  var a = arguments[0]; //pasa variables que estan en loadDoc
  var b = arguments[1];
  var c = arguments[2];
  var d = arguments[3];
  var e = arguments[4];
  var f = arguments[5];


  var xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var respuesta = this.responseText;

      var cambiorespuesta = JSON.parse(respuesta);
      document.getElementById('pv').value=cambiorespuesta.periodovencido;
      document.getElementById('na').value=cambiorespuesta.nominalanual;
      document.getElementById('ea').value=cambiorespuesta.efectivoanual;
    }
  };
  xhttp.open("GET", "calcular.php?prestamo="+a+"&plazo="+b+"&Periocidad="+c+"&ea="+d+"&na="+e+"&pv="+f, true);//?=envia variables
  xhttp.send();
}
