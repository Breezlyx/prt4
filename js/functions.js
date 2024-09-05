function formsend(form) {
    // Create a new element input, this will be our hashed password field. 
    var idPrt = $('[name="idPrt"]').val();
	var hora = $('[name="hora"]').val();
	var minutos = $('[name="minutos"]').val();
	// Finally submit the form. 
	if(hora && minutos){
		$.post( "tiempo.php", { idPrt: idPrt, hora: hora, minutos: minutos } ).done(function( data ) {
			location.reload();
		  });
		
		
	} else {
		alert('Debe ingresar ambos datos');
	}
}
function valida(f,p,c){
	alert('entro');
	if((p.value!='' && c.value!='') && (p.value==c.value))
		formhash(f,c);
	else	
		alert('Las contraseñas no coinciden');
}
function actualizar(idPrt){
	var hora = $('[name="hora-'+idPrt+'"]').val();
	var minutos = $('[name="minutos-'+idPrt+'"]').val();
	if(hora && minutos){
		$.post( "tiempo.php", { idPrt: idPrt, hora: hora, minutos: minutos } ).done(function( data ) {
			location.reload();
		  });
	} else {
		alert('Debe ingresar ambos datos');
	}
}

function actualiza(idPrt){
	var hora = $('[name="hora"]').val();
	var minutos = $('[name="minutos"]').val();
	if(hora && minutos){
		$.post( "tiempo.php", { idPrt: idPrt, hora: hora, minutos: minutos } ).done(function( data ) {
			location.reload();
		  });
	} else {
		alert('Debe ingresar ambos datos');
	}
}