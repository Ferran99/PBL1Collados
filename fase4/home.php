
<?php
session_start(); 

if (isset($_SESSION['username']))
{ ?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<body>
<a href="home.php?logout">Logout</a>
<h1  class="mx-auto"  style="width: 500px; margin-top: 2%">Home Page</h1>
<div  class="mx-auto	" style="width: 500px; margin-top: 5%;">
<form action="add.php"	 method=post><br>
<button type="submit" class="btn btn-success">ADD</button>

</form><br>

<form action="delete.php"	 method=post>
<button type="submit" class="btn btn-danger">Delete</button>

</form><br>

<form action="show.php"	 method=post>
<button type="submit" class="btn btn-info">Show</button>

</form><br>
<form action="modify.php" method="post">
<button type="submit" class="btn btn-warning">Modify</button>

</form>
</div>



  
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
?>
