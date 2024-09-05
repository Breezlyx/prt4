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
        header('Location: login.php?error=1');
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Novaxis PRT</title>

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>
<body>
<div id="container">
	<div class="imagen"><img src="images/novaxis.png"></div>
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
</div>

</body>
</html>