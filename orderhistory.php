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
$sql = "SELECT `Order_ID` FROM `varukorg` WHERE `Customer_Användarnamn`='$uName';";
$result = $conn->query($sql);



if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo $row["Order_ID"] . "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
</body>
</html>
