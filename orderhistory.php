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
        $id = $row["Order_ID"];
        echo "<span id=\"lst\"><strong>OrderNR: </strong>" . $row["Order_ID"]
        . " | <strong>Product ID: </strong>" . $row["produkt_ProductID"]
		. " | <strong>Kvantitet: </strong>" . $row["Kvantitet"]
        . "</span>";
		?>
			<form action="updateRatings.php" method="post">
			<input type="hidden" name="prodid" value="<?php echo $row["produkt_ProductID"]; ?>">
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
