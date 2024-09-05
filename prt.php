
<?php
if(!($sock = socket_create(AF_INET, SOCK_DGRAM, 0)))
{
	$errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    
    die("Couldn't create socket: [$errorcode] $errormsg \n");
}

//echo "Socket created \n";

// Bind the source address
if( !socket_bind($sock, "0.0.0.0", 8485) )
{
	$errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    
    die("Could not bind socket : [$errorcode] $errormsg \n");
}

//echo "Socket bind OK \n";


//Do some communication, this loop can handle multiple clients
while(1)
{
	//echo "Waiting for data ... \n";
	
	//Receive some data
	$r = socket_recvfrom($sock, $buf, 1, 0, $remote_ip, $remote_port);
	/*if($buf > 0 && $buf < 6){*/
		$$path = "/var/www/html/prt/".$buf.".txt";
		$archivo = fopen($path, "r")
		or die("No se puede abrir el archivo");
	//}

	if(isset($archivo)){
		$tiempo = fread($archivo,filesize($path));
		fclose($archivo);
	}
	
	//echo "$remote_ip : $remote_port -- " . $buf . "\n";
	
	//Send back the data to the client
	socket_sendto($sock, $tiempo , 100 , 0 , $remote_ip , $remote_port);
}

socket_close($sock);
