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

$uName = $_SESSION['username'];
$action = $_POST['action'];
if ($action == "delete"){
	$cid = $_POST['commentID'];
	$sql = "UPDATE kommentarer SET comment = NULL WHERE commentID = $cid;";
	$conn->query($sql);
	echo "successfully deleted comment";
} else if ($action == "rate") {
	$rating = $_POST["rating"];
	$prodid = $_POST["prodid"];
	$comment = $_POST["comment"];
	$sql = "INSERT INTO kommentarer (comment,rating,customer_Användarnamn,produkt_ProductID,datum) VALUES ('$comment','$rating','$uName','$prodid',CURDATE());";
	$conn->query($sql);


	echo "successfully added rating";
} else if ($action == "edit") {
	$rating = $_POST["rating"];
	$prodid = $_POST["prodid"];
	$comment = $_POST["comment"];
	echo $rating, " ", $prodid, " ", $comment, " ", $uName, " ";
	$sql = "UPDATE kommentarer 
	SET comment = '$comment', rating = $rating, datum = CURDATE()
	WHERE customer_Användarnamn = '$uName' AND produkt_ProductID = $prodid;";
	$conn->query($sql);
	echo "successfully edited rating";
}

?>


</body>
</html>
