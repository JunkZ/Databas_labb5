<?php
session_start();
?>
<html>
<body>

	<form action="index.php" method="post">
	<input type="submit" value="Back to home" class="button"> 
	</form>
	<form action="viewcart.php" method="post" >
	<input type="submit" value="View cart" class="button">
	</form>

<?php
$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "mydb";
$action = $_POST["action"];
$prodid = $_POST["prodid"];
$uName = $_SESSION['username'];

$conn = new mysqli($servername, $username, $password,$dbname);


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if ($action == "add"){
	$sql = "SELECT * FROM varukorg WHERE Customer_Användarnamn = '$uName' AND produkt_ProductID = '$prodid';";
	$result = $conn->query($sql);

	if(mysqli_num_rows($result) > 0)
	{
		$row = mysqli_fetch_array($result);
		$newValue = $row["Kvantitet"] + 1;
		$sql = "UPDATE varukorg SET Kvantitet = $newValue WHERE Customer_Användarnamn = '$uName' AND produkt_ProductID = '$prodid';"; 
		$conn->query($sql);
	} else {
		$sql = "INSERT INTO varukorg VALUES (1,'$uName', '$prodid');";
		$conn->query($sql);
	}
	echo "successfully added to cart";
} else if ($action == "deleteWhole") {
	$sql = "DELETE FROM varukorg WHERE Customer_Användarnamn = '$uName' AND produkt_ProductID = '$prodid';";
	$conn->query($sql);
	echo "successfully removed from cart";
}

?>

</body>
</html>
