<?php
session_start();
if (!isset($_SESSION['loggedIN'])) {
    $_SESSION['loggedIN'] = "false";
    $_SESSION['Admin'] = "false";
    $_SESSION['username'] = "";
}
?>
<html>
<body>
<head>
    <link rel="stylesheet" href="css/index.css" />
</head>
<p class=serif> Welcome! </p>
<?php
if ($_SESSION["loggedIN"] == "true") {
    echo "Du är inloggad som: ", $_SESSION["username"];
}
?>
<div id="box"><div>

<form action="list.php" method="post" class=posproducts>
<input type="submit" value="Product list" class="buttonprod">
</form>





<form action="search.php" method="get" class=add>
<input type="text" name="searched" placeholder="Product to lookup...">
<input type="submit" class="button" value="Search">
</form>





<form action="register.php" method="post" class=posproducts <?php if ($_SESSION["loggedIN"] == "true") {
    echo 'style="display:none"';
}
?>>
<br>
Username: <input type="text" name="ANAMN">
<br>
Password: <input type="text" name="PASS">
<input type="submit" value="Registrera" class="buttonreg">
</form>

<form action="login.php" method="post" class=posproducts <?php if ($_SESSION["loggedIN"] == "true") {
    echo 'style="display:none"';
}
?>>
<br>
Username: <input type="text" name="ANAMN">
<br>
Password: <input type="text" name="PASS">
<br>
<input type="submit" value="Log in!" class="buttonlog">
</form>

<form action="admin.php" method="post" class=posadmin <?php if ($_SESSION["Admin"] == "false") {
    echo 'style="display:none"';
}
?>>
<input type="submit" value="Admin page" class="buttonadmin" >
</form>
<br>
<form action="logout.php" method="post" class=poslogout <?php if ($_SESSION["loggedIN"] == "false") {
    echo 'style="display:none"';
}
?>>
<input type="submit" value="Logout" class="buttonlogout">
</form>

<form action="orderhistory.php" method="post" <?php if ($_SESSION["loggedIN"] == "false") {
    echo 'style="display:none"';
}
?>> 
<input type="hidden" name="action" value="boo">
<input type="submit" value="Order history" class="buttonhistory">
</body>

</body>
</html>
