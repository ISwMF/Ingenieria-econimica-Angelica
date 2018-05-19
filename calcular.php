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

if ($_GET['ea']!="") {
    $efectivoA=($_GET['ea'])/100;
    $ip = (1 + $efectivoA);
    $ip = pow($ip, ($Dias/360));
    $ip = $ip -1;
    $ip = $ip *100;

    $NA = $ip* $Anualidad;

    echo '{ "periodovencido" : "'.$ip.'"    , "nominalanual" : "'.$NA.'" , "efectivoanual":"'.$_GET['ea'].'"}';
}
//---*---*---*
if ($_GET['na']!="") {
  $ip= $_GET['na'] / $Anualidad;
  $EA= (1+($ip/100));
  $EA= pow($EA, (360/$Dias));
  $EA= $EA-1;
  $EA=$EA*100;
  echo '{ "periodovencido" : " '.$ip.'",   "efectivoanual" : "'.$EA.'",  "nominalanual" : "'.$_GET['na'].'" }';

}
if ($_GET['pv']!="") {
  $NA= $_GET['pv'] * $Anualidad;
  $EA= (1+($_GET['pv']/100));
  $EA= pow($EA, (360/$Dias));
  $EA= $EA-1;
  $EA=$EA*100;
  echo '{ "periodovencido" : "'.$_GET['pv'].'",   "efectivoanual" : "'.$EA.'",  "nominalanual" : "'.$NA.'" }';
}
//---*---*---*
