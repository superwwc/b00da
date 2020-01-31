<?php
$exchange="";
$exchange=$_POST['exchange2'];
$xx=$_POST['ww'];
 $transacciones=array();
 $pares=array();
 $elemento=array();
 $temp=[];
 $final=[];
 $inventario=0.0;
$transacciones = explode("{", $exchange);
$numTrans=count($transacciones);// cantidad de ordenes a realizar
$transacciones = str_replace("},","",$transacciones);//quitar ultima llave.$pares = explode(",", $transacciones[2]);
$transacciones = str_replace("}]}","",$transacciones);
$transacciones = str_replace(" ","",$transacciones);





echo "<div class=\"alert table table-striped alert-warning\" id=\"sale\">Inicial:<br><table border=1 ><tr><th scope=\"col\">Id</th><th scope=\"col\">User</th><th scope=\"col\">Type</th><th scope=\"col\">Size</th><th scope=\"col\">Value</th><th scope=\"col\">Remanente</th></tr>";
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
	$van=$van+1;
	echo "<td>0.0</td>";
		echo "</tr>";
	//echo $i;
/*	if(strpos($temp[((($i-1)*5)-3)],"bid")!==false)
						{
						$temp[((($i-1)*5)-2)]=$temp[((($i-1)*5)-2)]*(-1);
						}
	*/
}
echo "</table><br><br></div>";
//echo "fila:".$temp[0].$temp[1].$temp[2].$temp[3].$temp[4]."<br>".$temp[(2*5)-3]."<br>:".$temp[(2*5)-2];
$saldo=0.0;
echo "<div class=\"alert alert-danger\" id=\"sale\">";
echo "OUTPUT:<br><br>";
     $n=$numTrans-2;
    //$matriz=[][]; new int[numTrans][6];
     $cont = 0;

    for ($x=0;$x<$n;$x++) {
      for ($y=0;$y<6;$y++) {
        $matriz[$y][$x]=$temp[$cont];
        $cont++;
      }
    }
	for ($x=0;$x<$n;$x++) {
      
         $matriz[5][$x]=$matriz[3][$x] ;
      }
	  
	 /*   for ($x=0;$x<$n;$x++) {
      for ($y=0;$y<6;$y++) {
        echo $matriz[$y][$x] ;
      }
	  
	  echo "<br>";
    }*/
	
	
	// ALGORITMO PRINCIPAL
	echo "{<br> transactions:<br>  [<br>";
	$max=$n*$n;
	$min=0;
	for ($x=0;$x<$n;$x++){
		for ($y=0;$y<$x;$y++){
			
			if(strpos($matriz[2][$x],"bid")!==false){
				
				//if valueV<valueC
				if(strpos($matriz[2][$y],"ask")!==false){
				if(($matriz[4][$y]<=$matriz[4][$x]))
				{
					$final[$min]=  array($y+1,$x+1);
$min=$min+1;					
			//	echo "   { orders: [".$matriz[0][$y].", ".$matriz[0][$x]."] },<br>";
				
					
				if(($matriz[3][$y]-$matriz[3][$x])<0){
					//1.5y - 4.0x = -2.5x
					
					$matriz[3][$x]=$matriz[3][$x]-$matriz[3][$y];
					$matriz[3][$y]=$matriz[3][$y]-$matriz[3][$y];
				}
				if(($matriz[3][$y]-$matriz[3][$x])>0){
					//2.0y - 1.5x = 0.5y
					$matriz[3][$y]=$matriz[3][$y]-$matriz[3][$x];
					$matriz[3][$x]=$matriz[3][$x]-$matriz[3][$x];
				}
				if(($matriz[3][$y]-$matriz[3][$x])==0){
					//2.0y - 2.0x = 0.0y & 0.0x
					$matriz[3][$x]=$matriz[3][$x]-$matriz[3][$x];
					$matriz[3][$y]=$matriz[3][$y]-$matriz[3][$y];
				}/**/
				
				}
			}
		}	
	if(strpos($matriz[2][$x],"ask")!==false){
		if(strpos($matriz[2][$y],"bid")!==false){
			if(($matriz[4][$y]>=$matriz[4][$x]))
				{
									
				 $final[$min]=  array($y+1,$x+1);
$min=$min+1;		
			//	echo "   { orders: [".$matriz[0][$y].", ".$matriz[0][$x]."] },<br>";
			
					
					
					if(($matriz[3][$y]-$matriz[3][$x])<0){
					//1.5y - 4.0x = -2.5x
					
					$matriz[3][$x]=$matriz[3][$x]-$matriz[3][$y];
					$matriz[3][$y]=$matriz[3][$y]-$matriz[3][$y];
				}
				if(($matriz[3][$y]-$matriz[3][$x])>0){
					//2.0y - 1.5x = 0.5y
					$matriz[3][$y]=$matriz[3][$y]-$matriz[3][$x];
					$matriz[3][$x]=$matriz[3][$x]-$matriz[3][$x];
				}
				if(($matriz[3][$y]-$matriz[3][$x])==0){
					//2.0y - 2.0x = 0.0y & 0.0x
					$matriz[3][$x]=$matriz[3][$x]-$matriz[3][$x];
					$matriz[3][$y]=$matriz[3][$y]-$matriz[3][$y];
				}
				
				
				}
		}
	}
		//	echo "Y=".$y." X=".$x." :";
	//echo $matriz[3][$x]-$matriz[3][$y];echo "<br>";
		}
	}
	
	/* array_unique($entrada) ;$final[$i]= $i => array($u,$d);
	$details = array(
    0 => array("id"=>"1", "name"=>"Mike",    "num"=>"9876543210"),
    1 => array("id"=>"2", "name"=>"Carissa", "num"=>"08548596258"),
    2 => array("id"=>"1", "name"=>"Mathew",  "num"=>"784581254"),
);


for( int i=0; i < F; i++){//ordena la matriz de abajo hacia arriba
for( int j=0;j< C; j++){
for(int x=0; x < F; x++){
for(int y=0; y <C; y++){
if(matriz[i][j] < matriz[x][y]){
int t = matriz[i][j];
matriz[i][j] = matriz[x][y];
matriz[x][y] = t;
}
}
}
} }


*/



//$ww=array_unique($final);
$ww = array_values(array_unique($final));
foreach($final as $fin=> $value){
	foreach($value as $innerRow => $values){
//echo ":".$values."<br>";
}}
for($i=0;$i<sizeof($final);$i++){
	
if($final[$i+1][1]!=$final[$i][1]){
	echo "   { orders: [".$final[$i][0].", ".$final[$i][1]."] },<br>";
	}else{
	echo "   { orders: [".$final[$i][0].", ".$final[$i+1][0].", ".$final[$i+1][1]."] },<br>";
$i++;
}

}


for($i=0;$i<sizeof($final);$i++){
	
	echo "   { orders: [".$final[$i][0].", ".$final[$i][1]."] },<br>";
	


}


	echo "  ],<br> orders:<br>  [";
	$haymas=0;
	for ($x=0;$x<$n;$x++) {
		if($matriz[3][$x]>0.0){
			if($haymas==1){
			echo ", ";
		}
		echo "<br>{ id:".$matriz[0][$x].", user: ".$matriz[1][$x].", type: ".$matriz[2][$x].", size: ".$matriz[5][$x].", value: ".$matriz[4][$x].", remaining: ".$matriz[3][$x]." }";
		if($haymas>0){
			echo ",";
		}
		 
		$haymas=$haymas+1;
		}
	}
	echo "<br>  ]<br>}<br></div>";
	//FIN algirtmo
	echo "<div class=\"alert alert-success\" id=\"end\">Final:<br> <table border=1 class=\" table table-striped\"> <tr><th>id</th><th>User</th><th>type</th><th>size</th><th>value</th><th>inicial</th></tr>";
	
	 for ($x=0;$x<$n;$x++) {
		 echo "<tr>";
      for ($y=0;$y<6;$y++) {
		  if (is_numeric($matriz[5][$x]))
		  {
			  
			  echo "<td>".$matriz[$y][$x]."</td>";
		  }
			  else{
				  echo "ERROR: datos de entrada NO válidos en size";
break;}
			
        
      }echo "</tr>";
	  
	  echo "<br>";
    }
	echo "</table><br>Wendell<br>ene2020";
	
 	/*
*/

?>