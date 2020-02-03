<?php
	include('funciones.php');
		//inicializar variables a utilizar
	include('../modelo/variables.php');	
	include('precalculo.php');	


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