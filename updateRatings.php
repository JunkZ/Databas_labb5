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

$sql = "SELECT * FROM rating WHERE produkt_ProductID = '$prodid';";
$result = $conn->query($sql);

if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_array($result);
	$newNR = $row["RatingNR"] + 1;
	$newRating = $row["RatingPoints"] + $rating;
	$sql = "UPDATE rating SET RatingNR = $newNR, RatingPoints = $newRating WHERE produkt_ProductID = '$prodid';";
	$conn->query($sql);
} else {
	$sql = "INSERT INTO rating VALUES (1,'$rating','$prodid');";
	$conn->query($sql);
}
echo "successfully added rating";

?>

</body>
</html>
