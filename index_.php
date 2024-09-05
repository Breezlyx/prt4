<?php
include_once 'includes/link.class.php';
$funcs = new Utils();

$funcs->sec_session_start(); // Our custom secure way of starting a PHP session.

if ($funcs->login_check() == false) {
    header("Location: login.php");
    exit();
} 

if($_SESSION['user_id']!=7){
	$path = $_SESSION['user_id'].".txt";
	$archivo = fopen($path, "r")
	or die("No se puede abrir el archivo");

	if(isset($archivo)){
		$tiempo = fread($archivo,filesize($path));
		fclose($archivo);
	} else {
		fclose($archivo);
	}
	$tiempo = preg_replace(array('/</','/>/'), array('',''), $tiempo);
} else {
	

	$tabla = '<div class="tabla-admin">
	<table border="1px solid #000">
		<tr>
			<th>Planta</th>
			<th>Ultima modificacion</th>
			<th>Valor actual</th> 
			<th>Nuevo valor</th>
		</tr>';

	for($i=0;$i<6;$i++){
		$tabla .= '<tr>';
		$path = $i.".txt";
		$archivo = fopen($path, "r")
		or die("No se puede abrir el archivo");

		if(isset($archivo)){
			$tiempo = fread($archivo,filesize($path));
			fclose($archivo);
			$fecha = date ("d F Y H:i:s.", filemtime($path));
			$fecha = preg_replace(MONTHS,MESES,$fecha);
		} else {
			fclose($archivo);
		}
		$tiempo = preg_replace(array('/</','/>/'), array('',''), $tiempo);

		for($j=0;$j<count(USUARIOS);$j++){
			if(USUARIOS[$j][0]==$i)
				$arr=USUARIOS[$i];
		}
		$tabla .= '<td>'.$arr[3].'</td>';
		$tabla .= '<td>'.$fecha.'</td>';
		$tabla .= '<td class="board">'.$tiempo.'</td>';
		$tabla .= '<td><input name="hora-'.$arr[0].'" type="text" class="form-control tiempo" placeholder="HH"><div class="tiempo">:</div><input name="minutos-'.$arr[0].'" type="text" class="form-control tiempo" placeholder="MM">
		<button class="btn btn-theme" type="button" onClick="actualizar('.$arr[0].');"><i class="fa fa-lock"></i> ENVIAR AL TABLERO</button></td>';
		$tabla .= '</tr>';

	}
	$tabla .= '</table>';
	
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Novaxis PRT</title>

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="js/functions.js" type="text/javascript"></script>

</head>
<body>
<div id="container">
	<div class="imagen"><img src="images/prt.jpg"></div>
	<div class="formulario">
		<div class="userdata">Bienvenido <?php echo $_SESSION['nombre'];?> | <a href="logout.php">Cerrar sesion</a></div>
		<form id="formtiempo" class="form-login" method="post" action="tiempo.php">
		<?php if($_SESSION['user_id']!=7){ ?>
			<div class="actual">
				<h2 class="form-login-heading">Tiempo actual</h2>
				<div class="board">
					<?php echo $tiempo; ?>
				</div>
			</div>
			<h2 class="form-login-heading">¿Tiempo medio de espera?</h2>
			<div class="login-wrap">
				<input name="hora" type="text" class="form-control tiempo" placeholder="HH"><div class="tiempo">:</div><input name="minutos" type="text" class="form-control tiempo" placeholder="MM">
				<br>
				<input name="idPrt" type="hidden" value="<?php echo $_SESSION['user_id'];?>">
				<button class="btn btn-theme btn-block" type="button" onClick="formsend(this.form);"><i class="fa fa-lock"></i> ENVIAR AL TABLERO</button>
			</div>
			<?php } else { echo $tabla; } ?>
		</form>	  	
	</div>
</div>

</body>
</html>
