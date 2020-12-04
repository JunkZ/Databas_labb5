<?php
session_start();
?>
<html>
<body>
<head>
    <link rel="stylesheet" href="css/index.css" />
</head>
<form action="viewcart.php" method="post" >
<input type="submit" value="Back to cart" class="button"> 
</form>

<?php
$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "mydb";
$uName = $_SESSION['username'];

$conn = new mysqli($servername, $username, $password,$dbname);


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} else {
try {
$conn -> begin_transaction();
$sql = "SELECT * FROM varukorg WHERE Customer_Användarnamn = '$uName';";
$result = $conn->query($sql);
while ($row = mysqli_fetch_array($result)) {
    //get and delete from varukorg
    $prodid = $row["produkt_ProductID"];
    $quantity = $row["Kvantitet"];
    $sql = "DELETE FROM varukorg WHERE Customer_Användarnamn = '$uName' AND produkt_ProductID = $prodid;";
    $conn->query($sql);

    //get needed new value for update lagersaldo
    $sql = "SELECT * FROM produkt WHERE ProductID = $prodid;";
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result);
    //echo "<br> LAGERSALDO:".$row["Lagersaldo"]."<br>";
    $newvalue = $row["Lagersaldo"] - $quantity;
    //echo "<br> NEW VALUE:".$newvalue."<br>";

    //uppdate lagersaldo
    $sql = "UPDATE produkt SET lagersaldo=$newvalue WHERE ProductID = $prodid;";
    $conn->query($sql);
    echo $quantity. " of product ". $prodid . " has been ordered!<br>";
}



$conn -> commit();

} catch (mysqli_sql_exception $exception) {
    $conn->rollback();
    echo "Something went wrong rolling back...";
}}
?>
<form action="orderhistory.php" method="post" >
<input type="submit" value="Order history" class="button"> 
</body>

</html>
