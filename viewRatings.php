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
$prodid = $_GET["prodid"];
$uName = $_SESSION['username'];
$sql = "SELECT * FROM produkt WHERE ProductID = '$prodid';";
	$resultProdukt = $conn->query($sql);
	$produktArray = mysqli_fetch_array($resultProdukt);
	echo "<span id=\"lst\"><strong>ProductID: </strong>" . $produktArray["ProductID"]
		. " | <strong>Product Name: </strong>" . $produktArray["ProductName"]
		. " | <strong>Price: </strong>" . $produktArray["Pris"]
		. "</span>";
	echo "<br>";
$sql = "SELECT * FROM kommentarer WHERE produkt_ProductID = $prodid;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
      if($row["comment"] != ""){
		echo $row["comment"] . "  " . $row["rating"] . "/5    "  . $row["customer_Användarnamn"] . "   " .  $row["datum"];
	  }else  {
		echo "~User made no comment~    " . $row["rating"] . "/5    "  . $row["customer_Användarnamn"] . "   " .  $row["datum"];
	  }
	  ?>
		  <form action="updateRatings.php" method="post" <?php if ($_SESSION["Admin"] == "false" OR $row["comment"] == NULL ) {
                echo 'style="display:none"';
            }
            ?>>
		  <input type="hidden" name="commentID" value="<?php echo $row["commentID"]; ?>">
		  <input type ="hidden" name="action" value="delete">
		  <input type="submit" value="delete comment" ></form>
		  <?php
	  echo "<br>";
}
} else {
    echo "Inga resultat!";
}
?>
</body>
</html>
