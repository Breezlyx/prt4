<?php

define ('DEBUG', 0);
define ('DEBUGGER', 0);
if (DEBUGGER!=0){
	error_reporting(E_ALL ^ E_NOTICE);
	ini_set('display_errors','On');
}
// (idPlanta, username, password, Nombre usuario)
const USUARIOS = array(
  array(0,"planta_laflorida","laflorida","Planta La Florida"),
  array(1,"planta_puentealto","puentealto","Planta Puente Alto"),
  array(2,"planta_maipu","maipu","Planta Maipu"),
  array(3,"planta_lacalera","lacalera","Planta La Calera"),
  array(4,"planta_quilpue","quilpue","Planta Quilpue"),
  array(5,"planta_placilla","placilla","Planta Placilla"),
  array(6,"planta_colina","colina","Planta Colina"),
  array(7,"planta_antofagasta","antofagasta","Planta Antofagasta"),
  array(8,"planta_copiapo","copiapo","Planta Copiapo"),
  array(9,"planta_calama","calama","Planta Calama"),
  array(10,"planta_demo","demo","Planta Demo"),
  array(11,"admin","admin","Administrador")
  );

const MESES = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
const MONTHS = array('/January/','/February/','/March/','/April/','/May/','/June/','/July/','/August/','/September/','/October/','/November/','/December/');

/**
 * Is this a secure connection?  The default is FALSE, but the use of an
 * HTTPS connection for logging in is recommended.
 * 
 * If you are using an HTTPS connection, change this to TRUE
 */
define("SECURE", FALSE);    // For development purposes only!!!!
