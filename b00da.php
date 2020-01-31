<?php
$exchange="";
$exchange=$_POST['exchange2'];
$xx=$_POST['xx'];
 $transacciones=array();
 $pares=array();
 $elemento=array();
 $temp=[];
 $inventario=0.0;
$transacciones = explode("{", $exchange);
$numTrans=count($transacciones);// cantidad de ordenes a realizar
$transacciones = str_replace("},","",$transacciones);//quitar ultima llave.$pares = explode(",", $transacciones[2]);
$transacciones = str_replace("}]}","",$transacciones);
$transacciones = str_replace(" ","",$transacciones);
echo "Inicial:<br><table border=1 ><tr><th>Id</th><th>User</th><th>Type</th><th>Size</th><th>Value</th><th>Remanente</th></tr>";
$recorre=($numTrans-2)*5;
$van=0;
for ($i = 2; $i < $numTrans; $i++) {
	echo "<tr>";
	//echo "T:".$transacciones[$i]."<br />";
    $pares = explode(",", $transacciones[$i]);
	
		for ($j = 0; $j < 5; $j++) {
			
	//echo "P:".$pares[$j]."<br />";
			$elemento = explode(":", $pares[$j]);
			
	$temp[$van]=$elemento[1]; //echo modulo ((5%3)+fila) = 2*fila el resto de dividir 5/3
	$van=$van+1;		
			echo "<td>".$elemento[1]."</td>";
			
			//for ($k = 0; $k < count($elemento); $k++) {
				//echo "E:".$elemento[$k]."<br />";
				
			//}
			
		}
		$temp[$van]=0.0; //echo modulo ((5%3)+fila) = 2*fila el resto de dividir 5/3
	$van=$van+1;echo "<td>0.0</td>";
		echo "</tr>";
	//echo $i;
/*	if(strpos($temp[((($i-1)*5)-3)],"bid")!==false)
						{
						$temp[((($i-1)*5)-2)]=$temp[((($i-1)*5)-2)]*(-1);
						}
	*/
}
echo "</table>";
//echo "fila:".$temp[0].$temp[1].$temp[2].$temp[3].$temp[4]."<br>".$temp[(2*5)-3]."<br>:".$temp[(2*5)-2];
$saldo=0.0;

     $n= $numTrans-2;
     $matriz =[][];// new int[numTrans][6];
     $cont = 0;

    for ($x=0;$x<$n;$x++) {
      for ($y=0;$y<6;$y++) {
        $matriz[y][x] = $temp[cont];
        $cont++;
      }
    }
	    for ($x=0;$x<$n;$x++) {
      for ($y=0;$y<6;$y++) {
        echo $matriz[y][x] ;
      }
	  echo "<br>";
    }
	
for ($i = 2; $i < $numTrans; $i++) 
{
	$saldo=$temp[((($i-1)*5)-2)]+$saldo;
}
/*if($saldo<0)
{echo "<br>Pendiente:".$saldo*(-1);
}
else
{
echo "<br>SALDO:".$saldo;
}
*/
//fin de la tabla INICIAL

//Lógica del Negocio

/* leo primera transacción
si es un vendedor, 
	me agrego a la tabla de disponible.
	
si es un comprador, 
	reviso tabla de disponible
	si hay y cumple 
		la hago, 
		actualizo valores de disponibilidad


al final muestro los saldos.
*/
//leo 1° $temp[0].$temp[1].$temp[2].$temp[3].$temp[4]

echo "<p> Pendientes:<div class=\"alert alert-warning\" id='pend'>";

$i_disp=-1;
for ($i = 2; $i < $numTrans; $i++) {
//version 3
for($j=$i;$j>0;$j--)
{
	if(strpos($temp[((($i-1)*5)-3)],"bid")!==false)
	{
		
$temp[((($j-1)*5)-3)]= $temp[((($j-1)*5)-3)] - $temp[((($i-1)*5)-3)];
echo $temp[((($j-1)*5)-3)]."#".$temp[((($i-1)*5)-3)]."<br>";
/*$disponible[$i_disp][0]= $temp[((($i-1)*5)-5)]; //id
$disponible[$i_disp][1]= $temp[((($i-1)*5)-4)]; //user
$disponible[$i_disp][2]= $temp[((($i-1)*5)-3)]; //type
$disponible[$i_disp][3]= $temp[((($i-1)*5)-2)]; //size
$disponible[$i_disp][4]= $temp[((($i-1)*5)-1)]; //value
		if( $temp[((($j-1)*5)-3)]>0.0   )
		{}*/
	}
}





/* // version 2
if(strpos($temp[((($i-1)*5)-3)],"ask")!==false)
{//tengo oferta de vendedores
echo "ventas:".$temp[((($i-1)*5)-5)].$temp[((($i-1)*5)-4)].$temp[((($i-1)*5)-3)].$temp[((($i-1)*5)-2)].$temp[((($i-1)*5)-1)]."<br>";
$i_disp=$i_disp+1;
$disponible[$i_disp][0]= $temp[((($i-1)*5)-5)]; //id
$disponible[$i_disp][1]= $temp[((($i-1)*5)-4)]; //user
$disponible[$i_disp][2]= $temp[((($i-1)*5)-3)]; //type
$disponible[$i_disp][3]= floatval($temp[((($i-1)*5)-2)]); //size
$disponible[$i_disp][4]= $temp[((($i-1)*5)-1)]; //value
}
$pendiente=[];
$i_pend=-1;
if(strpos($temp[((($i-1)*5)-3)],"bid")!==false)
{//tengo oferta de compradores
echo "compra:".$temp[((($i-1)*5)-5)].$temp[((($i-1)*5)-4)].$temp[((($i-1)*5)-3)].floatval($temp[((($i-1)*5)-2)]).$temp[((($i-1)*5)-1)]."<br>";

foreach($disponible as &$fila)
{
	echo "dispongo:".$fila[0].$fila[1].$fila[2].floatval($fila[3]).$fila[4]."<br>";
	echo "if:".$fila[4]."<= ".$temp[((($i-1)*5)-1)]."<br>";
	if ($fila[4]<=$temp[((($i-1)*5)-1)]) //if valueV<valueC
	{
		echo "cumple:".$fila[4]."<= ".$temp[((($i-1)*5)-1)]."and".$fila[0].":".$temp[((($i-1)*5)-5)]."<br>";
		
		// inventario=lo que habia - lo que compre
		if($fila[3]>$temp[((($i-1)*5)-2)])
		{
			$fila[3]=floatval($fila[3])-floatval($temp[((($i-1)*5)-2)]);
			//		$disponible[$i_disp][3] 
		$disponible[$i_disp][3]= $disponible[$i_disp][3]-floatval($temp[((($i-1)*5)-2)]);
		$temp[((($i-1)*5)-2)]=0.0;
		}
		if($fila[3]<=$temp[((($i-1)*5)-2)])
		{
			
			$temp[((($i-1)*5)-2)]=floatval($temp[((($i-1)*5)-2)])-floatval($fila[3]);
			$fila[3]=0.0;
			unset($fila[0]);
			unset($fila[1]);
			unset($fila[2]);
			unset($fila[3]);
			unset($fila[4]);
			$i_pend=$i_pend+1;
		$pendiente[$i_pend][0]=$temp[((($i-1)*5)-5)];//id
		$pendiente[$i_pend][1]=$temp[((($i-1)*5)-4)];//user
		$pendiente[$i_pend][2]=$temp[((($i-1)*5)-3)];//type
		$pendiente[$i_pend][3]=floatval($temp[((($i-1)*5)-2)]);//size
		$pendiente[$i_pend][4]=$temp[((($i-1)*5)-1)];//value
		echo "<br>asdf".$pendiente[$i_pend][0]."=}".$pendiente[$i_pend][3]."<br>";
		}
		if($fila[3]==$temp[((($i-1)*5)-2)])
		{
		$temp[((($i-1)*5)-2)]=0.0;
			$fila[3]=0.0;
			unset($fila[0]);
			unset($fila[1]);
			unset($fila[2]);
			unset($fila[3]);
			unset($fila[4]);
		}
		
	}
}//foreach
}//fin tengo oferta de compradores
*/
/*
if(strpos($temp[((($i-1)*5)-3)],"bid")!==false)
{
	$i_disp=$i_disp+1;
$disponible[$i_disp][0]= $temp[((($i-1)*5)-5)]; //id
$disponible[$i_disp][1]= $temp[((($i-1)*5)-4)]; //user
$disponible[$i_disp][2]= $temp[((($i-1)*5)-3)]; //type
$disponible[$i_disp][3]= $temp[((($i-1)*5)-2)]; //size
$disponible[$i_disp][4]= $temp[((($i-1)*5)-1)]; //value
}
else
{
	foreach($disponible as $fila)
{
	echo "ventas:".$fila[0].$fila[1].$fila[2].$fila[3].$fila[4]."<br>";
	
	if ($fila[4] <= $temp[((($i-1)*5)-1)]) //if valueV<valueC
	{  
		
		// inventario=lo que habia - lo que compre
		$fila[3]=$fila[3]-$temp[((($i-1)*5)-2)];
		//		$disponible[$i_disp][3] 
		$inventario= $disponible[$i_disp][3]-$temp[((($i-1)*5)-2)];
		
		
		
		if ($inventario<0) // si quede con inventario negativo
		{
			
			$temp[((($i-1)*5)-2)]=-$inventario; 
			$disponible[$i_disp][3]=0.0; //quedé en cero
			$fila[3]=0.0;
			//queda por comprar
			//falta verificar si tengo otra
			
		}
		else if ($inventario==0)
		{
			$disponible[$i_disp][3]=0.0;$fila[3]=0.0;
			$temp[((($i-1)*5)-2)]=0.0;
		}
		else if ($inventario>0)
		{// inventario=lo que habia - lo que compre
			
			//$disponible[$i_disp][3]=0.0;
			//$fila[3]=0.0;
			$temp[((($i-1)*5)-2)]=0.0;
			//$temp[((($i-1)*5)-2)]=$fila[3]-$temp[((($i-1)*5)-2)]  ;
			$disponible[$i_disp][3]=$inventario;
			//$disponible[$i_disp][3]-$temp[((($i-1)*5)-2)];
		}
		
	}
}//fin foreach
}//fin else
*/
}//fin for
echo "colu:<br>";
foreach($pendiente as &$colu)
{
	echo "colu:".$colu[0].$colu[1].$colu[2].$colu[3].$colu[4]."<br>";
}
echo "<br>disponible:<br>";
echo $disponible[0][0];
echo $disponible[0][1];
echo $disponible[0][2];
echo $disponible[0][3];
echo $disponible[1][4]."<br>";
echo $disponible[1][0];
echo $disponible[1][1];
echo $disponible[1][2];
echo $disponible[1][3];
echo $disponible[1][4]."<br>";
echo $disponible[2][0];
echo $disponible[2][1];
echo $disponible[2][2];
echo $disponible[2][3];
echo $disponible[2][4]."<br>";
echo $disponible[3][0];
echo $disponible[3][1];
echo $disponible[3][2];
echo $disponible[3][3];
echo $disponible[3][4]."<br>";



echo "</div> ".$i_disp."</p>";




echo "temp:<br>";
for ($i = 0; $i < 20; $i++) {
	echo $temp[$i]."<br>";
}


/*
PHP
$listado = array(	
	array('Ana', 'Alberto', 'Amancio', 'Andrea'),
	array('Baltasar', 'Bartolo', 'Basilio'),
	array('Cesar', 'Carlos', 'Cristina', 'Carmen'),
);

foreach($listado as $fila)
{
    foreach($fila as $nombre)
    {
	echo " $nombre ";
    }
	
	echo "<br>";
}

<div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text">Output</span>
  </div>
  <textarea name="salida" id="salida" class="form-control" aria-label="With textarea"></textarea>
</div>

*/


?>