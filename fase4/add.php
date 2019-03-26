<?php
session_start(); 

if (isset($_SESSION['username']))
{?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<body>
<a href="home.php?logout">Logout</a>
<a href="home.php" style="margin-left:2%;">Return Home</a>
<form action="add.php"	 method=post  class="mx-auto	" style="width: 500px; margin-top: 10%;"><br>
<table cellspacing=3 cellpadding=3 >
		   <tr>
			  <td>Nom : </td>
			  <td><input type=text name=givenname size=16 maxlength=15 required></td>
		   </tr>
		   <tr>
           <tr>
			  <td>Cognom : </td>
			  <td><input type=text name=sn size=16 maxlength=15 required></td>
		   </tr>
		   <tr>
			  <td>Unitat organitzativa: </td>
              <td>
							<div class="form-group">
    <select class="form-control"name="ou" id="exampleFormControlSelect1">
						<option value="usuaris">usuaris</option>
                    <option value="administradors">administradors</option>
                    <option value="desenvolupadors">desenvolupadors</option>
    						</select>
  						</div>
                
              </td>
					</tr>
					<tr>
            <td>Poseu un titol: </td>
            <td><input type=text name=title size=16 maxlength=15 required></td>                     
           
           </tr>
           <tr>
            <td>Poseu un uid: </td>
            <td><input type=text name=uid size=16 maxlength=15 required></td>                     
           
           </tr>
           <tr>
			  <td>Telephone number : </td>
			  <td><input type=text name=telephonenumber size=16 maxlength=15 required></td>
		   </tr>
           <tr>
			  <td>Phone number : </td>
			  <td><input type=text name=mobile size=16 maxlength=15 required></td>
		   </tr>
			 </tr>
        <tr>
			  <td>Adreça de l'usuari : </td>
			  <td><input type=text name=adres size=16 maxlength=15 required></td>
		   </tr>
			 <tr>
			  <td> gidNumber: </td>
			  <td><input type=text name=gidnumber size=16 maxlength=15 required></td>
		   </tr>
			 <tr>
			  <td> uidNumber: </td>
			  <td><input type=text name=uidnumber size=16 maxlength=15 required></td>
		   </tr>
			 <tr>
			  <td>Descripció de l'usuari : </td>
			  <td><input type=text name=description size=16 maxlength=15 required></td>
		   </tr>
           
		   <tr>
		   <tr>
			  <td>Contrasenya del nou usuari LDAP: </td>
			  <td><input type=password name=password size=16 maxlength=15 required ></td>
		   </tr>
		   <tr>
			

			  <td> <button type="submit" name="submit" class="btn btn-primary">Afegir Usuari</button></td>
		   </tr>
		</table>

</form>

</body>
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
if(isset($_POST['submit'])){

	$uid=$_POST['uid'];
	$ou = $_POST['ou'];
	$cn = $_POST['givenname']." ".$_POST['sn'];
	$sn = $_POST['sn'];
	$givenName = $_POST['givenname'];
	$title=$_POST['title'];
	$telephoneNumber=$_POST['telephonenumber'];
	$mobile = $_POST['mobile'];
	$postalAddress = $_POST['adres'];
	$description=$_POST['description'];
	$password=$_POST['password'];

	$ldaphost = "ldap://127.0.0.1";

	$ldapconn = ldap_connect($ldaphost);
	ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

	$bind = ldap_bind($ldapconn, "cn=admin,dc=fjeclot,dc=net", "fjeclot");

	$dn = 'uid='.$_POST['uid'].',ou='.$_POST['ou'].',dc=fjeclot,dc=net';
	
	
		$newUser['objectClass'][0] = 'top';
		$newUser['objectClass'][1] = 'person';
		$newUser['objectClass'][2]='organizationalPerson';
		$newUser['objectClass'][3]='inetOrgPerson';
		$newUser['objectClass'][4]='posixAccount';
		$newUser['objectClass'][5]='shadowAccount';
		$newUser['uid']=$uid;
		$newUser['cn']=$cn;
		$newUser['sn']=$sn;
		$newUser['givenName']=$givenName;
		$newUser['title']=$title;
		$newUser['telephoneNumber']=$telephoneNumber;
		$newUser['mobile']=$mobile;
		$newUser['postalAddress']=$postalAddress;
		$newUser['loginShell']="/bin/bash";
		$newUser['gidNumber']=$_POST['gidnumber'];
		$newUser['uidNumber']=$_POST['uidnumber'];
		$newUser['homeDirectory']="/home/$uid/";
		$newUser['description']=$description;
		$newUser['userPassword']=$password;
		
		if (!(ldap_add($ldapconn, $dn, $newUser))) {
			header('Location: ErrorADDUser.php');
	 }else{
		header('Location: AddGood.php');
		
	 }
	}
	





		



/*	$missatge ="
dn: uid=$uid,ou=$ou,dc=fjeclot,dc=net
objectClass: top
objectClass: person
objectClass: organizationalPerson
objectClass: inetOrgPerson
objectClass: posixAccount
objectClass: shadowAccount
uid: $uid
cn: $cn
sn: $sn
givenName: $givenName
title: $title
telephoneNumber: $telephoneNumber
mobile: $mobile
postalAddress: $postalAddress
loginShell: /bin/bash
gidNumber: 2000
uidNumber: 1000
homeDirectory: /users/$uid/
description: $description";
echo $missatge;*/


	/*chmod($nom_fitxer, 0777);
	echo	shell_exec("ldapadd -h localhost -c -x -D 'cn=admin,dc=fjeclot,dc=net' -W -f $nom_fitxer");*/
   

?>
