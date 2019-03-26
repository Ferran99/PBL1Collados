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
<form action="modify.php"	 method=post  class="mx-auto	" style="width: 500px; margin-top: 10%;"><br>



<table cellspacing=3 cellpadding=3 >
<tr>
			  <td>Uid: </td>
			  <td><input type=text name="uid" size=16 name=login ></td>
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
			  <td> gidNumber: </td>
			  <td><input type=text name=gidnumber size=16 maxlength=15 ></td>
		   </tr>
			 <tr>
			  <td> uidNumber: </td>
			  <td><input type=text name=uidnumber size=16 maxlength=15 ></td>
		   </tr>
           <tr>
			

            <td> <button type="submit" name="submit" class="btn btn-primary">Modificar Usuari</button></td>
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
    $ldaphost = "ldap://127.0.0.1";

	$ldapconn = ldap_connect($ldaphost);
	ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

    $bind = ldap_bind($ldapconn, "cn=admin,dc=fjeclot,dc=net", "fjeclot");
    $dn = 'uid='.$_POST['uid'].',ou='.$_POST['ou'].',dc=fjeclot,dc=net';

    if($_POST['gidnumber']!=null && $_POST['uidnumber']!=null){

        $newUser['gidNumber']=$_POST['gidnumber'];
		$newUser['uidNumber']=$_POST['uidnumber'];


        $result = ldap_modify($ldapconn, $dn,$newUser );
        if (TRUE === $result) {
            echo "The entry was successfully modified.";
        } else {
            echo "The entry could not be modified.";
        }

    }/* if($_POST['gidnumber'] =! null  && $_POST['uidnumber'] == null ){

        $newUser['gidNumber']=$_POST['gidnumber'];
        $result = ldap_modify($ldapconn, $dn,$newUser );
        if (TRUE === $result) {
            echo "gidNumber The entry was successfully modified.";
        } else {
            echo "gidNumber The entry could not be modified.";
        }

    } if($_POST['uidnumber'] =! null  && $_POST['gidnumber'] == null){

        $newUser['uidNumber']=$_POST['uidnumber'];

        
        $result = ldap_modify($ldapconn, $dn,$newUser);
        if (TRUE === $result) {
            echo "uidNumber The entry was successfully modified.";
        } else {
            echo "uidNumber The entry could not be modified.";
        }


    }*/
}