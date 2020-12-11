<?php
session_start();
?>
<html>
<body>

	<form action="index.php" method="post">
	<input type="submit" value="Back to home" class="button">
	</form>

<?php
include_once 'dbini/db_handler.php';
$conn;
$rating = $_POST["rating"];
$prodid = $_POST["prodid"];
$comment = $_POST["comment"];
$uName = $_SESSION['username'];

$sql = "INSERT INTO kommentarer (comment,rating,customer_Användarnamn,produkt_ProductID,datum) VALUES ('$comment','$rating','$uName','$prodid',CURDATE());";
$conn->query($sql);


echo "successfully added rating";

?>

</body>
</html>
