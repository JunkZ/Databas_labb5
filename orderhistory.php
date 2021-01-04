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
	$sql = "SELECT DISTINCT(Order_ID) AS Order_ID FROM varukorg WHERE Order_ID IS NOT NULL ;";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		// output data of each row
		echo "<p>Previous orders:</p>  <br>";
		$summa = 0;
		while ($row = $result->fetch_assoc()) {
			$id = $row['Order_ID'];
			$sql = "SELECT datum FROM `order` WHERE OrderID = $id;";
			$datum = $conn->query($sql);
			$datum = $datum->fetch_assoc();
			$datum = $datum['datum'];
			
			echo "<br>";
			echo "<br>";
			echo "ORDER ID: ",  $id ,"  beställningsdatum: ", $datum , "<br>";
			$sql = "SELECT `produkt_ProductID`, Kvantitet, customer_Användarnamn, orderPris FROM `varukorg` WHERE Order_ID = $id ;";
			$resultO = $conn->query($sql);
			while ($rowO = $resultO->fetch_assoc()) {
				$prodid = $rowO["produkt_ProductID"];
				echo "<span id=\"lst\"><strong>Product ID: </strong>" . $prodid
				. " | <strong>Kvantitet: </strong>" . $rowO["Kvantitet"]
				. " | <strong>Köpare: </strong>" . $rowO["customer_Användarnamn"]
				. " | <strong>Pris styck: </strong>" . $rowO["orderPris"]
				. "</span>";
				echo "<br>";
				//$summa = $summa + $rowO["Kvantitet"]*$rowO["orderPris"];
		}

		//echo "Order ".$id." Summa: " . $summa;
		//echo "<br>";
		}
		
	} else {
		echo "0 results";
	}
} else {
	//$sql = "SELECT `Order_ID`,`produkt_ProductID`, Kvantitet FROM `varukorg` WHERE `customer_Användarnamn`='$uName' AND Order_ID IS NOT NULL ;";
	$sql = "SELECT DISTINCT(Order_ID) AS Order_ID FROM varukorg WHERE `customer_Användarnamn`='$uName' AND Order_ID IS NOT NULL ;";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		// output data of each row
		echo "<p>Previous orders:</p>  <br>";
		while ($row = $result->fetch_assoc()) {
			$id = $row['Order_ID'];
			$sql = "SELECT datum FROM `order` WHERE OrderID = $id;";
			$datum = $conn->query($sql);
			$datum = $datum->fetch_assoc();
			$datum = $datum['datum'];
			
			echo "<br>";
			echo "<br>";
			echo "ORDER ID: ",  $id ,"  beställningsdatum: ", $datum , "<br>";

			$sql = "SELECT `produkt_ProductID`, Kvantitet, orderPris FROM `varukorg` WHERE Order_ID = $id ;";
			$resultO = $conn->query($sql);
			$summa = 0;
			while ($rowO = $resultO->fetch_assoc()) {
				$prodid = $rowO["produkt_ProductID"];
				$sql = "SELECT * FROM kommentarer WHERE customer_Användarnamn ='$uName' AND produkt_ProductID ='$prodid';";
				$resultR = $conn->query($sql);
				if ($resultR->num_rows > 0) {
					$alreadyRated = "true";
					$ratedStatus = "edit rating: ";
				} else { 
					$alreadyRated = "false";
					$ratedStatus = "rate purchase: ";
				}
				echo "<span id=\"lst\"><strong>Product ID: </strong>" . $prodid
				. " | <strong>Kvantitet: </strong>" . $rowO["Kvantitet"]
				. " | <strong>Pris styck: </strong>" . $rowO["orderPris"]
				. " | <strong>Betygstatus: </strong>" . $ratedStatus
				. "</span>";
				$summa = $summa + $rowO["Kvantitet"]*$rowO["orderPris"];
				?>
				
					<form action="updateRatings.php" method="post"<?php if ($alreadyRated == "true") {
					echo 'style="display:none"';
					} 
		?>>
					
					<input type="hidden" name="prodid" value="<?php echo $rowO["produkt_ProductID"]; ?>">
					<input type ="hidden" name="action" value="rate">
					<input type="text" name="comment">
					<input type="number" name="rating" min="1" max="5" value = 3>
					<input type="submit" value="Submit">
					</form>
					<form action="updateRatings.php" method="post"<?php if ($alreadyRated == "false") {
					echo 'style="display:none"';
					} 
		?>>
					
					<input type="hidden" name="prodid" value="<?php echo $rowO["produkt_ProductID"]; ?>">
					<input type ="hidden" name="action" value="edit">
					<input type="text" name="comment">
					<input type="number" name="rating" min="1" max="5" value = 3>
					<input type="submit" value="Submit">
					</form>
				<?php
				
			}
			echo "Order ".$id." Summa: " . $summa;
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