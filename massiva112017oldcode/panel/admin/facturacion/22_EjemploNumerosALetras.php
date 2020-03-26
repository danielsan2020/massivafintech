<?php
header('Content-Type: text/html; charset=UTF-8');
include('cNumeroaLetra.php');

echo "<br>";

$CantNum = "1589635.50";

$CantLet = NumeroALetras($CantNum);

echo "Cantidad en número: $CantNum<br>";
echo "<br>";
echo "Cantidad en letra: $CantLet<br>";




function NumeroALetras($numero){
    
  $numalet= new CNumeroaletra;
  $numalet->setNumero($numero);
  //$numalet->setMoneda("Dolares");
  $numalet->setPrefijo("(");
  $numalet->setSufijo("M.N)");
  $numalet->setGenero(1);
  $numalet->setMayusculas(1);
  $varLetra =$numalet->letra();

  return $varLetra;
}





