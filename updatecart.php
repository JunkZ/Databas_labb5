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
include_once 'dbini/db_handler.php';
$conn;
$action = $_POST["action"];
$prodid = $_POST["prodid"];
$uName = $_SESSION['username'];

if ($action == "add") {
    $sql = "SELECT * FROM varukorg WHERE customer_Användarnamn = '$uName'
    AND produkt_ProductID = '$prodid' AND Order_ID is NULL;";
    $result = $conn->query($sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $newValue = $row["Kvantitet"] + 1;
        $sql = "UPDATE varukorg SET Kvantitet = $newValue WHERE customer_Användarnamn = '$uName'
        AND produkt_ProductID = '$prodid'
        AND Order_ID is NULL;";
        $conn->query($sql);
    } else {
        $sql = "INSERT INTO varukorg (Kvantitet,customer_Användarnamn,produkt_ProductID)
        VALUES (1,'$uName', '$prodid');";
        $conn->query($sql);
    }
    echo "successfully added to cart";
} else if ($action == "deleteWhole") {
    $sql = "DELETE FROM varukorg WHERE customer_Användarnamn = '$uName' AND produkt_ProductID = '$prodid' AND Order_ID IS NULL;";
    $conn->query($sql);
    echo "successfully removed from cart";
}

?>

</body>
</html>
