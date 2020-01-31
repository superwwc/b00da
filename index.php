<!DOCTYPE html>
<?php

?>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
	<meta name="author" content="Wendell Warren">
    	<!--link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script-->   
<link rel="stylesheet" href="bootstrap.min.css" crossorigin="anonymous" />
<script src="jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="jquery-3.4.1.min.js" ></script>
<style>	p
		{
		background-color: white;
		text-align: center;
		}
		h1
		{
			text-align: center;
		}
</style>

	
<script>
function b00daJQuery() {
	var exchange=document.getElementById("exchange").value;
	
    $.ajax({
        url: 		'b00da4.php',
        type: 		'POST',
        dataType: 	"html",
        data: 		"exchange2="+exchange+"&xx=23",
	     error: 		function(){/*Cuando sucede un error*/},
        success: 	function(response){$("#tran").html(response);},
		//complete: 	function(){$("#pend").fadeOut('slow');		}
    });
}

</script>
    <title>tarea1 Buda</title>
	 </head>
		
		
    <body  >
	<img src="buda.png" style="text-align:left">
	<br />
	<h1>Ingresa aqu&iacute; el c&oacute;digo de &oacute;rdenes.</h1>
	 <form method="post" id="formulario">
	<div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text">"pega" Orders</span>
  </div>
  <textarea name="exchange" id="exchange" class="form-control" aria-label="With textarea">{orders: [{id: 1, user: "juan", type: "ask", size: 2.0, value: 1.0},{id: 2, user: "pedro", type: "bid", size: 1.5, value: 1.5},{id: 3, user: "juan", type: "ask", size: 3.0, value: 2.0},{id: 4, user: "pedro", type: "bid", size: 4.0, value: 3.0}]}</textarea>
</div>

	<p><input type="button" id="btn-ingresar" class="btn btn-primary" value="Ingresar" onclick="b00daJQuery()" />
	</p>
	</form>


	
	
	 <p> Transacciones:<div class="alert alert-success" id="tran"></div> </p>
	 
</body></html>