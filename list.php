<?php
session_start();
?>
<html>

<body>
  <p>

    <head>
      <link rel="stylesheet" href="css/search.css"/>
    </head>
	<form action="index.php" method="post">
	<input type="submit" value="Back to home" class="button">
	</form>
	<form action="viewcart.php" method="post" class=poslogout <?php if ($_SESSION["loggedIN"] == "false") {
    echo 'style="display:none"';
}
?>>
	<input type="submit" value="View cart" class="buttonlogout">
	</form>
    <h1 class=serif> Product list: </h1>
    <?php
include_once 'dbini/db_handler.php';
$conn;
$sql = "SELECT * FROM produkt";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        if ($row["Lagersaldo"] > 0) {
			$prodid = $row["ProductID"];
		    $sqlR = "SELECT rating FROM kommentarer WHERE produkt_ProductID = '$prodid';";
			$resultR = $conn->query($sqlR);
			$loops = 0;
			$total = 0;
			//loopar och räknar ut average av alla ratings på en specifik prodid
			if ($resultR->num_rows > 0) {
				while($rowR = mysqli_fetch_array($resultR)){
					$loops += 1; 
					$total += $rowR["rating"];
					$nr = $total / $loops . "/5";
				}
			} else { 
				$nr = "no rating!";
			}
            //echo $id;
            echo "<span id=\"lst\"><strong>ProductID: </strong>" . $row["ProductID"]
                . " | <strong>Product Name: </strong>" . $row["ProductName"]
                . " |<strong> Date: </strong>" . $row["Tillagt datum"]
                . " | <strong>Price: </strong>" . $row["Pris"]
                . " | <strong>Stock: </strong>" . $row["Lagersaldo"]
				. " | <strong>Rating: </strong>" . $nr
                . "</span>";
            ?>
		  <form action="updatecart.php" method="post" <?php if ($_SESSION["loggedIN"] == "false") {
                echo 'style="display:none"';
            }
            ?>>
		  <input type="hidden" name="prodid" value="<?php echo $row["ProductID"]; ?>">
		  <input type ="hidden" name="action" value="add">
		  <input type="submit" value="Add to cart" ></form>
		  <form action="viewRatings.php" method="get">
		  <input type="hidden" name="prodid" value="<?php echo $row["ProductID"]; ?>">
		  <input type="submit" value="View ratings" ></form>
		  <?php
		  
echo "<br>";

        } else {
            echo "Product \"" . $row["ProductName"] . "\" is out of stock! <br><br>";
        }

    }
} else {
    echo "Inga resultat!";
}
$sql = "SELECT * FROM kategorier";
$result = $conn->query($sql);
echo "<br><h1 class=serif>Category list: </h1>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<span id=\"lst\"><strong>ProductID FK: </strong>" . $row["ProductID"]
            . " | <strong>Kategori Namn: </strong>" . $row["ProductName"]
            . "</span><br>";
    }
} else {
    echo "No results!";
}
$conn->close();

?>
    </div>
</body>

</html>