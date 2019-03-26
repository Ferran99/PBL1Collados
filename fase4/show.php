<?php
session_start(); 

if (isset($_SESSION['username']))
{?> 


<html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<title>P&agrave;gina d'indentificaci&oacute; de l'usuari del qual es volen mostrar dades</title>
	<a href="home.php?logout">Logout</a>
	<a href="home.php"style="margin-left:2%;">Return Home</a>
	<form action="" method=post class="mx-auto	" style="width: 500px; margin-top: 10%;">
	
		<table cellspacing=3 cellpadding=3>
		   <tr>
			  <td>Uid: </td>
			  <td><input type=text name=login ></td>
		   </tr>
		    
		   <tr>
			 

			  <td colspan=2><button type="submit" class="btn btn-primary">Mostra dades</button></td>
		   </tr>
		</table>
	</form>
    
	
</html>
<?php

}else{
	header('Location: login.php'); 	
}
// Log OUT
if(isset($_GET['logout']))	{
	session_destroy();
	header('Location: login.php');
}


?>


<?php
if (isset($_POST['login']))
{
	// Connexió amb el servidor openLDAP
	$ldaphost = "ldap://127.0.0.1";
	$ldapconn = ldap_connect($ldaphost) or die("Could not connect to LDAP server.");
	ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
	if ($ldapconn) {
		// Autenticació anònima al servidor openLDAP
		$ldapbind = ldap_bind($ldapconn);
		// Accedint a les dades
		if ($ldapbind) {
			$search = ldap_search($ldapconn, "dc=fjeclot,dc=net", "uid=".$_POST['login']);
			$info = ldap_get_entries($ldapconn, $search);
			if($info['count']==0){
				header('Location: showError.php');

			}else{
			//Ara, visualitzarem algunes de les dades de l'usuari:
			for ($i=0; $i<$info["count"]; $i++)
			{
				echo "<div  class='mx-auto' style='width: 500px; margin-top: 3%;'>";
				echo "uid: ".$info[$i]['uid'][0]."<br />";

				echo "Nom: ".$info[$i]["cn"][0]. "<br />";
				echo "Títol: ".$info[$i]["title"][0]. "<br />";
				echo "Telèfon fixe: ".$info[$i]["telephonenumber"][0]. "<br />";
				echo "Adreça postal: ".$info[$i]["postaladdress"][0]. "<br />";
				echo "Telèfon mòbil: ".$info[$i]["mobile"][0]. "<br />";
				echo "Descripció: ".$info[$i]["description"][0]. "<br />";
				echo "Home Directory: ".$info[$i]["homedirectory"][0]. "<br />";
				echo "Login Shell: ".$info[$i]["loginshell"][0]. "<br />";
				echo "GID Number: ".$info[$i]["gidnumber"][0]. "<br />";
				echo "UID Number: ".$info[$i]["uidnumber"][0]. "<br />";
				echo "</div>";
			
				
			} 
			
		}
		} 
		else {
			echo "Error d'autenticació!";
		}
    }
    ?>
    <html>
<title> Dades de l'usuari</title>

</html>
<?php
}
