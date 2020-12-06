<?php
session_start();

?>
<html>
<body>
    <p>Previous orders:</p>  <br>
<?php
include_once 'dbini/db_handler.php';
$conn;
$uName = $_SESSION['username'];
$sql = "SELECT `Order_ID`,`produkt_ProductID` FROM `varukorg` WHERE `Customer_Användarnamn`='$uName';";
$result = $conn->query($sql);



if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $id = $row["Order_ID"];
        echo "<span id=\"lst\"><strong>OrderNR: </strong>" . $row["Order_ID"]
        . " | <strong>Product ID: </strong>" . $row["produkt_ProductID"]
        . "</span>";
        echo "<br>";
        
    }
} else {
    echo "0 results";
}
$conn->close();
?>
</body>
</html>
