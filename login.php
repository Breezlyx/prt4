<?php
include_once 'includes/link.class.php';
$funcs = new Utils();

$funcs->sec_session_start(); // Our custom secure way of starting a PHP session.

if (isset($_POST['user'], $_POST['pass'])) {
	$login = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
	$password = $_POST['pass']; // The hashed password.

	if ($funcs->login($login, $password) == true) {
		// Login success 
		header("Location: index.php");
		exit();
	} else {
		// Login failed 
		$error_msg = "Usuario o contraseña incorrectos.";
	}
}
?>

<!DOCTYPE html>

<html>

<head>
	<title>Novaxis PRT</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="css/login.css">
</head>

<body>

	<div class="top-bar"></div>

	<div class="logos_superior">
		<img src="images/prt.png" class="logo logo-prt" alt="PRT">
		<img src="images/san_damaso.png" class="logo logo-sandamaso" alt="San Damaso">
		<img src="images/novaxis.jpeg" class="logo logo-novaxis" alt="Novaxis">
	</div>

	<div id="container">

		<div class="formulario">
			<form id="formlog" class="form-login" method="post" action="login.php">
				<h2 class="form-login-heading">Ingreso</h2>
				<div class="login-wrap">
					<input name="user" type="text" class="form-control" placeholder="Usuario">
					<br>
					<input name="pass" id="pass" type="password" class="form-control" placeholder="Contraseña">
					<br>
					<button class="btn btn-theme btn-block" type="button" onClick="formlog.submit();"><i class="fa fa-lock"></i> INGRESAR</button>
				</div>
			</form>
		</div>
		<?php if (isset($error_msg)): ?>
			<div class="alert alert-danger" role="alert">
				<?php echo $error_msg; ?>
			</div>
		<?php endif; ?>
	</div>
	<div class="bottom-bar"></div>
</body>

</html>