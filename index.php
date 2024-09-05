<?php
include_once 'includes/link.class.php';
$funcs = new Utils();

$funcs->sec_session_start(); // Our custom secure way of starting a PHP session.

if ($funcs->login_check() == false) {
	header("Location: login.php");
	exit();
}

if ($_SESSION['user_id'] != 11) {
	$path = $_SESSION['user_id'] . ".txt";
	$archivo = fopen($path, "r")
		or die("No se puede abrir el archivo");

	if (isset($archivo)) {
		$tiempo = fread($archivo, filesize($path));
		fclose($archivo);
	} else {
		fclose($archivo);
	}
	$tiempo = preg_replace(array('/</', '/>/'), array('', ''), $tiempo);
} else {


	$tabla = '<div class="tabla-admin">
	<table border="1px solid #000">
		<tr>
			<th>Planta</th>
			<th>Ultima Modificación</th>
			<th>Valor Actual</th> 
			<th>Nuevo Valor</th>
			<th>ID Planta</th>
			<th>N° Telefono</th>
			<th>SIM ICC</th>
			<th>IMEI</th>
		</tr>';

	for ($i = 0; $i < 11; $i++) {
		$tabla .= '<tr>';
		$path = $i . ".txt";
		$archivo = fopen($path, "r")
			or die("No se puede abrir el archivo");

		if (isset($archivo)) {
			$tiempo = fread($archivo, filesize($path));
			fclose($archivo);
			$fecha = date("d F Y H:i:s.", filemtime($path));
			$fecha = preg_replace(MONTHS, MESES, $fecha);
		} else {
			fclose($archivo);
		}
		$tiempo = preg_replace(array('/</', '/>/'), array('', ''), $tiempo);

		for ($j = 0; $j < count(USUARIOS); $j++) {
			if (USUARIOS[$j][0] == $i)
				$arr = USUARIOS[$i];
		}
		$tabla .= '<td>' . $arr[3] . '</td>';
		$tabla .= '<td>' . $fecha . '</td>';
		$tabla .= '<td class="board">' . $tiempo . '</td>';
		$tabla .= '<td><input name="hora-' . $arr[0] . '" type="text" class="form-control tiempo" placeholder="HH"><div class="tiempo">:</div><input name="minutos-' . $arr[0] . '" type="text" class="form-control tiempo" placeholder="MM">
		<button class="btn btn-theme" type="button" onClick="actualizar(' . $arr[0] . ');"><i class="fa fa-lock"></i> ENVIAR AL TABLERO</button></td>';
		$tabla .= '</tr>';

	}
	$tabla .= '</table>';

}


?>
<!DOCTYPE html>
<html>

<head>
	<title>Novaxis PRT</title>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="css/index.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"
		integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="js/functions.js" type="text/javascript"></script>

</head>

<body>

	<div class="top-bar"></div>

	<div class="imagen"><img src="images/prt.jpg" alt="PRT"></div>
	<a href="logout.php">Cerrar sesion</a></div>
	<div id="container">
		<div class="formulario">
			<?php if ($_SESSION['user_id'] != 11) { ?>
				<div class="grid-item">
					<div class="userdata"><?php echo "<h1>" . $_SESSION['nombre'] . "</h1>"; ?></div>
					<div class="form-login-heading">Tiempo actual</div>
					<div class="board"><?php echo $tiempo; ?></div>
					<div class="login-wrap">
						<input name="hora" type="text" class="form-control tiempo" placeholder="HH">
						<div class="tiempo">:</div>
						<input name="minutos" type="text" class="form-control tiempo" placeholder="MM">
						<input name="idPrt" type="hidden" value="<?php echo $_SESSION['user_id']; ?>">
					</div>
					<button class="btn btn-theme btn-block" type="button" onClick="formsend(this.form);"><i
							class="fa fa-lock"></i> ENVIAR AL TABLERO</button>
				</div>
			<?php }
			if ($_SESSION['user_id'] == 11) {
				echo '<div class="grid-container">';

				for ($i = 0; $i < 11; $i++) {
					$path = $i . ".txt";
					$archivo = fopen($path, "r")
						or die("No se puede abrir el archivo");

					if (isset($archivo)) {
						$tiempo = fread($archivo, filesize($path));
						fclose($archivo);
						$fecha = date("d F Y H:i:s.", filemtime($path));
						$fecha = preg_replace(MONTHS, MESES, $fecha);
					} else {
						fclose($archivo);
					}
					$tiempo = preg_replace(array('/</', '/>/'), array('', ''), $tiempo);

					// Obtener el nombre de la planta
					for ($j = 0; $j < count(USUARIOS); $j++) {
						if (USUARIOS[$j][0] == $i)
							$arr = USUARIOS[$i];
					}

					// Crear un ítem del grid para cada usuario
					echo '<div class="grid-item">';
					echo '<div>' . $arr[3] . '</div>'; // Nombre de la planta
					echo '<div class="board">' . $tiempo . '</div>'; // Tiempo actual
					echo '<div class="login-wrap">';
					echo '<input name="hora-' . $arr[0] . '" type="text" class="form-control tiempo" placeholder="HH"><div class="tiempo">:</div>';
					echo '<input name="minutos-' . $arr[0] . '" type="text" class="form-control tiempo" placeholder="MM">';
					echo '</div>';
					echo '<button class="btn btn-theme btn-block" type="button" onClick="actualizar(' . $arr[0] . ');"><i class="fa fa-lock"></i> ENVIAR AL TABLERO</button>';
					echo '</div>';
				}

				echo '</div>';
			}
			?>
		</div>
	</div>
	<div class="bottom-bar"></div>
</body>

</html>