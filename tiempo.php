<?php
include_once 'includes/link.class.php';
$funcs = new Utils();

$funcs->sec_session_start(); // Our custom secure way of starting a PHP session.

$path = $_POST['idPrt'].".txt";
$archivo = fopen($path, "w")
or die("No se puede abrir el archivo");

if(isset($_POST['hora'],$_POST['minutos'],$_POST['idPrt'])){
	$texto = "<".$_POST['hora'].":".$_POST['minutos'].">";
}

if(isset($archivo,$texto)){
	fwrite($archivo, $texto);
	fclose($archivo);
} else {
	fclose($archivo);
}

header("Location: index.php");
exit();