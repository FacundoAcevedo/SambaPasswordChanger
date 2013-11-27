<?php
/**
 * Peuqeno script php que valida un usuario y sus password, luego ejecuta un 
 * codigo en C para cambiar el password del usuario en samba
 *
 * @package cambiarPasswordSamba
 * @author Facundo M. Acevedo <facevedo[AT]csjn[DOT]com[DOT]ar>
 * @version 0.1
 * @copyleft (>) 2013 Facundo M. Acevedo <facevedo[AT]csjn[DOT]com[DOT]ar>
 * @license GPLv3+
 */


include("Services.php");

date_default_timezone_set("America/Buenos_Aires");
//Ruta al ejecutable
$smbP = "/var/www/html/smbP";
 
define('smbP', '/tmp/php_brute.log');
define('logging_file', '/tmp/smbP.log');

// Limpio el usuario y el password
$usuario=stripslashes(trim($_POST['usuario']));
$passwordViejo = stripslashes(trim($_POST['passwordViejo']));
$passwordNuevo = stripslashes(trim($_POST['passwordNuevo']));
$passwordNuevoCopia = stripslashes(trim($_POST['passwordNuevoCopia']));

$estado="-1";
$incorrect_login = true;
// Verifico que el usuario no sea vacio
if( !validarNombreUsuario($usuario) ) 
	loggear("El usuario esta vacio");

else if( !validarContrasenaActual($passwordNuevo, $passwordNuevoCopia)) 
        loggear("Hay un error con el nuevo password ");
else{


	$deny_login = Services::bruteCheck($usuario);
	//Verifico que el usuario no este bloqueado
	if($deny_login) {
	   loggear("$usuario intento cambiar el password estando bloqueado");
	   $mensaje = "Por seguridad bloqueamos el cambio de password de $usuario, reintenta en 5 minutos.";
	   presentarMensaje($mensaje);
	} else {
            //El usuario ya tiene un formato valido y no esta vacio
	    $comando="$smbP $usuario $passwordViejo  $passwordNuevo";
	    exec($comando, $salida, $estado);

	    //Verifico el codigo de salida
	    if (isset($estado) && $estado == 0){
	    	$incorrect_login = false;
	    	}
	    else
	    	$incorrect_login = true;

	   //chequeo si el login fue correcto o no
	   if($incorrect_login) {
		//logueo que se peerdio un intento
	       Services::bruteCheck($usuario, true);
	       loggear("$usuario fallo al introdocir su password");
	       $mensaje = "El password actual para $usuario es incorrecto.";
	       presentarMensaje($mensaje);
	   } else {
	       loggear("$usuario cambio su password exitosamente");
	       $mensaje = "Felicitaciones $usuario, cambiaste el password correctamente.";
	       presentarMensaje($mensaje);
	   }
	}

}



function presentarMensaje($mensaje){
	echo '
	<link rel="StyleSheet" href="style.css" type="text/css">
	<br>
	<h2>'.$mensaje.'</h2>
	<h2>
	<input type="button" value="Volver" onclick="parent.location=\'index.php\';"/>
	</h2>
	';
}



function error($mensaje){
echo ($mensaje);
}

function validarNombreUsuario($unUsuario){
//Verifica que el nombre de usuario sea valido
if( !isset($unUsuario) || empty($unUsuario) || !validarCaracteres($unUsuario))
        return false;
return true;
}

function loggear($texto){
	if(!file_exists(logging_file)) touch(logging_file);
	$ddf = fopen(logging_file,'a');
	$ip = $_SERVER['REMOTE_ADDR'];
	fwrite($ddf,"[".date("d/m/y - H:i:s")." - $ip ] $texto\n");
	fclose($ddf);
}

function validarContrasenaActual($unaContrasena,$copiaDeUnaContrasena){

if( !isset($unaContrasena) || empty($unaContrasena) ||!validarCaracteres($unaContrasena) || ( $unaContrasena != $copiaDeUnaContrasena ) )
        return false; 
return true;
}

function validarCaracteres($entrada){
        if (ctype_alnum($entrada))
                return true;
        return false;
}

?>

