<?php
	include('funciones.php');
		//inicializar variables a utilizar
	include('variables.php');	

//generar un array apartir de la Entrada
	for ($i = 2; $i < $numTrans; $i++) {
		$pares = explode(",", $transacciones[$i]);
		for ($j = 0; $j < 5; $j++) {
				$elemento = explode(":", $pares[$j]);
				$temp[$van]=$elemento[1]; 
				$van=$van+1;		
			}
		$temp[$van]=0.0;
		$van=$van+1;
		}

//contruir la matriz apartir del array
	$n=$numTrans-2;
    $cont = 0;
    for ($x=0;$x<$n;$x++) {
		for ($y=0;$y<6;$y++) {
			$matriz[$y][$x]=$temp[$cont];
			$cont++;
		}
    }
	//solo para uso final de la salida
	for ($x=0;$x<$n;$x++) 
	{// copiar la columna de size para conservar el valor
		$matriz[5][$x]=$matriz[3][$x] ; 
    }//esto me servira cuando haga el remanente
	  

//INICIO DE CALCULOS
	for($ind=0;$ind<$n+1;$ind++)//por cada transaccion llamo a hacer las transacciones
	{
		calcular($ind,$ind-1,$matriz,$final,$min);
	}
//OUTPUT: la impresion de la salida
	echo "{<br>&nbsp;transactions:<br>&nbsp;&nbsp;[<br>";
		repite($final,sizeof($final),0);//imprimo las transacciones realizadas
		remanente($matriz,$n);
	echo "<br>&nbsp;&nbsp;]<br>}<br>";
?>