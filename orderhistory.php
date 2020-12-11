<?php
session_start();

?>
<html>
<body>
<form action="index.php" method="post" >
<input type="submit" value="Back to home" class="button">
</form>
    <p>Previous orders:</p>  <br>
<?php
include_once 'dbini/db_handler.php';
$conn;
$uName = $_SESSION['username'];
$sql = "SELECT `Order_ID`,`produkt_ProductID`, Kvantitet FROM `varukorg` WHERE `Customer_Användarnamn`='$uName' AND Order_ID IS NOT NULL ;";
$result = $conn->query($sql);



if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
		$prodid = $row["produkt_ProductID"];
        $id = $row["Order_ID"];
		$sqlR = "SELECT * FROM kommentarer WHERE Customer_Användarnamn ='$uName' AND produkt_ProductID ='$prodid';";
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
$conn->close();
?>
</body>
</html>
