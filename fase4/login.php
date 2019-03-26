
<?php
session_start(); 


if( $_POST['login'] == 'admin' && isset($_POST['password']) )
{
	$ou = 'administrador';
	$uid='sysadmin';
	$ldaphost = "ldap://127.0.0.1";
	$ldaprdn  = 'uid='.trim($uid).',ou='.trim($ou).',dc=fjeclot,dc=net';
	$ldappass = trim($_POST['password']); 
	$ldapadmin= "cn=admin,dc=fjeclot,dc=net";  

	// Connectant-se al servidor openLDAP
	$ldapconn = ldap_connect($ldaphost) or die("No s'ha pogut establir una connexió amb el servidor openLDAP.");

	ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
	

	if ($ldapconn) {
		// Autenticant-se en el servidor openLDAP
		$ldapbind = ldap_bind($ldapconn, $ldapadmin, $ldappass);

		// Accedint a home.php
		if ($ldapbind) {
			$_SESSION['username'] = trim($_POST['login']);
			header('Location: home.php'); 		
		} else {
			header('Location: error.php'); 
		}
	}
}else if($_POST['login'] != 'admin' && isset($_POST['password'])) {
	header('Location: error.php'); 		

	
}

?>

<html>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<form action=""	 method="post" class="mx-auto	" style="width: 500px; margin-top: 10%;">
	<div class="form-group ">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" name=login class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter username">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name=password class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
		
	</form>
</html>

