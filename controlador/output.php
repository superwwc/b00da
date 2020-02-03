
<?php
//OUTPUT
	echo "{<br>&nbsp;transactions:<br>&nbsp;&nbsp;[<br>";
		repite($final,sizeof($final),0);//imprimo las transacciones realizadas
		remanente($matriz,$n);//imprimo si hay remains
	echo "<br>&nbsp;&nbsp;]<br>}<br>";
?>