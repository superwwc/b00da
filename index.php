<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
	<meta name="author" content="Wendell Warren">
		<link rel="stylesheet" href="vista/css/bootstrap.min.css" />
		<link rel="stylesheet" href="vista/css/w.css" />
		<script src="vista/js/jquery-3.4.1.slim.min.js" ></script>
		<script src="vista/js/popper.min.js" ></script>
		<script src="vista/js/bootstrap.min.js" ></script>
		<script src="vista/js/jquery-3.4.1.min.js" ></script>
<script>
	function b00daAjax() {
		var exchange=document.getElementById("exchange").value;
			$.ajax({
				url: 		'controlador/b00da.php',
				type: 		'POST',
				dataType: 	"html",
				data: 		"exchange="+exchange,
				 error: 		function(){/*Cuando sucede un error*/},
				success: 	function(response){$("#tran").html(response);}
			});
	}
</script>
    <title>tarea1.2 Buda</title>
</head>
<body>
		<img src="vista/img/buda.png" style="text-align:left">
		<br />
		<h1>Ingresa aqu&iacute; el c&oacute;digo de &oacute;rdenes.</h1>
	<form method="post" id="formulario">
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text">"pega" Orders</span>
			</div>
			
			
			
			<!-- aqui va la entrada, predeterminado esta un ejemplo --> 
			<textarea name="exchange" id="exchange" class="form-control" aria-label="With textarea">{orders: [{id: 1, user: "juan", type: "ask", size: 2.0, value: 1.0},{id: 2, user: "pedro", type: "bid", size: 1.5, value: 1.5},{id: 3, user: "juan", type: "ask", size: 3.0, value: 2.0},{id: 4, user: "pedro", type: "bid", size: 4.0, value: 3.0}]}</textarea>
		</div>




		<p><!-- boton para iniciar el proceso --> 
			<input type="button" id="btn-ingresar" class="btn btn-primary" value="Ingresar" onclick="b00daAjax()" />
		</p>
	</form>


		
		
		 <p> OUTPUT:<!-- Aqui estara la salida--> 
			<div class="alert alert-success" id="tran"></div>
		 </p>
		 
</body>
</html>