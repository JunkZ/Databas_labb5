<?php
session_start();
include_once 'dbini/db_handler.php';
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
include_once 'dbini/db_handler.php';
$conn;
$uName = $_SESSION['username'];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    try {
        $conn->begin_transaction();
        $sql = "SELECT * FROM varukorg WHERE Customer_Användarnamn = '$uName' AND Order_ID is NULL;";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_array($result)) {
            $sql = "INSERT INTO `order`(`OrderID`) VALUES ('')";
            $conn->query($sql);
            $last_id = $conn->insert_id;
            $sql = "UPDATE varukorg SET Order_ID = $last_id WHERE Customer_Användarnamn = '$uName'
            AND Order_ID is NULL";
            $conn->query($sql);

            //get needed new value for update lagersaldo
            $prodid = $row["produkt_ProductID"];
            $quantity = $row["Kvantitet"];
            $sql = "SELECT * FROM produkt WHERE ProductID = $prodid;";
            $result1 = $conn->query($sql);
            $row = mysqli_fetch_array($result1);
            //echo "<br> LAGERSALDO:".$row["Lagersaldo"]."<br>";
            if ($row["Lagersaldo"] > 0) {
                $newvalue = $row["Lagersaldo"] - $quantity;
                //echo "<br> NEW VALUE:".$newvalue."<br>";

                //uppdate lagersaldo
                $sql = "UPDATE produkt SET lagersaldo=$newvalue WHERE ProductID = $prodid;";
                $conn->query($sql);

            } else {
                echo "Last quantity has already been ordered";
                $conn->rollback();
            }

        }

        $conn->commit();

    } catch (mysqli_sql_exception $exception) {
        $conn->rollback();
        echo "Something went wrong rolling back...";
    }}
?>
<form action="orderhistory.php" method="post" >
<input type="submit" value="Order history" class="button">
</body>

</html>
