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
$NAME = $_POST["name"];
$NUMBER = $_POST["number"];
$ADDRESS = $_POST["address"];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    try {
        $conn->begin_transaction();
		$sql = "SELECT * FROM varukorg WHERE customer_Användarnamn = '$uName' AND Order_ID is NULL;";
		$result = $conn->query($sql);
        $sql = "  INSERT INTO `order`(`Namn`, `Address`, `TelefonNR`, `datum`) 
        VALUES ('$NAME','$ADDRESS','$NUMBER',CURDATE())";
        

        $conn->query($sql);
        while ($row = mysqli_fetch_array($result)) {
			 //get needed new value for update lagersaldo
			 
            $last_id = $conn->insert_id;
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
            $sql = "UPDATE varukorg SET Order_ID = $last_id WHERE customer_Användarnamn = '$uName'
            AND Order_ID is NULL;";
            $conn->query($sql);
		    $sql = "SELECT produkt_ProductID FROM varukorg WHERE Order_ID = $last_id;";
			$resultR = $conn->query($sql);
			while($rowR = mysqli_fetch_array($resultR)){
				$id = $rowR["produkt_ProductID"];
				$sql = "SELECT Pris FROM produkt WHERE ProductID = $id;";
				$resultP = $conn->query($sql);
				$price = mysqli_fetch_array($resultP);
				$price = $price["Pris"];
				$sql = "UPDATE varukorg SET orderPris = $price WHERE produkt_ProductID = $id
				AND Order_ID = $last_id;";
				$conn->query($sql);	
			}
           

        }

        $conn->commit();

    } catch (mysqli_sql_exception $exception) {
        $conn->rollback();
        echo "Something went wrong rolling back...";
    }}
?>
<form action="orderhistory.php" method="post" >
<input type="hidden" name="action" value="boo">
<input type="submit" value="Order history" class="button">
</body>

</html>
