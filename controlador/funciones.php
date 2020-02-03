<?php
//FUNCIONES UTILIZADAS
function remanente($matriz,$n){ //funcion hecha para mostrar el remanente
	$cont_remanente=0;
	for ($x=0;$x<$n;$x++) {//cuento cuántos remanentes hay
		if($matriz[3][$x]>0.0){
			$cont_remanente++;
		}
	}
	echo "&nbsp;&nbsp;],<br>&nbsp;orders:<br>&nbsp;&nbsp;&nbsp;[";
	$haymas=0;
	for ($x=0;$x<$n;$x++) {// imprimo los remanentes
		if($matriz[3][$x]>0.0){
			if($haymas==1){
				echo ", "; //agregar "," al final de cada una
		}
		echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;{&nbsp;id:".$matriz[0][$x].",&nbsp;user:&nbsp;".$matriz[1][$x].",&nbsp;type:&nbsp;".$matriz[2][$x].",&nbsp;size: ".$matriz[5][$x].",&nbsp;value:&nbsp;".$matriz[4][$x].",&nbsp;remaining:&nbsp;".$matriz[3][$x]." }";
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
			echo "&nbsp;&nbsp;&nbsp;&nbsp;{&nbsp;orders:&nbsp;[";//mostrar
			foreach($c as $key => $val) {
				print "$val,&nbsp;";
			} 
			echo $matriz[$i][0]."]&nbsp;},&nbsp;<br>";
		}
		$c=null;
		$ic=0;
	}	
}//fin de function

function calcular($i,$w,&$matrix,&$final,&$min){// corazón del a aplicación que realiza los cálculos Recursivamente.
	if ($w<0) // caso base de recursión
	{
		return ;
	}
	else
	{
		//lógica del negocio
		//compro //vendo
		if(((strpos($matrix[2][$i],"bid")!==false)  and  (strpos($matrix[2][$w],"bid")!==false))//si los type que comparo son iguales no hago nada
			or
			((strpos($matrix[2][$i],"ask")!==false)  and (strpos($matrix[2][$w],"ask")!==false)))
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