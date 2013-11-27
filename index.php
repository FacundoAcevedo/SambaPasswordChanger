<html>
<head>
<title>Cambiar contraseña del SAMBA</title>
<link rel="StyleSheet" href="style.css" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Istok+Web:400,700|Oswald:400,700,300|Raleway:400,600,800' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Istok+Web:400,700|Oswald:400,700,300|Raleway:400,600,800' rel='stylesheet' type='text/css'>
</head>
<body>
	<div class="wrapper">

                    <form name=smbfrm action='cambiarPasswordSamba.php' method='post' >
                    <h2>Cambio de contrase&ntilde;a </h2>
			<h4>
			<?php 
				echo php_uname('n');
			?>
			</h4>
                        <label for='usuario'>
                        <h3>Usuario:
                          <input id='usuario' type="text" name='usuario' />
			</h3>
			</label><!--usuario -->

			<h3>
                        <label for='passwordviejo'>
                        </h3>
                        <h3>Contrase&ntilde;a actual:
                          <input id="passwordviejo" type="password"  name="passwordViejo" />
			</label><!--passwordviejo -->
                        </h3>
                
                    <br>	
                    <p>El nuevo password no debe tener menos de 5 caracteres.</p>
                      <label for='passwordNuevo'>
                      	<h3>Contrase&ntilde;a nueva:
                          <input id="passwordNuevo" type="password" name="passwordNuevo"/>
                        </h3>
		      </label><!--passwordnuevo -->
 
                
                        <label for='passwordNuevoCopia'>
                        <h3>Confirme contrase&ntilde;a:
                          <input id="passwordNuevoCopia" type="password"  name="passwordNuevoCopia"/>
			</label><!--passwordnuevoCopia -->
                
                    <br>	
                        <div id="boton"><input type='button' onClick="validar()" value="Cambiar"/></div>
                    </h3>
		    <h3>
		    <br>
		    <label id=lblError></label>
                    </form>
	</div>

<script language="JavaScript" type="text/JavaScript">
<!--
function validar(){
	var alphaExp = /^[0-9a-zA-Z]+$/;
	//document.getElementById('lblUsuario').innerHTML=""
	//document.getElementById('lblPasswordViejo').innerHTML=""
	//document.getElementById('lblPasswordNuevocopia').innerHTML=""
	//document.getElementById('lblPasswordNuevo').innerHTML=""
	
	if(!document.smbfrm.usuario.value.match(alphaExp)){
		document.getElementById('lblError').innerHTML="El usuario solo debe ser alfanumerico."
		document.smbfrm.usuario.focus()
		return false;
	}
	if (document.smbfrm.passwordViejo.value.length<=0){
		document.getElementById('lblError').innerHTML="Ingrese la contraseña. "
		document.smbfrm.passwordViejo.focus()
		return false
	}
	
	if(!document.smbfrm.passwordViejo.value.match(alphaExp)){
		document.smbfrm.passwordViejo.focus()
		return false;
	}
	if(!document.smbfrm.passwordNuevo.value.match(alphaExp)){
		document.getElementById('lblError').innerHTML="El password solo debe ser alfanumerico."
		document.smbfrm.passwordNuevo.focus()
		return false;
	}
	if (document.smbfrm.passwordNuevo.value.length<5){
		document.getElementById('lblError').innerHTML="El password debe tener mas de 5 caracteres. "
		document.smbfrm.passwordNuevo.focus()
		return false
	}

	if (document.smbfrm.passwordNuevo.value != document.smbfrm.passwordNuevoCopia.value ){
		document.getElementById('lblError').innerHTML="Los password no coniciden!"
		return false
	}
	
	document.smbfrm.submit();
	return true;
}
//-->
</script>

</body>


</html>
