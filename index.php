<?php
if (session_status() == PHP_SESSION_NONE) {
    $_SESSION["admin"] = "false";
	$_SESSION["loggedIN"] = "false";
	$_SESSION["username"] = "";
}
session_start();
?>
<html>
<body>
<head>
    <link rel="stylesheet" href="css/index.css" />
</head>
<p class=serif> Welcome! </p>
<div id="box"><div>

<form action="list.php" method="post" class=posproducts>
<input type="submit" value="Product list" class="buttonprod">
</form>





<form action="search.php" method="get" class=add>
<input type="text" name="searched" placeholder="Product to lookup...">
<input type="submit" class="button" value="Search"> 
</form>





<form action="register.php" method="post" class=posproducts>
<br>
Username: <input type="text" name="ANAMN">
<br>
Password: <input type="text" name="PASS">
<input type="submit" value="Registrera" class="buttonreg">
</form>

<form action="login.php" method="post" class=posproducts>
<br>
Username: <input type="text" name="ANAMN">
<br>
Password: <input type="text" name="PASS">
<br>
<input type="submit" value="Log in!" class="buttonlog">
</form>

</form>
</body>
</html>
