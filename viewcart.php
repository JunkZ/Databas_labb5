<?php
session_start();
?>
<html>
<body>
<head>
    <link rel="stylesheet" href="css/index.css" />
</head>
<form action="index.php" method="post" >
<input type="submit" value="Back to home" class="button">
</form>

<form action="list.php" method="post" >
<input type="submit" value="Continue shopping" class="button">
</form>

<?php
include_once 'dbini/db_handler.php';
$conn;
$uName = $_SESSION['username'];

$sql = "SELECT * FROM varukorg WHERE customer_Användarnamn = '$uName' AND Order_ID IS NULL;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $prodid = $row["produkt_ProductID"];
        $sql = "SELECT * FROM produkt WHERE ProductID = '$prodid';";
        $resultProdukt = $conn->query($sql);
        $produktArray = mysqli_fetch_array($resultProdukt);
        echo "<span id=\"lst\"><strong>ProductID: </strong>" . $produktArray["ProductID"]
            . " | <strong>Product Name: </strong>" . $produktArray["ProductName"]
            . " | <strong>Price: </strong>" . $produktArray["Pris"]
            . " | <strong>Kvantitet: </strong>" . $row["Kvantitet"]
            . "</span>";
        echo "<br>";
        ?>
		  <form action="updatecart.php" method="post">
		  <input type="hidden" name="prodid" value="<?php echo "$prodid"; ?>">
		  <input type ="hidden" name="action" value="deleteWhole">
		  <input type="submit" value="Delete" ></form>
		  <?php
}
} else {
    echo "Inga resultat!";
}
?>
</body>
<form action="checkout.php" method="post" >
<input type="submit" value="Checkout" class="button">
</html>
