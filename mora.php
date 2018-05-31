<?php

if (isset($_GET['NumCuota'])) {
    $FechaCuota = new DateTime($_GET['FechaCuota']);
    $FechaRetardo =  new DateTime($_GET['Fecha']);
    $Retardo = $FechaCuota->diff($FechaRetardo);
    $DiasdeRetardo = $Retardo->format('%a');

    $interesperiodico= pow(1.3102, ($DiasdeRetardo/365));
    $interesperiodico= $interesperiodico-1;
    $interesperiodico= $interesperiodico*100;

    $interesmora= $_GET['Saldo']*($interesperiodico/100);


    echo '{ "diasmora" : "'.$DiasdeRetardo.'"    , "interesp" : "'.$interesperiodico.'" , "interesm":"'.$interesmora.'"}';
}

//xhttp.open("GET", "mora.php?cuota1=" + cuota + "&diadepago1=" + data + "&CuotaFija1=" + CuotaFija + "&interesdmora1=" + interesdmora, true); //?=envia variables
if (isset($_GET['cuota1'])) {
    echo '
  <table style="width:100%" id="table">
     <tr>
       <th>Firstname</th>
       <th>Lastname</th>
       <th>Age</th>
       <th>Age</th>
       <th>Age</th>
     </tr>';
    echo "<tr>";
    echo '<td>', $_GET['cuota1'], '</td>' ;
    echo '<td>', $_GET['diadepago1'],  '</td>' ;
    echo '<td>', number_format($_GET['CuotaFija1'], 2, ',', '.'), '</td>' ;
    echo '<td>', number_format($_GET['interesdmora1'], 2, ',', '.'), '</td>' ;
    echo '<td>', number_format(($_GET['interesdmora1']+ $_GET['CuotaFija1']), 2, ',', '.'), '</td>' ;
    echo '</tr>';


    echo '</table>';
}
