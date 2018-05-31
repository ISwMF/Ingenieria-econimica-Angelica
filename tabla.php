<?php

$Anualidad = 0;

$Periodo = 0;
$Dias = 0;
switch ($_GET['Periocidad']) {
  case 'm':
    $Anualidad = 12;
    $Periodo = 1;
    $Dias = 30;
    break;

  case 't':
    $Anualidad = 4;
    $Periodo = 3;
    $Dias = 90;
    break;

  case 's':
    $Anualidad = 2;
    $Periodo = 6;
    $Dias = 180;
    break;
}

if (isset($_GET ['Producto'])) {
    $cuotafija = 1+($_GET['Producto']/100);
    $cuotafija = pow($cuotafija, ($_GET['plazo']*$Anualidad));
    $cuotafija= $cuotafija*($_GET['Producto']/100);


    $cuotafijabajo= (1+($_GET['Producto']/100));
    $cuotafijabajo= pow($cuotafijabajo, ($_GET['plazo']*$Anualidad))-1;

    $cuotafija= $_GET['prestamo']* ($cuotafija/$cuotafijabajo);
    echo"resultado amortizacion:", $cuotafija,"<br>";
    $Matriz = array();

    $fecha = new DateTime();
    $Intervalo = 'P' . $Periodo.'M';

    for ($i=0; $i <= ($_GET['plazo']*$Anualidad) ; $i++) {
        $Matriz [$i]=array();
        if ($i==0) {
            array_push($Matriz[$i], 0, $fecha->format('d/m/Y'), $_GET['prestamo'], 0, 0, 0, $_GET['prestamo'])      ;
        } else {
            $amortizacioninteres= $Matriz[$i-1][2]*($_GET['Producto']/100);

            //echo $amortizacioninteres, "<br>";
            $amortizacioncapital=  $cuotafija-$amortizacioninteres;

            $saldocapital= $Matriz[$i-1][2] - $amortizacioncapital;



            array_push($Matriz[$i], $i, $fecha->format('d/m/Y'), $saldocapital, $cuotafija, $amortizacioncapital, $amortizacioninteres, $cuotafija );
        }
        $fecha->add(new DateInterval($Intervalo));
    }

    echo '
    <table style="width:100%" id="table">
       <tr>
         <th>Firstname</th>
         <th>Lastname</th>
         <th>Age</th>
         <th>Age</th>
         <th>Age</th>
         <th>Age</th>
         <th>Age</th>
       </tr>';
       for ($i=0; $i <count($Matriz) ; $i++) { //count: devuekve el length
         echo "<tr>";
          echo '<td>', $Matriz[$i][0], '</td>' ;
          echo '<td>', $Matriz[$i][1], '</td>' ;
          echo '<td>', number_format($Matriz[$i][2], 2, ',', '.'), '</td>' ;
          echo '<td>', number_format($Matriz[$i][3], 2, ',', '.'), '</td>' ;
          echo '<td>', number_format($Matriz[$i][4], 2, ',', '.'), '</td>' ;
          echo '<td>', number_format($Matriz[$i][5], 2, ',', '.'), '</td>' ;
          echo '<td>', number_format($Matriz[$i][6], 2, ',', '.'), '</td>' ;
         echo '</tr>';
       }

       echo '</table>';

    ////////mora
    echo ' <label> Cuota:  <input type="text" name="mora" value="" id="mora" > </label><br> ';
    echo "<input type=\"date\" name=\"diapago\" id=\"diapago\" class=\"form-control\" ng-model=\"diapago\">";
    echo ' <label> Dias de mora:  <input type="text" name="diasmora" value="" id="diasmora" > </label><br> ';
    echo ' <label> Tasa de Usura:  <input type="text" name="usura" value="31.02" id="usura" > % </label><br> ';
    echo ' <label> Interes Periodico:  <input type="text" name="interesp" value="" id="interesp" > % </label><br> ';
    echo ' <label> Interes Mora:  <input type="text" name="interesm" value="" id="interesm" > % </label><br> ';

    echo '<button type="button" onclick="ajax3(mora.value, diapago.value, diasmora.value)" name="button">Calcular Moroa</button>';

    echo ' <div id="tablademorado">
    </div>
    ';
}
