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
            $id = $row["ProductID"];
			$prodid = $row["ProductID"];
		    $sql = "SELECT * FROM rating WHERE produkt_ProductID =  '$prodid' ;";
		    $resultRating = $conn->query($sql);
		    $rating = mysqli_fetch_array($resultRating);
		    if(isset($rating["RatingNR"])){
			    $points = $rating["RatingPoints"];
			    $nr = $rating["RatingNR"];
			    $nr = $points / $nr;
				$nr = $nr . "/5";
		    } else {
				$nr = "No rating yet";
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