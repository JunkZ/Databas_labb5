<?php
session_start();

?>
<html>
<body>
<form action="index.php" method="post" >
<input type="submit" value="Back to home" class="button">
</form>
  
<?php
include_once 'dbini/db_handler.php';
$conn;
$uName = $_SESSION['username'];
$admin = $_SESSION["Admin"];
$action = $_POST["action"];

if($admin == "true" && $action=="checkAll"){
	$sql = "SELECT * FROM varukorg WHERE Order_ID IS NOT NULL ;";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		echo "<p>All customer orders:</p>  <br>";
		// output data of each row
		while ($row = $result->fetch_assoc()) {
			$prodid = $row["produkt_ProductID"];
			$id = $row["Order_ID"];
			
			echo "<span id=\"lst\"><strong>OrderNR: </strong>" . $row["Order_ID"]
			. " | <strong>Customername: </strong>" . $row["customer_Användarnamn"]
			. " | <strong>Product ID: </strong>" . $prodid
			. " | <strong>Kvantitet: </strong>" . $row["Kvantitet"]
			. "</span>";
			
			
			echo "<br>";
			
		}
	} else {
		echo "0 results";
	}
} else {
	$sql = "SELECT `Order_ID`,`produkt_ProductID`, Kvantitet FROM `varukorg` WHERE `customer_Användarnamn`='$uName' AND Order_ID IS NOT NULL ;";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		// output data of each row
		echo "<p>Previous orders:</p>  <br>";
		while ($row = $result->fetch_assoc()) {
			$prodid = $row["produkt_ProductID"];
			$id = $row["Order_ID"];
			$sqlR = "SELECT * FROM kommentarer WHERE customer_Användarnamn ='$uName' AND produkt_ProductID ='$prodid';";
			$resultR = $conn->query($sqlR);
			if ($resultR->num_rows > 0) {
				$alreadyRated = "true";
				$ratedStatus = "already rated product!";
			} else { 
				$alreadyRated = "false";
				$ratedStatus = "not rated, rate your purchase below!";
			}
			echo "<span id=\"lst\"><strong>OrderNR: </strong>" . $row["Order_ID"]
			. " | <strong>Product ID: </strong>" . $prodid
			. " | <strong>Kvantitet: </strong>" . $row["Kvantitet"]
			. " | <strong>Kvantitet: </strong>" . $ratedStatus
			. "</span>";
			
			?>
			
				<form action="updateRatings.php" method="post"<?php if ($alreadyRated == "true") {
				echo 'style="display:none"';
	}
	?>>
				<input type="hidden" name="prodid" value="<?php echo $row["produkt_ProductID"]; ?>">
				<input type="text" name="comment">
				<input type="number" name="rating" min="1" max="5">
				<input type="submit" value="Submit">
				</form>
			<?php
			echo "<br>";
			
		}
	} else {
		echo "0 results";
	}
}
$conn->close();
?>
</body>
</html>
