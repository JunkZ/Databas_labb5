<?php
session_start();
?>
<html>
<body>
<head>
    <link rel="stylesheet" href="css/admin.css" />
</head>
<p class=serif>Please don't spam insert values since were gonna have to delete all of them later </p>
<form action="index.php" method="post">
<input type="submit" value="Back to home" class="button">
</form>
<form action="updateDB.php" method="post" >
<input type="text" name="PName" placeholder="Productname....">
</br><br>
<input type="text" name="PID" placeholder="ProductID...">
</br><br>
<input type="text" name="PPrice" placeholder="ProductPrice...">
</br><br>
<input type="text" name="PSaldo" placeholder="ProductSaldo...">
</br><br>
<input type="submit" value="Insert product!" class="button">
</form>
<?php
if ($_SESSION["Admin"] != "true") {
    header("location: index.php");
    exit;
} else {
    echo "välkommen herr admin";
}
?>
<form action="orderhistory.php" method="post">
<input type="hidden" name="action" value="checkAll">
<input type="submit" value="Check all orders" class="button">
</form>

</body>
</html>
