<?php
session_start(); 

if (isset($_SESSION['username']))
{?>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel = "stylesheet" type = "text/css" href = "stylesheets/stylesheet.css">
<title>Delete ldap user</title>
<body>
<h1>Delete User</h1>
<hr>
<a href="home.php?logout">Logout</a>
<a href="home.php" style="margin-left:2%;">Return Home</a>
<form action = "ldapuserdel.php" method = "post" class="mx-auto	" style="width: 500px; margin-top: 10%;">
<table cellspacing=3 cellpadding=3>
    <tr>
            <td>Poseu un uid: </td>
            <td><input type=text name=uid size=16 maxlength=15 required></td>                     
           
    </tr>    
    <td>Unitat organitzativa: </td>
              <td>
                <select name="ou">
                    <option value="usuaris">usuaris</option>
                    <option value="administradors">administradors</option>
                    <option value="desenvolupadors">desenvolupadors</option>
                </select>
              </td>
					</tr>
          <tr>
                    
			  <td colspan=2><button type="submit" class="btn btn-primary">Eliminar Usuari</button></td>
		   </tr>
		</table>
</form>


</body>
</head>
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