<?php
//una muestra de ejemplo de entrada complicando las transacciones
//{orders: [{id: 1, user: "juan", type: "ask", size: 2.0, value: 4.0},{id: 2, user: "pedro", type: "bid", size: 1.5, value: 1.5},{id: 3, user: "juan", type: "ask", size: 3.0, value: 2.0},{id: 4, user: "pedro", type: "bid", size: 4.0, value: 3.0},{id: 5, user: "juan", type: "ask", size: 3.0, value: 1.0},{id: 6, user: "juan", type: "bid", size: 2.5, value: 1.0},{id: 7, user: "juan", type: "bid", size: 2.5, value: 4.0}]}

//output:
/*
{
transactions:
[
{ orders: [3, 4] },
{ orders: [2, 4, 5] },
{ orders: [5, 6] },
{ orders: [1, 7] },
],
orders:
[
{ id:6, user: "juan", type: "bid", size: 2.5, value: 1.0, remaining: 2 },
{ id:7, user: "juan", type: "bid", size: 2.5, value: 4.0, remaining: 0.5 },
]
}
*/
//inicializar variables a utilizar
 $exchange="";
 $exchange=$_POST['exchange2'];
 $xx=$_POST['ww'];
 $transacciones=array();
 $pares=array();
 $elemento=array();
 $final=[];
 $temp=[];
 $transacciones = explode("{", $exchange);
 $numTrans=count($transacciones);// cantidad de ordenes a realizar
 $transacciones = str_replace("},","",$transacciones);//quitar ultima llave.
 $transacciones = str_replace("}]}","",$transacciones);
 $transacciones = str_replace(" ","",$transacciones);
 $van=0;
 $min=0;
 //visualmente muestra la matriz de entrada en amarillo
echo "<div class=\"alert table table-striped alert-warning\" id=\"sale\">Inicial:<br><table border=1 ><tr><th scope=\"col\">Id</th><th scope=\"col\">User</th><th scope=\"col\">Type</th><th scope=\"col\">Size</th><th scope=\"col\">Value</th><th scope=\"col\">Remanente</th></tr>";

//version 1.0 generar un array apartir de la Entrada
for ($i = 2; $i < $numTrans; $i++) {
	echo "<tr>";
	  $pares = explode(",", $transacciones[$i]);
	for ($j = 0; $j < 5; $j++) {
			$elemento = explode(":", $pares[$j]);
			$temp[$van]=$elemento[1]; 
			$van=$van+1;		
			echo "<td>".$elemento[1]."</td>";
		}
		$temp[$van]=0.0;
		$van=$van+1;
		echo "<td>0.0</td>";
		echo "</tr>";
	}
echo "</table><br><br></div>";

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
	for ($x=0;$x<$n;$x++) {// copiar la columna de size para conservar el valor
           $matriz[5][$x]=$matriz[3][$x] ; 
      }
	  

//INICIO DE CALCULOS
for($ind=0;$ind<$n+1;$ind++)//por cada transaccion llamo a hacer las transacciones
		{
calcular($ind,$ind-1,$matriz,$final,$min);
		}
imprimir($matriz,$n); //muestro una matriz resultante como guia informativa visualmente
//OUTPUT:
echo "<br>OUTPUT(salida):<br><div class=\"alert alert-danger\" >";//construyo la salida en ROJO
echo "{<br> transactions:<br>  [<br>";
	repite($final,sizeof($final),0);//imprimo las transacciones realizadas
	remanente($matriz,$n);
		echo "<br>  ]<br>}<br></div>";
		echo "<br>Wendell<br>30ene2020"; //firma
		
	//FUNCIONES UTILIZADAS
function remanente($matriz,$n){ //funcion hecha para mostrar el remanente
	$cont_remanente=0;
	for ($x=0;$x<$n;$x++) {//cuento cuántos remanentes hay
		if($matriz[3][$x]>0.0){
			$cont_remanente++;
		}
	}
		
	echo "  ],<br> orders:<br>  [";
	$haymas=0;
	for ($x=0;$x<$n;$x++) {// imprimo los remanentes
		if($matriz[3][$x]>0.0){
			if($haymas==1){
			echo ", "; //agregar "," al final de cada una
		}
		echo "<br>{ id:".$matriz[0][$x].", user: ".$matriz[1][$x].", type: ".$matriz[2][$x].", size: ".$matriz[5][$x].", value: ".$matriz[4][$x].", remaining: ".$matriz[3][$x]." }";
		if(($haymas>0)and ($haymas<$cont_remanente-1)){
			echo ","; //separador, 
		}		 
		$haymas=$haymas+1;
		}
	}
}	
function repite($matriz,$n,$ind)//funcion hecha para mostras las transacciones hechas al final
{	//crear
$c=[];
$ic=0;
$tempvalor=0;
for($i=0;$i<$n;$i++){
	if($tempvalor!=$matriz[$i][0]){
	$tempvalor=$matriz[$i][0];
	for($j=0;$j<$n;$j++){
	if($matriz[$j][0]==$tempvalor){
		$c[$ic]=$matriz[$j][1];
		$ic++;
	}
	}
	sort($c);//ordenar
	echo "{ orders: [";//mostrar
	foreach($c as $key => $val) {
    print "$val, ";
	} echo $matriz[$i][0]."] }, <br>";
	//echo $c[0]."+".$c[1]."-".$c[2]."-".$c[3]."-".$tempvalor.":".sizeof($c)."<br>";
	
	}
	//var_dump($c);
	$c=null;
	$ic=0;
}	
}//fin de function

function imprimir($matrix, $n){//funcion hecha para mostrar la matriz resultante visualmente en una tabla AZUL
echo "<div class=\"alert alert-primary\" id=\"end\"><br> <table border=1 class=\" table table-striped\"> <tr><th>id</th><th>user</th><th>type</th><th>size</th><th>value</th><th>inicial(size)</th></tr>";
	
	 for ($x=0;$x<$n;$x++) {
		 echo "<tr>";
      for ($y=0;$y<6;$y++) {
		 	  echo "<td>".$matrix[$y][$x]."</td>";
		  }echo "</tr>";
	  }
	echo "</table></div>";
return;
}//fin function

function calcular($i,$w,&$matrix,&$final,&$min){// corazón del a aplicación que realiza los cálculos Recursivamente.
	if ($w<0) // caso base de recursión
	{
		return ;}
	else
	{
		//lógica del negocio
		//compro //vendo
		if(((strpos($matrix[2][$i],"bid")!==false)  and  //si los type que comparo son iguales no hago nada
			(strpos($matrix[2][$w],"bid")!==false))
			or
			((strpos($matrix[2][$i],"ask")!==false)  and
			(strpos($matrix[2][$w],"ask")!==false)))
				{
				
				}
			else
			{    // si "Value" califica y sean compra-venta  y además que tenga en inventario
				if((((($matrix[4][$i]>=$matrix[4][$w])and(strpos($matrix[2][$i],"bid")!==false))and($matrix[3][$w]>0))
					or(($matrix[4][$i]<=$matrix[4][$w])and(strpos($matrix[2][$i],"ask")!==false))and($matrix[3][$w]>0)))
				{
					$final[$min]=  array($i+1,$w+1);//creo las transacciones
					$min=$min+1;					
				if(($matrix[3][$w]-$matrix[3][$i])<0){  //V-C
					//1.5y - 4.0x = -2.5x					
					$matrix[3][$i]=$matrix[3][$i]-$matrix[3][$w];
					$matrix[3][$w]=$matrix[3][$w]-$matrix[3][$w];
				}
				if(($matrix[3][$w]-$matrix[3][$i])>0){
					//2.0y - 1.5x = 0.5y
					$matrix[3][$w]=$matrix[3][$w]-$matrix[3][$i];
					$matrix[3][$i]=$matrix[3][$i]-$matrix[3][$i];
				}
				if(($matrix[3][$w]-$matrix[3][$i])==0){
					//2.0y - 2.0x = 0.0y & 0.0x
					$matrix[3][$i]=$matrix[3][$i]-$matrix[3][$i];
					$matrix[3][$w]=$matrix[3][$w]-$matrix[3][$w];
				}
				}
			}	//fin logica
		calcular($i,$w-1,$matrix,$final,$min); //llamo recursivamente con un indice de la tabla anterior
		return ;
	}
}// fin de la function
?>