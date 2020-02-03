<?php
		 $exchange=$_POST['exchange'];
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
?>