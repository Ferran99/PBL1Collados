<html>
<head>

<title>TheUrbanPenguin PHP LDAP</title>
</head>
<body>
<h1> Deleting LDAP User</h1>
<hr>
<?php

$ldaphost = "ldap://127.0.0.1";

$ldapconn = ldap_connect($ldaphost);
ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

$bind = ldap_bind($ldapconn, "cn=admin,dc=fjeclot,dc=net", "fjeclot");

$ldapadmin= "cn=admin,dc=fjeclot,dc=net";  

$dn = 'uid='.$_POST['uid'].',ou='.$_POST['ou'].',dc=fjeclot,dc=net';
if (!(ldap_delete($ldapconn, "$dn"))) {
    header('Location: errorDelete.php');

   //echo "unable to delete $dn\n";
}else{
    //echo "S'ha eliminat l'usuari $dn";
    header('Location: GoodDelete.php');

}

?>
<hr>
<a href = "delete.php">Delete another user</a>
<a href="home.php">Return Home</a>

</body>
</html>